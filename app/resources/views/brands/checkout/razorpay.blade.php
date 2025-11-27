<x-layouts.public>
    <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <h1 class="text-3xl font-semibold text-slate-900">Secure Payment</h1>
        <p class="mt-3 text-sm text-slate-500">Complete your Razorpay payment to confirm order {{ $order->order_number }}.</p>

        <div class="mt-8 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm text-left">
            <dl class="space-y-2 text-sm text-slate-600">
                <div class="flex justify-between"><dt>Order number</dt><dd>{{ $order->order_number }}</dd></div>
                <div class="flex justify-between font-semibold text-slate-900"><dt>Amount payable</dt><dd>₹{{ number_format($order->grand_total, 2) }}</dd></div>
            </dl>
            <p class="mt-6 text-sm text-slate-500">Click the button below to launch the Razorpay checkout. Once successful, you will be redirected automatically.</p>
            <button id="rzp-button" class="mt-6 w-full rounded-md bg-[var(--brand-primary)] px-4 py-3 text-sm font-semibold text-white hover:bg-[var(--brand-secondary)]">Pay with Razorpay</button>
            <a href="{{ route('brand.checkout.complete', [$brand, 'order' => $order->order_number]) }}" class="mt-4 inline-block w-full rounded-md border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 hover:border-slate-400">Switch to COD</a>
        </div>
    </section>

    <form id="razorpay-callback" action="{{ route('brand.checkout.razorpay', $brand) }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="order_number" value="{{ $order->order_number }}">
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_order_id" value="{{ $order->razorpay_order_id }}">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
    </form>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        const button = document.getElementById('rzp-button');
        const options = {
            key: '{{ $key }}',
            amount: {{ (int) round($order->grand_total * 100) }},
            currency: '{{ $order->currency }}',
            name: '{{ $brand->name }}',
            description: 'Order {{ $order->order_number }}',
            order_id: '{{ $order->razorpay_order_id }}',
            prefill: {
                name: '{{ optional($order->shippingAddress)->name }}',
                email: '{{ optional($order->shippingAddress)->email }}',
                contact: '{{ optional($order->shippingAddress)->phone }}'
            },
            theme: {
                color: '{{ $brand->primary_color ?? '#0f172a' }}'
            },
            handler: function (response) {
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                document.getElementById('razorpay-callback').submit();
            }
        };

        button.addEventListener('click', function () {
            const rzp = new Razorpay(options);
            rzp.open();
        });
    </script>
</x-layouts.public>
