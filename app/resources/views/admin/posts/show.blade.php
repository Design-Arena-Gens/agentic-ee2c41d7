@php use Illuminate\Support\Str; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Post</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100 p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-400">{{ $post->brand->name }}</p>
                        <h1 class="text-2xl font-semibold text-gray-900">{{ $post->title }}</h1>
                    </div>
                    <a href="{{ route('admin.posts.edit', $post) }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Edit</a>
                </div>
                <div class="text-sm text-gray-500">Status: {{ Str::headline($post->status) }} · {{ optional($post->published_at)->format('d M Y') }}</div>
                <div class="prose prose-sm max-w-none">
                    {!! $post->body !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
