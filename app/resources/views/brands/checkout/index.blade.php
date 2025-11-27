<x-layouts.public>
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-3xl font-semibold text-slate-900">Checkout</h1>
        <p class="mt-2 text-sm text-slate-500">Provide delivery and payment information to confirm your order.</p>

        <div class="mt-10 grid gap-10 lg:grid-cols-5">
            <form action="{{ route('brand.checkout.store', $brand) }}" method="POST" class="space-y-5 lg:col-span-3">
                @csrf
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm space-y-4">
                    <h2 class="text-lg font-semibold text-slate-900">Contact details</h2>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="text-sm font-medium text-slate-700">Full name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 w-full rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none">
                        </div>
                        <div>
                            <label class="text-sm font-medium text-slate-700">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required class="mt-1 w-full rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none">
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm space-y-4">
                    <h2 class="text-lg font-semibold text-slate-900">Shipping address</h2>
                    <div>
                        <label class="text-sm font-medium text-slate-700">Address line 1</label>
                        <input type="text" name="address_line1" value="{{ old('address_line1') }}" required class="mt-1 w-full rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700">Address line 2</label>
                        <input type="text" name="address_line2" value="{{ old('address_line2') }}" class="mt-1 w-full rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none">
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="text-sm font-medium text-slate-700">City</label>
                            <input type="text" name="city" value="{{ old('city') }}" required class="mt-1 w-full rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none">
                        </div>
                        <div>
                            <label class="text-sm font-medium text-slate-700">State</label>
                            <input type="text" name="state" value="{{ old('state') }}" required class="mt-1 w-full rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none">
                        </div>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="text-sm font-medium text-slate-700">Postal code</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code') }}" required class="mt-1 w-full rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none">
                        </div>
                        <div>
                            <label class="text-sm font-medium text-slate-700">Country</label>
                            <input type="text" name="country" value="{{ old('country', 'India') }}" class="mt-1 w-full rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700">Landmark / Notes</label>
                        <textarea name="landmark" rows="3" class="mt-1 w-full rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none">{{ old('landmark') }}</textarea>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700">Order notes</label>
                        <textarea name="notes" rows="3" class="mt-1 w-full rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm space-y-4">
                    <h2 class="text-lg font-semibold text-slate-900">Payment method</h2>
                    <label class="flex items-center gap-3 rounded-lg border border-slate-200 px-4 py-3">
                        <input type="radio" name="payment_method" value="cod" {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }}>
                        <span>
                            <span class="block text-sm font-semibold text-slate-900">Cash on Delivery</span>
                            <span class="text-xs text-slate-500">Pay at delivery. Ideal for bulk shipments and institutional orders.</span>
                        </span>
                    </label>
                    <label class="flex items-center gap-3 rounded-lg border border-slate-200 px-4 py-3">
                        <input type="radio" name="payment_method" value="razorpay" {{ old('payment_method') === 'razorpay' ? 'checked' : '' }}>
                        <span>
                            <span class="block text-sm font-semibold text-slate-900">Razorpay (UPI / Cards)</span>
                            <span class="text-xs text-slate-500">Secure online payment powered by Razorpay.</span>
                        </span>
                    </label>
                </div>

                <button type="submit" class="w-full rounded-md bg-[var(--brand-primary)] px-4 py-3 text-sm font-semibold text-white hover:bg-[var(--brand-secondary)]">Place order</button>
            </form>

            <aside class="lg:col-span-2 space-y-6">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-slate-900">Order summary</h2>
                    <div class="mt-4 space-y-3 text-sm">
                        @foreach($items as $item)
                            <div class="flex justify-between">
                                <span>{{ $item['product_name'] }} × {{ $item['quantity'] }}</span>
                                <span>₹{{ number_format($item['total'], 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                    <dl class="mt-6 space-y-2 text-sm">
                        <div class="flex justify-between text-slate-600"><dt>Subtotal</dt><dd>₹{{ number_format($totals['subtotal'], 2) }}</dd></div>
                        <div class="flex justify-between text-slate-600"><dt>Shipping</dt><dd>{{ $totals['shipping'] > 0 ? '₹'.number_format($totals['shipping'], 2) : 'Free' }}</dd></div>
                        <div class="flex justify-between text-slate-600"><dt>Tax</dt><dd>₹{{ number_format($totals['tax'], 2) }}</dd></div>
                        <div class="flex justify-between border-t border-slate-200 pt-2 text-base font-semibold text-slate-900"><dt>Total</dt><dd>₹{{ number_format($totals['grand_total'], 2) }}</dd></div>
                    </dl>
                </div>
                <div class="rounded-2xl border border-blue-100 bg-blue-50 p-6 text-sm text-blue-700">
                    <p class="font-semibold">Need assistance?</p>
                    <p class="mt-2">Call {{ $brand->contact_phone ?? '+91-90000-00000' }} or email {{ $brand->contact_email ?? 'support@example.com' }} for order support.</p>
                </div>
            </aside>
        </div>
    </section>
</x-layouts.public>
