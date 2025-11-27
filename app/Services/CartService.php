<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected function sessionKey(string $brandSlug): string
    {
        return "cart.{$brandSlug}";
    }

    /**
     * Retrieve current cart items for a brand.
     *
     * @return Collection<int, array<string, mixed>>
     */
    public function items(string $brandSlug): Collection
    {
        return collect(Session::get($this->sessionKey($brandSlug), []));
    }

    public function addProduct(string $brandSlug, Product $product, int $quantity = 1): void
    {
        $items = $this->items($brandSlug)
            ->keyBy('product_id');

        if ($items->has($product->id)) {
            $entry = $items->get($product->id);
            $entry['quantity'] += $quantity;
            $entry['total'] = $entry['quantity'] * $entry['unit_price'];
            $items->put($product->id, $entry);
        } else {
            $items->put($product->id, [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'slug' => $product->slug,
                'quantity' => $quantity,
                'unit_price' => (float) ($product->sale_price ?? $product->price),
                'total' => $quantity * (float) ($product->sale_price ?? $product->price),
                'sku' => $product->sku,
                'thumbnail' => $product->images()->orderBy('sort_order')->first()?->path,
            ]);
        }

        Session::put($this->sessionKey($brandSlug), $items->values()->all());
    }

    public function updateQuantity(string $brandSlug, int $productId, int $quantity): void
    {
        $items = $this->items($brandSlug)->map(function ($item) use ($productId, $quantity) {
            if ($item['product_id'] === $productId) {
                $item['quantity'] = max(1, $quantity);
                $item['total'] = $item['quantity'] * $item['unit_price'];
            }

            return $item;
        });

        Session::put($this->sessionKey($brandSlug), $items->all());
    }

    public function removeItem(string $brandSlug, int $productId): void
    {
        $items = $this->items($brandSlug)
            ->reject(fn ($item) => $item['product_id'] === $productId)
            ->values();

        Session::put($this->sessionKey($brandSlug), $items->all());
    }

    public function clear(string $brandSlug): void
    {
        Session::forget($this->sessionKey($brandSlug));
    }

    public function totals(string $brandSlug): array
    {
        $items = $this->items($brandSlug);

        $subtotal = $items->sum('total');
        $shipping = $subtotal >= 2000 ? 0 : 120;
        $tax = round($subtotal * 0.05, 2);
        $grandTotal = $subtotal + $shipping + $tax;

        return [
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'tax' => $tax,
            'grand_total' => $grandTotal,
        ];
    }
}
