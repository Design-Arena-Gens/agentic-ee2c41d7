<x-layouts.public>
    <section class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="grid gap-12 lg:grid-cols-2">
                <div>
                    <h1 class="text-4xl sm:text-5xl font-semibold tracking-tight">Two brands. One mission to elevate agri-biotech and functional wellness.</h1>
                    <p class="mt-6 text-lg text-slate-300">Choose the division that aligns with your goals. Shnikh Agrobiotech powers scalable plant tissue culture and contract research, while Cordygen delivers evidence-backed cordyceps formulations for holistic performance.</p>
                    <div class="mt-10 grid gap-6 md:grid-cols-2">
                        @foreach($brands as $brand)
                            <a href="{{ route('brand.home', $brand) }}" class="group rounded-2xl border border-white/10 bg-white/5 p-6 transition hover:-translate-y-1 hover:border-white/30">
                                <h2 class="text-xl font-semibold">{{ $brand->name }}</h2>
                                <p class="mt-2 text-sm text-slate-300">{{ $brand->short_description }}</p>
                                <span class="mt-4 inline-flex items-center text-sm font-medium text-emerald-300">
                                    Explore brand
                                    <svg class="ms-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m9 5 7 7-7 7" /></svg>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-2xl p-8">
                    <h3 class="text-lg font-semibold">Talk to our specialists</h3>
                    <p class="mt-2 text-sm text-slate-200">Leave your details and we will align the right division to your goals.</p>
                    <form action="{{ route('leads.store') }}" method="POST" class="mt-6 space-y-4">
                        @csrf
                        <div>
                            <label class="text-sm text-slate-200">Name</label>
                            <input type="text" name="name" required class="mt-1 block w-full rounded-md border border-white/20 bg-white/10 px-3 py-2 text-white placeholder:text-slate-400 focus:border-white/40 focus:outline-none" placeholder="Your name">
                        </div>
                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="text-sm text-slate-200">Email</label>
                                <input type="email" name="email" class="mt-1 block w-full rounded-md border border-white/20 bg-white/10 px-3 py-2 text-white placeholder:text-slate-400 focus:border-white/40 focus:outline-none" placeholder="you@example.com">
                            </div>
                            <div>
                                <label class="text-sm text-slate-200">Phone</label>
                                <input type="text" name="phone" class="mt-1 block w-full rounded-md border border-white/20 bg-white/10 px-3 py-2 text-white placeholder:text-slate-400 focus:border-white/40 focus:outline-none" placeholder="+91">
                            </div>
                        </div>
                        <div>
                            <label class="text-sm text-slate-200">Organization</label>
                            <input type="text" name="organization" class="mt-1 block w-full rounded-md border border-white/20 bg-white/10 px-3 py-2 text-white placeholder:text-slate-400 focus:border-white/40 focus:outline-none" placeholder="Company / Institution">
                        </div>
                        <div>
                            <label class="text-sm text-slate-200">Which division are you interested in?</label>
                            <select name="interest" class="mt-1 block w-full rounded-md border border-white/20 bg-white/10 px-3 py-2 text-white focus:border-white/40 focus:outline-none">
                                <option value="both">I would like guidance</option>
                                <option value="shnikh">Shnikh Agrobiotech</option>
                                <option value="cordygen">Cordygen</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm text-slate-200">Tell us more</label>
                            <textarea name="message" rows="4" class="mt-1 block w-full rounded-md border border-white/20 bg-white/10 px-3 py-2 text-white placeholder:text-slate-400 focus:border-white/40 focus:outline-none" placeholder="Project scope, timelines, or product requirements..."></textarea>
                        </div>
                        <button type="submit" class="w-full rounded-md bg-emerald-400 px-4 py-3 text-sm font-semibold text-slate-900 hover:bg-emerald-300">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-2xl font-semibold text-slate-800">Latest Insights</h2>
        <div class="mt-10 grid gap-6 md:grid-cols-2">
            @foreach($brands as $brand)
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-slate-900">{{ $brand->name }}
                        </h3>
                        <a href="{{ route('brand.blog.index', $brand) }}" class="text-sm font-medium text-sky-600">View all</a>
                    </div>
                    <div class="mt-4 space-y-4">
                        @forelse($brand->posts as $post)
                            <a href="{{ route('brand.blog.show', [$brand, $post]) }}" class="block rounded-lg border border-slate-100 px-4 py-3 hover:border-slate-300">
                                <p class="text-xs uppercase tracking-wide text-slate-400">{{ $post->published_at?->format('d M Y') }}</p>
                                <p class="mt-2 text-sm font-medium text-slate-800">{{ $post->title }}</p>
                            </a>
                        @empty
                            <p class="text-sm text-slate-500">Updates coming soon.</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-layouts.public>
