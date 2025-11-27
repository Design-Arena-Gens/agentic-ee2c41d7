@php use Illuminate\Support\Str; @endphp
<x-layouts.public>
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-10 shadow-sm">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-emerald-500 text-white">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
            </div>
            <h1 class="mt-6 text-3xl font-semibold text-emerald-900">Order Confirmed</h1>
            <p class="mt-3 text-sm text-emerald-700">We have received your order {{ $order->order_number }}. Our fulfilment team will connect with you soon.</p>
            <div class="mt-8 text-left text-sm text-slate-600">
                <h2 class="text-base font-semibold text-slate-900">Order details</h2>
                <dl class="mt-3 space-y-1">
                    <div class="flex justify-between"><dt>Status</dt><dd class="font-medium text-slate-900">{{ Str::headline($order->status) }}</dd></div>
                    <div class="flex justify-between"><dt>Payment</dt><dd>{{ Str::headline($order->payment_status) }}</dd></div>
                    <div class="flex justify-between"><dt>Amount</dt><dd>₹{{ number_format($order->grand_total, 2) }}</dd></div>
                </dl>
                <div class="mt-4 rounded-xl border border-slate-200 bg-white p-6">
                    <h3 class="text-sm font-semibold text-slate-900">Shipping to</h3>
                    <p class="mt-2 text-sm text-slate-600">
                        {{ $order->shippingAddress->name }}<br>
                        {{ $order->shippingAddress->address_line1 }} {{ $order->shippingAddress->address_line2 }}<br>
                        {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} - {{ $order->shippingAddress->postal_code }}<br>
                        {{ $order->shippingAddress->country }}<br>
                        {{ $order->shippingAddress->phone }}
                    </p>
                </div>
            </div>
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <a href="{{ route('brand.orders.track', $brand) }}?order_number={{ $order->order_number }}" class="rounded-full border border-emerald-400 px-5 py-2 text-sm font-semibold text-emerald-700">Track order</a>
                <a href="{{ route('brand.products.index', $brand) }}" class="rounded-full bg-emerald-500 px-5 py-2 text-sm font-semibold text-white">Continue browsing</a>
            </div>
        </div>
    </section>
</x-layouts.public>
