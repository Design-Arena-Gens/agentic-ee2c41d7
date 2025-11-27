<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Product overview</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100 p-6 space-y-4 text-sm text-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-400">{{ $product->brand->name }}</p>
                        <h1 class="text-2xl font-semibold text-gray-900">{{ $product->name }}</h1>
                    </div>
                    <a href="{{ route('admin.products.edit', $product) }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Edit</a>
                </div>
                <div>SKU: {{ $product->sku }}</div>
                <div>Price: ₹{{ number_format($product->sale_price ?? $product->price, 2) }}</div>
                <div>Status: {{ $product->is_active ? 'Active' : 'Inactive' }}</div>
                <div class="prose prose-sm max-w-none">
                    {!! $product->description !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
