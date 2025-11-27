@csrf
<div class="grid gap-6 lg:grid-cols-2">
    <div class="space-y-4">
        <div>
            <label class="text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $product->slug ?? '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Brand</label>
            <select name="brand_id" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
                @foreach($brands as $brandOption)
                    <option value="{{ $brandOption->id }}" @selected(old('brand_id', $product->brand_id ?? request('brand_id')) == $brandOption->id)>{{ $brandOption->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="text-sm font-medium text-gray-700">Price</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}" required class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700">Sale price</label>
                <input type="number" step="0.01" name="sale_price" value="{{ old('sale_price', $product->sale_price ?? '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
            </div>
        </div>
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="text-sm font-medium text-gray-700">SKU</label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700">Type</label>
                <select name="type" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
                    @foreach(['physical','digital','service'] as $type)
                        <option value="{{ $type }}" @selected(old('type', $product->type ?? 'physical') === $type)>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="text-sm font-medium text-gray-700">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
            </div>
            <div class="flex items-center gap-4 mt-6">
                <label class="inline-flex items-center gap-2 text-sm text-gray-700"><input type="checkbox" name="track_stock" value="1" @checked(old('track_stock', $product->track_stock ?? true))> Track stock</label>
                <label class="inline-flex items-center gap-2 text-sm text-gray-700"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))> Active</label>
            </div>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Primary image URL</label>
            <input type="url" name="primary_image" value="{{ old('primary_image', $product->images()->where('is_primary', true)->first()->path ?? '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
    </div>

    <div class="space-y-4">
        <div>
            <label class="text-sm font-medium text-gray-700">Short description</label>
            <textarea name="short_description" rows="3" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('short_description', $product->short_description ?? '') }}</textarea>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Full description (HTML)</label>
            <textarea name="description" rows="8" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('description', $product->description ?? '') }}</textarea>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Attributes (JSON)</label>
            <textarea name="attributes" rows="4" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('attributes', isset($product) && $product->attributes ? json_encode($product->attributes, JSON_PRETTY_PRINT) : '') }}</textarea>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Shipping profile (JSON)</label>
            <textarea name="shipping_profile" rows="4" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('shipping_profile', isset($product) && $product->shipping_profile ? json_encode($product->shipping_profile, JSON_PRETTY_PRINT) : '') }}</textarea>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">SEO metadata (JSON)</label>
            <textarea name="seo" rows="4" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('seo', isset($product) && $product->seo ? json_encode($product->seo, JSON_PRETTY_PRINT) : '') }}</textarea>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Published at</label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at', isset($product) && $product->published_at ? $product->published_at->format('Y-m-d\TH:i') : '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
    </div>
</div>

<div class="mt-6 flex justify-end gap-3">
    <a href="{{ route('admin.products.index') }}" class="rounded-md border border-gray-200 px-4 py-2 text-sm">Cancel</a>
    <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Save product</button>
</div>
