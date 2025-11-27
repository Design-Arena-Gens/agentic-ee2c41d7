<x-layouts.public>
    <article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <header class="border-b border-slate-200 pb-6">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">{{ optional($post->published_at)->format('d F Y') }}</p>
            <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ $post->title }}</h1>
            @if($post->excerpt)
                <p class="mt-3 text-lg text-slate-600">{{ $post->excerpt }}</p>
            @endif
        </header>

        <div class="prose prose-slate max-w-none py-8">
            {!! $post->body !!}
        </div>

        @if($related->isNotEmpty())
            <aside class="mt-12 border-t border-slate-200 pt-8">
                <h2 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Related posts</h2>
                <div class="mt-4 space-y-3">
                    @foreach($related as $item)
                        <a href="{{ route('brand.blog.show', [$brand, $item]) }}" class="block rounded-lg border border-slate-200 px-4 py-3 text-sm hover:border-slate-300">
                            <span class="font-semibold text-slate-900">{{ $item->title }}</span>
                            <span class="ml-2 text-slate-400">{{ optional($item->published_at)->format('d M') }}</span>
                        </a>
                    @endforeach
                </div>
            </aside>
        @endif
    </article>
</x-layouts.public>
