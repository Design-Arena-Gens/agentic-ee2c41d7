<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lead details</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100 p-6 space-y-4 text-sm text-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">{{ $lead->name }}</h1>
                        <p class="text-xs text-gray-500">{{ $lead->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-gray-600">{{ ucfirst($lead->interest) }}</span>
                </div>
                <div>Email: {{ $lead->email ?? 'N/A' }}</div>
                <div>Phone: {{ $lead->phone ?? 'N/A' }}</div>
                <div>Organization: {{ $lead->organization ?? 'N/A' }}</div>
                <div>Brand preference: {{ $lead->brand?->name ?? 'Not specified' }}</div>
                <div class="border-t border-gray-200 pt-4 text-gray-700">{{ $lead->message }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
