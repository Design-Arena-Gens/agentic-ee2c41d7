<x-layouts.public>
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-3xl font-semibold text-slate-900">{{ $page->title }}</h1>
        <p class="mt-2 text-sm text-slate-500">{{ $page->hero_subtitle ?? 'Answers to common questions about our formulations and protocols.' }}</p>

        <div class="mt-8 space-y-4">
            @forelse($faqs as $faq)
                <details class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm" @if($loop->first) open @endif>
                    <summary class="cursor-pointer text-base font-semibold text-slate-900">{{ $faq->question }}</summary>
                    <p class="mt-3 text-sm text-slate-600">{{ $faq->answer }}</p>
                </details>
            @empty
                <p class="text-sm text-slate-500">FAQs are being prepared.</p>
            @endforelse
        </div>
    </section>
</x-layouts.public>
