<x-layouts.public>
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-white via-white to-slate-50 p-10 shadow-sm">
            <h1 class="text-3xl font-semibold text-slate-900">{{ $page->title }}</h1>
            <p class="mt-4 text-lg text-slate-600">{{ $page->hero_subtitle }}</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('brand.research.index', $brand) }}" class="rounded-full bg-[var(--brand-primary)] px-5 py-2 text-sm font-semibold text-white">View projects</a>
                <a href="{{ route('brand.contact', $brand) }}" class="rounded-full border border-slate-200 px-5 py-2 text-sm font-semibold text-slate-700">Partner with us</a>
            </div>
        </div>
    </section>
</x-layouts.public>
