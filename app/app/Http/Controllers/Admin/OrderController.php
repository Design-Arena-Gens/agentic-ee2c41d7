<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $brands = Brand::query()->orderBy('name')->get();

        $orders = Order::query()
            ->with(['brand', 'shippingAddress'])
            ->when($request->filled('brand_id'), fn ($query) => $query->where('brand_id', $request->integer('brand_id')))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->latest('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.orders.index', compact('orders', 'brands'));
    }

    public function show(Order $order): View
    {
        $order->load(['brand', 'items.product', 'shippingAddress']);

        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,processing,completed,cancelled,refunded'],
            'payment_status' => ['required', 'in:pending,paid,failed,refunded'],
            'shipping_status' => ['required', 'in:pending,packed,shipped,delivered,returned'],
            'tracking_number' => ['nullable', 'string', 'max:120'],
            'internal_notes' => ['nullable', 'string'],
        ]);

        if ($data['payment_status'] === 'paid' && blank($order->paid_at)) {
            $order->paid_at = now();
        }

        $order->fill($data)->save();

        return redirect()->route('admin.orders.show', $order)->with('status', 'Order updated successfully.');
    }
}
