@php use Illuminate\Support\Str; @endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editorial</h2>
            <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">New post</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6">
                    <form method="GET" class="mb-4 flex flex-wrap items-center gap-3 text-sm">
                        <select name="brand_id" class="rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
                            <option value="">All brands</option>
                            @foreach($brands as $brandOption)
                                <option value="{{ $brandOption->id }}" @selected(request('brand_id') == $brandOption->id)>{{ $brandOption->name }}</option>
                            @endforeach
                        </select>
                        <button class="rounded-md border border-gray-200 px-4 py-2 text-sm">Filter</button>
                    </form>

                    <div class="space-y-4">
                        @foreach($posts as $post)
                            <div class="rounded-2xl border border-gray-200 p-5 shadow-sm">
                                <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <p class="text-xs uppercase tracking-widest text-gray-400">{{ $post->brand->name }} · {{ optional($post->published_at)->format('d M Y') }}</p>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $post->title }}</h3>
                                        <p class="text-sm text-gray-500">Status: {{ Str::headline($post->status) }}</p>
                                    </div>
                                    <div class="flex gap-3 text-sm">
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-indigo-600 hover:text-indigo-500">Edit</a>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-500 hover:text-red-400">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
