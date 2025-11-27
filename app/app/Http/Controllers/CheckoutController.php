<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Razorpay\Api\Api;

class CheckoutController extends Controller
{
    public function show(Brand $brand, CartService $cartService): View|RedirectResponse
    {
        $items = $cartService->items($brand->slug);

        if ($items->isEmpty()) {
            return redirect()->route('brand.products.index', $brand)->with('status', 'Your cart is empty.');
        }

        $totals = $cartService->totals($brand->slug);

        return view('brands.checkout.index', compact('brand', 'items', 'totals'));
    }

    public function store(Request $request, Brand $brand, CartService $cartService): View|RedirectResponse
    {
        $items = $cartService->items($brand->slug);

        if ($items->isEmpty()) {
            return redirect()->route('brand.products.index', $brand)->with('status', 'Your cart is empty.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:30'],
            'address_line1' => ['required', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:120'],
            'state' => ['required', 'string', 'max:120'],
            'postal_code' => ['required', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:120'],
            'landmark' => ['nullable', 'string', 'max:120'],
            'notes' => ['nullable', 'string', 'max:500'],
            'payment_method' => ['required', 'in:cod,razorpay'],
        ]);

        $totals = $cartService->totals($brand->slug);

        $order = DB::transaction(function () use ($brand, $items, $data, $totals) {
            /** @var Order $order */
            $order = Order::query()->create([
                'brand_id' => $brand->id,
                'status' => 'pending',
                'payment_status' => $data['payment_method'] === 'cod' ? 'pending' : 'pending',
                'payment_method' => $data['payment_method'],
                'currency' => 'INR',
                'subtotal' => $totals['subtotal'],
                'discount_total' => 0,
                'tax_total' => $totals['tax'],
                'shipping_total' => $totals['shipping'],
                'grand_total' => $totals['grand_total'],
                'customer_notes' => $data['notes'] ?? null,
                'meta' => [
                    'checkout_source' => 'web',
                ],
            ]);

            foreach ($items as $item) {
                $product = Product::query()->find($item['product_id']);

                OrderItem::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $product?->id,
                    'product_name' => $item['product_name'],
                    'sku' => $item['sku'] ?? null,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total' => $item['total'],
                    'meta' => [
                        'thumbnail' => $item['thumbnail'] ?? null,
                    ],
                ]);

                if ($product && $product->track_stock) {
                    $product->decrement('stock', $item['quantity']);
                }
            }

            ShippingAddress::query()->create([
                'order_id' => $order->id,
                'name' => $data['name'],
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'],
                'address_line1' => $data['address_line1'],
                'address_line2' => $data['address_line2'] ?? null,
                'city' => $data['city'],
                'state' => $data['state'],
                'postal_code' => $data['postal_code'],
                'country' => $data['country'] ?? 'India',
                'landmark' => $data['landmark'] ?? null,
            ]);

            return $order;
        });

        $cartService->clear($brand->slug);

        if ($data['payment_method'] === 'razorpay' && $this->razorpayConfigured()) {
            try {
                $api = $this->makeRazorpayClient();
                $razorpayOrder = $api->order->create([
                    'receipt' => $order->order_number,
                    'amount' => (int) round($order->grand_total * 100),
                    'currency' => $order->currency,
                ]);

                $order->update([
                    'razorpay_order_id' => $razorpayOrder['id'] ?? null,
                ]);

                return view('brands.checkout.razorpay', [
                    'brand' => $brand,
                    'order' => $order->fresh(),
                    'razorpayOrder' => $razorpayOrder,
                    'key' => config('services.razorpay.key_id'),
                ]);
            } catch (\Throwable $exception) {
                Log::error('Failed to initiate Razorpay order', [
                    'order_id' => $order->id,
                    'message' => $exception->getMessage(),
                ]);

                $order->update([
                    'payment_method' => 'cod',
                ]);

                return redirect()
                    ->route('brand.checkout.complete', [$brand, 'order' => $order->order_number])
                    ->with('status', 'Online payment was unavailable. Cash on delivery has been selected.');
            }
        }

        return redirect()->route('brand.checkout.complete', [$brand, 'order' => $order->order_number])
            ->with('status', 'Order confirmed. Our team will reach out shortly.');
    }

    public function complete(Brand $brand, Request $request): View
    {
        $orderNumber = $request->string('order')->toString();

        $order = Order::query()
            ->where('brand_id', $brand->id)
            ->where('order_number', $orderNumber)
            ->with(['items', 'shippingAddress'])
            ->firstOrFail();

        return view('brands.checkout.complete', compact('brand', 'order'));
    }

    public function razorpayCallback(Request $request, Brand $brand): RedirectResponse
    {
        $payload = $request->validate([
            'order_number' => ['required', 'string'],
            'razorpay_payment_id' => ['required', 'string'],
            'razorpay_order_id' => ['required', 'string'],
            'razorpay_signature' => ['required', 'string'],
        ]);

        $order = Order::query()
            ->where('order_number', $payload['order_number'])
            ->where('brand_id', $brand->id)
            ->firstOrFail();

        abort_unless($order->razorpay_order_id === $payload['razorpay_order_id'], 403);

        try {
            $api = $this->makeRazorpayClient();
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $payload['razorpay_order_id'],
                'razorpay_payment_id' => $payload['razorpay_payment_id'],
                'razorpay_signature' => $payload['razorpay_signature'],
            ]);

            $order->update([
                'payment_status' => 'paid',
                'status' => 'processing',
                'razorpay_payment_id' => $payload['razorpay_payment_id'],
                'razorpay_signature' => $payload['razorpay_signature'],
                'paid_at' => now(),
            ]);

            return redirect()->route('brand.checkout.complete', [$brand, 'order' => $order->order_number])
                ->with('status', 'Payment successful. Thank you!');
        } catch (\Throwable $exception) {
            Log::error('Razorpay payment verification failed', [
                'order_id' => $order->id,
                'message' => $exception->getMessage(),
            ]);

            return redirect()->route('brand.checkout.complete', [$brand, 'order' => $order->order_number])
                ->with('status', 'We could not verify your payment. Our support team will contact you.');
        }
    }

    protected function razorpayConfigured(): bool
    {
        return filled(config('services.razorpay.key_id')) && filled(config('services.razorpay.key_secret'));
    }

    protected function makeRazorpayClient(): Api
    {
        return new Api(
            config('services.razorpay.key_id'),
            config('services.razorpay.key_secret')
        );
    }
}
