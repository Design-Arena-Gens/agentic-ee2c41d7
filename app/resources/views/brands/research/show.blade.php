@php use Illuminate\Support\Str; @endphp
<x-layouts.public>
    <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <header class="border-b border-slate-200 pb-6">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">{{ Str::headline($project->status) }}</p>
            <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ $project->title }}</h1>
            @if($project->focus_area)
                <p class="mt-2 text-sm text-slate-500">Focus area: {{ $project->focus_area }}</p>
            @endif
        </header>
        <div class="prose prose-slate max-w-none py-8">
            {!! $project->content !!}
        </div>
        @if(!empty($project->partners))
            <section class="mt-10 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Partners</h2>
                <ul class="mt-3 grid gap-2 text-sm text-slate-600">
                    @foreach($project->partners['institutions'] ?? [] as $partner)
                        <li>• {{ $partner }}</li>
                    @endforeach
                </ul>
            </section>
        @endif

        @if($related->isNotEmpty())
            <aside class="mt-12 border-t border-slate-200 pt-8">
                <h2 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">More projects</h2>
                <div class="mt-4 space-y-3">
                    @foreach($related as $item)
                        <a href="{{ route('brand.research.show', [$brand, $item]) }}" class="block rounded-lg border border-slate-200 px-4 py-3 text-sm hover:border-slate-300">
                            <span class="font-semibold text-slate-900">{{ $item->title }}</span>
                            <span class="ml-2 text-slate-400">{{ Str::headline($item->status) }}</span>
                        </a>
                    @endforeach
                </div>
            </aside>
        @endif
    </article>
</x-layouts.public>
