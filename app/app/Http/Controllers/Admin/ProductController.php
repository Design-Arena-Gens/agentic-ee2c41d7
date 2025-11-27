<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $brands = Brand::query()->orderBy('name')->get();

        $products = Product::query()
            ->with('brand')
            ->when($request->filled('brand_id'), fn ($query) => $query->where('brand_id', $request->integer('brand_id')))
            ->latest('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.products.index', compact('products', 'brands'));
    }

    public function create(): View
    {
        $brands = Brand::query()->orderBy('name')->get();

        return view('admin.products.create', compact('brands'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        $product = Product::query()->create($data);

        $this->syncPrimaryImage($product, $request->input('primary_image'));

        return redirect()->route('admin.products.edit', $product)->with('status', 'Product created successfully.');
    }

    public function show(Product $product): View
    {
        $product->load(['brand', 'images']);

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $brands = Brand::query()->orderBy('name')->get();
        $product->load('images');

        return view('admin.products.edit', compact('product', 'brands'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $this->validatedData($request, $product);

        $product->update($data);

        $this->syncPrimaryImage($product, $request->input('primary_image'));

        return redirect()->route('admin.products.edit', $product)->with('status', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('status', 'Product removed.');
    }

    protected function validatedData(Request $request, ?Product $product = null): array
    {
        $data = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:190'],
            'slug' => ['nullable', 'string', 'max:190', 'unique:products,slug,'.($product->id ?? 'NULL').',id'],
            'sku' => ['nullable', 'string', 'max:190', 'unique:products,sku,'.($product->id ?? 'NULL').',id'],
            'type' => ['required', 'in:physical,digital,service'],
            'short_description' => ['nullable', 'string', 'max:280'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'sale_price' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'track_stock' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'attributes' => ['nullable', 'string'],
            'shipping_profile' => ['nullable', 'string'],
            'seo' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
        ]);

        $data['track_stock'] = $request->boolean('track_stock');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['attributes'] = $this->decodeJson($data['attributes'] ?? null);
        $data['shipping_profile'] = $this->decodeJson($data['shipping_profile'] ?? null);
        $data['seo'] = $this->decodeJson($data['seo'] ?? null);

        return $data;
    }

    protected function decodeJson(?string $value): ?array
    {
        if (blank($value)) {
            return null;
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : null;
    }

    protected function syncPrimaryImage(Product $product, ?string $primaryImage): void
    {
        if (blank($primaryImage)) {
            return;
        }

        /** @var ProductImage|null $existing */
        $existing = $product->images()->where('is_primary', true)->first();

        if ($existing) {
            $existing->update([
                'path' => $primaryImage,
            ]);
        } else {
            $product->images()->create([
                'path' => $primaryImage,
                'is_primary' => true,
            ]);
        }
    }
}
