@php use Illuminate\Support\Str; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Research project</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100 p-6 space-y-4 text-sm text-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-400">{{ $researchProject->brand->name }}</p>
                        <h1 class="text-2xl font-semibold text-gray-900">{{ $researchProject->title }}</h1>
                    </div>
                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-gray-600">{{ Str::headline($researchProject->status) }}</span>
                </div>
                <div>Focus area: {{ $researchProject->focus_area }}</div>
                <div class="prose prose-sm max-w-none">{!! $researchProject->content !!}</div>
            </div>
        </div>
    </div>
</x-app-layout>
