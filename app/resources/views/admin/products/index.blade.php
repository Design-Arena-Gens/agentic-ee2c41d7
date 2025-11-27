<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Add product</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6">
                    <form method="GET" class="mb-4 flex flex-wrap items-center gap-3 text-sm">
                        <select name="brand_id" class="rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
                            <option value="">All brands</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" @selected(request('brand_id') == $brand->id)>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        <button class="rounded-md border border-gray-200 px-4 py-2 text-sm">Filter</button>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left font-semibold text-gray-600">Product</th>
                                    <th class="px-4 py-2 text-left font-semibold text-gray-600">Brand</th>
                                    <th class="px-4 py-2 text-left font-semibold text-gray-600">Price</th>
                                    <th class="px-4 py-2 text-left font-semibold text-gray-600">Stock</th>
                                    <th class="px-4 py-2 text-right font-semibold text-gray-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($products as $product)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="font-semibold text-gray-900">{{ $product->name }}</div>
                                            <div class="text-xs text-gray-500">SKU {{ $product->sku }}</div>
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">{{ $product->brand->name }}</td>
                                        <td class="px-4 py-3 text-gray-600">₹{{ number_format($product->sale_price ?? $product->price, 2) }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ $product->track_stock ? $product->stock : 'N/A' }}</td>
                                        <td class="px-4 py-3 text-right">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-500">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
