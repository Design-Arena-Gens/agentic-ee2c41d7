<x-layouts.public>
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="space-y-6">
            <div class="border-l-4 border-[var(--brand-primary)] pl-4">
                <p class="text-sm uppercase tracking-[0.2em] text-slate-400">{{ $brand->name }}</p>
                <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ $page->title }}</h1>
                @if($page->tagline)
                    <p class="mt-2 text-lg text-slate-600">{{ $page->tagline }}</p>
                @endif
            </div>
            <div class="prose prose-slate max-w-none">
                {!! $page->content !!}
            </div>
            @if(!empty($page->sections['services']))
                <div class="grid gap-6 md:grid-cols-2">
                    @foreach($page->sections['services'] as $service)
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-slate-900">{{ $service['title'] }}</h3>
                            <p class="mt-2 text-sm text-slate-600">{{ $service['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-layouts.public>
