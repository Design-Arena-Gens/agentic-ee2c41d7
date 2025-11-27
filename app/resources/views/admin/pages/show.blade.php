<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Page</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100 p-6 space-y-4 text-sm text-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">{{ $page->title }}</h1>
                        <p class="text-xs text-gray-500">Brand: {{ $page->brand->name }} · Slug: {{ $page->slug }}</p>
                    </div>
                    <a href="{{ route('admin.pages.edit', $page) }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Edit</a>
                </div>
                <div class="prose prose-sm max-w-none">{!! $page->content !!}</div>
            </div>
        </div>
    </div>
</x-app-layout>
