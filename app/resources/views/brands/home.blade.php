@php use Illuminate\Support\Str; @endphp
<x-layouts.public>
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 -z-10 bg-gradient-to-br from-[var(--brand-primary)] via-slate-900 to-slate-950 opacity-90"></div>
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-white">
            <div class="grid gap-12 lg:grid-cols-2 items-center">
                <div>
                    <p class="text-sm uppercase tracking-[0.2em] text-white/70">{{ $brand->tagline }}</p>
                    <h1 class="mt-4 text-4xl sm:text-5xl font-semibold tracking-tight">{{ $page->hero_title ?? $brand->name }}</h1>
                    <p class="mt-6 text-lg text-white/80">{{ $page->hero_subtitle }}</p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('brand.products.index', $brand) }}" class="rounded-full bg-white px-5 py-2 text-sm font-semibold text-slate-900">Explore Products</a>
                        <a href="{{ route('brand.contact', $brand) }}" class="rounded-full border border-white/40 px-5 py-2 text-sm font-semibold text-white hover:bg-white/10">Talk to us</a>
                    </div>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/10 p-8 backdrop-blur">
                    <h3 class="text-lg font-semibold">Why partners choose {{ Str::headline($brand->slug) }}</h3>
                    <dl class="mt-6 space-y-4 text-sm text-white/80">
                        @foreach(($page->sections['highlights'] ?? []) as $highlight)
                            <div>
                                <dt class="font-semibold text-white">{{ $highlight['title'] }}</dt>
                                <dd class="mt-1">{{ $highlight['description'] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid gap-10 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-semibold text-slate-900">Featured Products</h2>
                <div class="mt-6 grid gap-6 md:grid-cols-2">
                    @forelse($brand->products()->where('is_active', true)->latest('published_at')->limit(4)->get() as $product)
                        <a href="{{ route('brand.products.show', [$brand, $product]) }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow hover:shadow-lg">
                            <p class="text-xs uppercase tracking-wide text-slate-400">{{ $product->type }}</p>
                            <h3 class="mt-2 text-lg font-semibold text-slate-900 group-hover:text-[var(--brand-primary)]">{{ $product->name }}</h3>
                            <p class="mt-2 text-sm text-slate-600">{{ $product->short_description }}</p>
                            <div class="mt-4 text-sm font-medium text-slate-900">₹{{ number_format($product->sale_price ?? $product->price, 2) }}</div>
                        </a>
                    @empty
                        <p class="text-sm text-slate-500">Product catalogue coming soon.</p>
                    @endforelse
                </div>
            </div>
            <aside class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900">Latest Updates</h3>
                <div class="mt-4 space-y-4">
                    @forelse($brand->posts()->where('status', 'published')->latest('published_at')->limit(5)->get() as $post)
                        <a href="{{ route('brand.blog.show', [$brand, $post]) }}" class="block rounded-lg border border-slate-100 px-3 py-2 hover:border-slate-300">
                            <p class="text-xs text-slate-400">{{ optional($post->published_at)->format('d M Y') }}</p>
                            <p class="mt-1 text-sm font-medium text-slate-800">{{ $post->title }}</p>
                        </a>
                    @empty
                        <p class="text-sm text-slate-500">No posts yet.</p>
                    @endforelse
                </div>
                <a href="{{ route('brand.blog.index', $brand) }}" class="mt-4 inline-flex items-center text-sm font-medium text-sky-600">Read the blog</a>
            </aside>
        </div>
    </section>
</x-layouts.public>
