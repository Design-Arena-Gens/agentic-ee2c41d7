<x-layouts.public>
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-semibold text-slate-900">{{ $brand->name }} Products</h1>
                <p class="mt-2 text-sm text-slate-500">Explore our curated catalogue for {{ $brand->slug === 'shnikh' ? 'plant tissue culture, nursery, and agri-biotech programs.' : 'cordyceps wellness and functional nutrition.' }}</p>
            </div>
            <form method="GET" class="w-full md:w-72">
                <label class="sr-only">Search products</label>
                <div class="relative">
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Search products" class="w-full rounded-full border border-slate-200 px-4 py-2 pl-10 text-sm focus:border-slate-400 focus:outline-none">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M18 10.5a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" /></svg>
                </div>
            </form>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($products as $product)
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-lg transition">
                    <p class="text-xs uppercase tracking-wide text-slate-400">{{ $product->type }}</p>
                    <h2 class="mt-2 text-lg font-semibold text-slate-900">{{ $product->name }}</h2>
                    <p class="mt-2 text-sm text-slate-600">{{ $product->short_description }}</p>
                    <div class="mt-4 flex items-center justify-between text-sm text-slate-900">
                        <span>₹{{ number_format($product->sale_price ?? $product->price, 2) }}</span>
                        <span class="text-xs uppercase tracking-widest text-slate-400">SKU {{ $product->sku }}</span>
                    </div>
                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('brand.products.show', [$brand, $product]) }}" class="flex-1 rounded-full border border-slate-200 px-4 py-2 text-sm text-slate-700 hover:border-slate-400">Details</a>
                        <form action="{{ route('brand.cart.store', [$brand, $product]) }}" method="POST">
                            @csrf
                            <button type="submit" class="rounded-full bg-[var(--brand-primary)] px-4 py-2 text-sm font-semibold text-white hover:bg-[var(--brand-secondary)]">Add</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-sm text-slate-500">No products available yet.</p>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $products->links() }}
        </div>
    </section>
</x-layouts.public>
