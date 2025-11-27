@php use Illuminate\Support\Str; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Orders</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6">
                    <form method="GET" class="mb-4 flex flex-wrap items-center gap-3 text-sm">
                        <select name="brand_id" class="rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
                            <option value="">All brands</option>
                            @foreach($brands as $brandOption)
                                <option value="{{ $brandOption->id }}" @selected(request('brand_id') == $brandOption->id)>{{ $brandOption->name }}</option>
                            @endforeach
                        </select>
                        <select name="status" class="rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
                            <option value="">Any status</option>
                            @foreach(['pending','processing','completed','cancelled','refunded'] as $status)
                                <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                        <button class="rounded-md border border-gray-200 px-4 py-2 text-sm">Filter</button>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left font-semibold text-gray-600">Order</th>
                                    <th class="px-4 py-2 text-left font-semibold text-gray-600">Brand</th>
                                    <th class="px-4 py-2 text-left font-semibold text-gray-600">Amount</th>
                                    <th class="px-4 py-2 text-left font-semibold text-gray-600">Status</th>
                                    <th class="px-4 py-2 text-right font-semibold text-gray-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="font-semibold text-gray-900">{{ $order->order_number }}</div>
                                            <div class="text-xs text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</div>
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">{{ $order->brand->name }}</td>
                                        <td class="px-4 py-3 text-gray-600">₹{{ number_format($order->grand_total, 2) }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ Str::headline($order->status) }}</td>
                                        <td class="px-4 py-3 text-right">
                                            <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-500">Review</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
