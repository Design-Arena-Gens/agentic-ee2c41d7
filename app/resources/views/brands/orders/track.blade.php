@php use Illuminate\Support\Str; @endphp
<x-layouts.public>
    <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-3xl font-semibold text-slate-900">Track your order</h1>
        <p class="mt-2 text-sm text-slate-500">Enter the order number shared via email or SMS.</p>

        <form method="GET" class="mt-8 flex gap-3">
            <input type="text" name="order_number" value="{{ $orderNumber }}" placeholder="ORD-XXXXXXXXXX" class="flex-1 rounded-full border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none" required>
            <button class="rounded-full bg-[var(--brand-primary)] px-5 py-2 text-sm font-semibold text-white hover:bg-[var(--brand-secondary)]">Track</button>
        </form>

        @if($order)
            <div class="mt-10 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900">Order {{ $order->order_number }}</h2>
                <dl class="mt-4 space-y-2 text-sm text-slate-600">
                    <div class="flex justify-between"><dt>Order status</dt><dd>{{ Str::headline($order->status) }}</dd></div>
                    <div class="flex justify-between"><dt>Payment</dt><dd>{{ Str::headline($order->payment_status) }}</dd></div>
                    <div class="flex justify-between"><dt>Shipping</dt><dd>{{ Str::headline($order->shipping_status) }}</dd></div>
                    @if($order->tracking_number)
                        <div class="flex justify-between"><dt>Tracking number</dt><dd>{{ $order->tracking_number }}</dd></div>
                    @endif
                </dl>
                <div class="mt-4 text-xs text-slate-400">Placed {{ $order->created_at->format('d M Y, h:i A') }}</div>
            </div>
        @elseif($orderNumber)
            <p class="mt-8 text-sm text-red-500">No order found for {{ $orderNumber }}. Please double-check the reference or contact support.</p>
        @endif
    </section>
</x-layouts.public>
