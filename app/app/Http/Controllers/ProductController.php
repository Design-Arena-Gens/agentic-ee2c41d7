<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, Brand $brand): View
    {
        $query = $brand->products()->where('is_active', true);

        if ($search = $request->string('q')->trim()) {
            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        $products = $query->latest('published_at')->paginate(12)->withQueryString();

        return view('brands.products.index', compact('brand', 'products'));
    }

    public function show(Brand $brand, Product $product): View
    {
        abort_unless($product->brand_id === $brand->id && $product->is_active, 404);

        $related = $brand->products()
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->latest('published_at')
            ->limit(4)
            ->get();

        return view('brands.products.show', compact('brand', 'product', 'related'));
    }
}
