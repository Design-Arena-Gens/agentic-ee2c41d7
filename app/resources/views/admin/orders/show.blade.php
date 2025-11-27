@php use Illuminate\Support\Str; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Order {{ $order->order_number }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100 p-6 space-y-4 text-sm text-gray-600">
                <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-400">{{ $order->brand->name }}</p>
                        <h1 class="text-2xl font-semibold text-gray-900">{{ $order->order_number }}</h1>
                        <p class="text-xs text-gray-500">Placed {{ $order->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="text-right text-sm text-gray-600">
                        <div>Total: <span class="font-semibold text-gray-900">₹{{ number_format($order->grand_total, 2) }}</span></div>
                        <div>Payment: {{ Str::headline($order->payment_status) }}</div>
                    </div>
                </div>

                <div class="rounded-xl border border-gray-200 p-5">
                    <h3 class="text-sm font-semibold text-gray-900">Shipping</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        {{ $order->shippingAddress->name }}<br>
                        {{ $order->shippingAddress->address_line1 }} {{ $order->shippingAddress->address_line2 }}<br>
                        {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} - {{ $order->shippingAddress->postal_code }}<br>
                        {{ $order->shippingAddress->country }}<br>
                        {{ $order->shippingAddress->phone }}
                    </p>
                </div>

                <div class="rounded-xl border border-gray-200 p-5">
                    <h3 class="text-sm font-semibold text-gray-900">Items</h3>
                    <div class="mt-3 space-y-3">
                        @foreach($order->items as $item)
                            <div class="flex items-center justify-between text-sm">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $item->product_name }}</p>
                                    <p class="text-xs text-gray-500">Qty {{ $item->quantity }} · ₹{{ number_format($item->unit_price, 2) }}</p>
                                </div>
                                <div class="font-semibold text-gray-900">₹{{ number_format($item->total, 2) }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100 p-6">
                <h3 class="text-sm font-semibold text-gray-900">Update status</h3>
                <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="mt-4 grid gap-4 md:grid-cols-2 text-sm">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="font-medium text-gray-700">Order status</label>
                        <select name="status" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
                            @foreach(['pending','processing','completed','cancelled','refunded'] as $status)
                                <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="font-medium text-gray-700">Payment status</label>
                        <select name="payment_status" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
                            @foreach(['pending','paid','failed','refunded'] as $status)
                                <option value="{{ $status }}" @selected($order->payment_status === $status)>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="font-medium text-gray-700">Shipping status</label>
                        <select name="shipping_status" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
                            @foreach(['pending','packed','shipped','delivered','returned'] as $status)
                                <option value="{{ $status }}" @selected($order->shipping_status === $status)>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="font-medium text-gray-700">Tracking number</label>
                        <input type="text" name="tracking_number" value="{{ old('tracking_number', $order->tracking_number) }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
                    </div>
                    <div class="md:col-span-2">
                        <label class="font-medium text-gray-700">Internal notes</label>
                        <textarea name="internal_notes" rows="3" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('internal_notes', $order->internal_notes) }}</textarea>
                    </div>
                    <div class="md:col-span-2 flex justify-end">
                        <button class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Update order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
