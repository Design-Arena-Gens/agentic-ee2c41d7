@php use Illuminate\Support\Str; @endphp
<x-layouts.public>
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-3xl font-semibold text-slate-900">Research & Development</h1>
        <p class="mt-2 text-sm text-slate-500">Collaborative programs, pilots, and translational research with {{ $brand->name }}.</p>

        <div class="mt-10 space-y-6">
            @forelse($projects as $project)
                <a href="{{ route('brand.research.show', [$brand, $project]) }}" class="block rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:border-slate-300">
                    <div class="flex items-center justify-between gap-4">
                        <h2 class="text-xl font-semibold text-slate-900">{{ $project->title }}</h2>
                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-slate-600">{{ Str::headline($project->status) }}</span>
                    </div>
                    <p class="mt-2 text-sm text-slate-600">{{ $project->summary }}</p>
                    @if($project->focus_area)
                        <p class="mt-2 text-xs uppercase tracking-widest text-slate-400">Focus: {{ $project->focus_area }}</p>
                    @endif
                </a>
            @empty
                <p class="text-sm text-slate-500">Projects will be published shortly.</p>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $projects->links() }}
        </div>
    </section>
</x-layouts.public>
