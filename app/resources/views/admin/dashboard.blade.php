@php use Illuminate\Support\Str; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Operations Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid gap-6 md:grid-cols-3">
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
                    <p class="text-xs uppercase tracking-widest text-gray-400">Orders today</p>
                    <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $metrics['orders_today'] }}</p>
                    <p class="text-xs text-gray-500">Pending: {{ $metrics['orders_pending'] }}</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
                    <p class="text-xs uppercase tracking-widest text-gray-400">Revenue (MTD)</p>
                    <p class="mt-3 text-3xl font-semibold text-gray-900">₹{{ number_format($metrics['revenue_mtd'], 2) }}</p>
                    <p class="text-xs text-gray-500">Paid orders this month</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
                    <p class="text-xs uppercase tracking-widest text-gray-400">Catalogue health</p>
                    <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $metrics['active_products'] }} active</p>
                    <p class="text-xs text-gray-500">{{ $metrics['research_projects'] }} research initiatives live</p>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Recent orders</h3>
                        <a href="{{ route('admin.orders.index') }}" class="text-sm text-indigo-600">View all</a>
                    </div>
                    <div class="mt-4 space-y-3 text-sm text-gray-600">
                        @foreach($recentOrders as $order)
                            <div class="rounded-xl border border-gray-100 px-4 py-3">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-gray-900">{{ $order->order_number }}</span>
                                    <span class="text-xs uppercase tracking-widest text-gray-400">{{ $order->created_at->format('d M H:i') }}</span>
                                </div>
                                <div class="mt-1 flex items-center justify-between text-xs text-gray-500">
                                    <span>{{ $order->brand->name }}</span>
                                    <span class="font-medium text-gray-900">₹{{ number_format($order->grand_total, 2) }}</span>
                                </div>
                                <div class="mt-1 text-xs text-gray-500">Status: {{ Str::headline($order->status) }} · Payment: {{ Str::headline($order->payment_status) }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">New leads</h3>
                        <a href="{{ route('admin.leads.index') }}" class="text-sm text-indigo-600">Manage</a>
                    </div>
                    <div class="mt-4 space-y-3 text-sm text-gray-600">
                        @foreach($recentLeads as $lead)
                            <div class="rounded-xl border border-gray-100 px-4 py-3">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-gray-900">{{ $lead->name }}</span>
                                    <span class="text-xs uppercase tracking-widest text-gray-400">{{ $lead->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="mt-1 text-xs text-gray-500">{{ $lead->email ?? 'No email' }} · {{ $lead->phone ?? 'No phone' }}</div>
                                <div class="mt-1 text-xs text-gray-500">Interest: {{ Str::headline($lead->interest) }} @if($lead->brand) · {{ $lead->brand->name }} @endif</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
