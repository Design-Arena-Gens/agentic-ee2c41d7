<x-layouts.public>
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-3xl font-semibold text-slate-900">Cart</h1>
        <p class="mt-2 text-sm text-slate-500">Review your selections before checkout.</p>

        @if($items->isEmpty())
            <div class="mt-10 rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center">
                <p class="text-sm text-slate-500">Your cart is empty. Browse the catalogue to add items.</p>
                <a href="{{ route('brand.products.index', $brand) }}" class="mt-4 inline-flex rounded-full bg-[var(--brand-primary)] px-4 py-2 text-sm font-semibold text-white">Browse products</a>
            </div>
        @else
            <form action="{{ route('brand.cart.update', $brand) }}" method="POST" class="mt-10 space-y-6">
                @csrf
                @method('PATCH')
                <div class="space-y-4">
                    @foreach($items as $item)
                        <div class="flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm md:flex-row md:items-center md:justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-slate-900">{{ $item['product_name'] }}</h2>
                                <p class="text-xs text-slate-400">SKU {{ $item['sku'] }}</p>
                                <p class="mt-2 text-sm text-slate-600">₹{{ number_format($item['unit_price'], 2) }} per unit</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <div>
                                    <label class="text-xs uppercase tracking-widest text-slate-400">Quantity</label>
                                    <input type="number" name="items[{{ $loop->index }}][quantity]" min="1" value="{{ $item['quantity'] }}" class="mt-1 w-20 rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none">
                                    <input type="hidden" name="items[{{ $loop->index }}][product_id]" value="{{ $item['product_id'] }}">
                                </div>
                                <div class="text-right">
                                    <p class="text-xs uppercase tracking-widest text-slate-400">Total</p>
                                    <p class="text-sm font-semibold text-slate-900">₹{{ number_format($item['total'], 2) }}</p>
                                    <button type="submit" name="remove" value="{{ $item['product_id'] }}" class="mt-2 text-xs text-slate-500 hover:text-red-500">Remove</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex flex-col gap-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm md:flex-row md:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-slate-400">Summary</p>
                        <dl class="mt-3 space-y-2 text-sm">
                            <div class="flex justify-between text-slate-600"><dt>Subtotal</dt><dd>₹{{ number_format($totals['subtotal'], 2) }}</dd></div>
                            <div class="flex justify-between text-slate-600"><dt>Shipping</dt><dd>{{ $totals['shipping'] > 0 ? '₹'.number_format($totals['shipping'], 2) : 'Free' }}</dd></div>
                            <div class="flex justify-between text-slate-600"><dt>Tax (5%)</dt><dd>₹{{ number_format($totals['tax'], 2) }}</dd></div>
                            <div class="flex justify-between border-t border-slate-200 pt-2 text-base font-semibold text-slate-900"><dt>Total</dt><dd>₹{{ number_format($totals['grand_total'], 2) }}</dd></div>
                        </dl>
                    </div>
                    <div class="flex flex-col gap-3">
                        <button type="submit" class="rounded-full border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-700 hover:border-slate-400">Update cart</button>
                        <a href="{{ route('brand.checkout.show', $brand) }}" class="text-center rounded-full bg-[var(--brand-primary)] px-6 py-3 text-sm font-semibold text-white hover:bg-[var(--brand-secondary)]">Proceed to checkout</a>
                    </div>
                </div>
            </form>
        @endif
    </section>
</x-layouts.public>
