<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Brand overview</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100 p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">{{ $brand->name }}</h1>
                        <p class="text-sm text-gray-500">{{ $brand->tagline }}</p>
                    </div>
                    <a href="{{ route('admin.brands.edit', $brand) }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Edit</a>
                </div>
                <div class="grid gap-4 md:grid-cols-2 text-sm text-gray-600">
                    <div>
                        <p class="font-semibold text-gray-800">Contact</p>
                        <p>{{ $brand->contact_email }}</p>
                        <p>{{ $brand->contact_phone }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Colors</p>
                        <p>Primary: {{ $brand->primary_color }}</p>
                        <p>Secondary: {{ $brand->secondary_color }}</p>
                    </div>
                </div>
                <div class="prose prose-sm max-w-none">{!! $brand->about_content !!}</div>
            </div>
        </div>
    </div>
</x-app-layout>
