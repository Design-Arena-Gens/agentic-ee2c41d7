<x-layouts.public>
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-3xl font-semibold text-slate-900">{{ $brand->name }} Journal</h1>
        <p class="mt-2 text-sm text-slate-500">Insights, lab notes, and product knowledge from our team.</p>

        <div class="mt-10 grid gap-6 md:grid-cols-2">
            @forelse($posts as $post)
                <a href="{{ route('brand.blog.show', [$brand, $post]) }}" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:border-slate-300">
                    <p class="text-xs uppercase tracking-widest text-slate-400">{{ optional($post->published_at)->format('d M Y') }}</p>
                    <h2 class="mt-2 text-xl font-semibold text-slate-900">{{ $post->title }}</h2>
                    <p class="mt-3 text-sm text-slate-600">{{ $post->excerpt }}</p>
                    <span class="mt-4 inline-flex items-center text-sm font-medium text-sky-600">
                        Read more
                        <svg class="ms-2 h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m9 5 7 7-7 7" /></svg>
                    </span>
                </a>
            @empty
                <p class="text-sm text-slate-500">No posts available yet.</p>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $posts->links() }}
        </div>
    </section>
</x-layouts.public>
