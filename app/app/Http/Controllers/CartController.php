<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Brand $brand, CartService $cartService): View
    {
        $items = $cartService->items($brand->slug);
        $totals = $cartService->totals($brand->slug);

        return view('brands.cart.index', compact('brand', 'items', 'totals'));
    }

    public function store(Request $request, Brand $brand, Product $product, CartService $cartService): RedirectResponse
    {
        abort_unless($product->brand_id === $brand->id, 404);

        $data = $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1', 'max:999'],
        ]);

        $cartService->addProduct($brand->slug, $product, $data['quantity'] ?? 1);

        return back()->with('status', "{$product->name} added to cart.");
    }

    public function update(Request $request, Brand $brand, CartService $cartService): RedirectResponse
    {
        $data = $request->validate([
            'items' => ['required', 'array'],
            'items.*.product_id' => ['required', 'integer'],
            'items.*.quantity' => ['required', 'integer', 'min:1', 'max:999'],
        ]);

        if ($request->filled('remove')) {
            $cartService->removeItem($brand->slug, (int) $request->integer('remove'));

            return back()->with('status', 'Item removed from cart.');
        }

        foreach ($data['items'] as $item) {
            $cartService->updateQuantity($brand->slug, $item['product_id'], $item['quantity']);
        }

        return back()->with('status', 'Cart updated successfully.');
    }

    public function destroy(Brand $brand, Product $product, CartService $cartService): RedirectResponse
    {
        $cartService->removeItem($brand->slug, $product->id);

        return back()->with('status', "{$product->name} removed from cart.");
    }
}
