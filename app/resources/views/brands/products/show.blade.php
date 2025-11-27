<x-layouts.public>
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid gap-10 lg:grid-cols-5">
            <div class="lg:col-span-3">
                <div class="aspect-[4/3] overflow-hidden rounded-2xl border border-slate-200 bg-white">
                    @php
                        $primaryImage = $product->images()->where('is_primary', true)->first();
                    @endphp
                    @if($primaryImage)
                        <img src="{{ $primaryImage->path }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                    @else
                        <div class="flex h-full items-center justify-center text-slate-400">Image coming soon</div>
                    @endif
                </div>
            </div>
            <div class="lg:col-span-2">
                <p class="text-xs uppercase tracking-widest text-slate-400">{{ $product->type }}</p>
                <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ $product->name }}</h1>
                <p class="mt-3 text-sm text-slate-500">SKU {{ $product->sku }}</p>
                <div class="mt-4 text-2xl font-semibold text-slate-900">₹{{ number_format($product->sale_price ?? $product->price, 2) }}</div>

                <div class="mt-6 prose prose-slate max-w-none">
                    {!! $product->description !!}
                </div>

                <form action="{{ route('brand.cart.store', [$brand, $product]) }}" method="POST" class="mt-8 space-y-4">
                    @csrf
                    <div>
                        <label class="text-sm font-medium text-slate-700">Quantity</label>
                        <input type="number" name="quantity" min="1" value="1" class="mt-1 w-24 rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none">
                    </div>
                    <button type="submit" class="w-full rounded-md bg-[var(--brand-primary)] px-4 py-3 text-sm font-semibold text-white hover:bg-[var(--brand-secondary)]">Add to cart</button>
                </form>

                <div class="mt-8 space-y-3">
                    @foreach(($product->attributes ?? []) as $key => $value)
                        <div class="rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm"><span class="font-semibold capitalize">{{ str_replace('_', ' ', $key) }}:</span> {{ $value }}</div>
                    @endforeach
                </div>
            </div>
        </div>

        @if($related->isNotEmpty())
            <div class="mt-16">
                <h2 class="text-xl font-semibold text-slate-900">You might also like</h2>
                <div class="mt-6 grid gap-6 md:grid-cols-3">
                    @foreach($related as $item)
                        <a href="{{ route('brand.products.show', [$brand, $item]) }}" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:border-slate-400">
                            <p class="text-xs uppercase tracking-wide text-slate-400">{{ $item->type }}</p>
                            <p class="mt-2 text-sm font-semibold text-slate-900">{{ $item->name }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
</x-layouts.public>
