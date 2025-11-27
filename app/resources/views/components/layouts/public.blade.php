@php
    $brand = $currentBrand ?? null;
    $primary = $brand?->primary_color ?? '#0f172a';
    $secondary = $brand?->secondary_color ?? '#0ea5e9';
    $navLinks = [];

    if ($brand) {
        $navLinks = match ($brand->slug) {
            'shnikh' => [
                ['label' => 'Home', 'route' => 'brand.home'],
                ['label' => 'About', 'route' => 'brand.about'],
                ['label' => 'Services', 'route' => 'brand.services'],
                ['label' => 'Products', 'route' => 'brand.products.index'],
                ['label' => 'R&D', 'route' => 'brand.research.overview'],
                ['label' => 'Blog', 'route' => 'brand.blog.index'],
                ['label' => 'Contact', 'route' => 'brand.contact'],
            ],
            'cordygen' => [
                ['label' => 'Home', 'route' => 'brand.home'],
                ['label' => 'Products', 'route' => 'brand.products.index'],
                ['label' => 'Science', 'route' => 'brand.science'],
                ['label' => 'Blog', 'route' => 'brand.blog.index'],
                ['label' => 'FAQ', 'route' => 'brand.faq'],
                ['label' => 'Contact', 'route' => 'brand.contact'],
            ],
            default => [
                ['label' => 'Home', 'route' => 'brand.home'],
                ['label' => 'Products', 'route' => 'brand.products.index'],
                ['label' => 'Contact', 'route' => 'brand.contact'],
            ],
        };
    }
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ ($brand?->name ? $brand->name.' | ' : '') . config('app.name', 'Shnikh & Cordygen') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --brand-primary: {{ $primary }};
                --brand-secondary: {{ $secondary }};
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900">
        <div class="min-h-screen flex flex-col">
            <header class="border-b border-slate-200 bg-white/80 backdrop-blur-md sticky top-0 z-30">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between py-4">
                        <div class="flex items-center gap-4">
                            <a href="{{ $brand ? route('brand.home', $brand) : route('landing') }}" class="text-xl font-semibold tracking-tight" style="color: var(--brand-primary)">
                                {{ $brand->name ?? 'Shnikh | Cordygen' }}
                            </a>
                            @if($brand?->tagline)
                                <span class="hidden md:block text-sm text-slate-500">{{ $brand->tagline }}</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-4">
                            @if(isset($availableBrands) && $availableBrands->count() > 1)
                                <div class="relative group">
                                    <button class="px-3 py-2 text-sm font-medium border border-slate-200 rounded-md flex items-center gap-2 hover:border-slate-300" type="button">
                                        Switch Brand
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                                    </button>
                                    <div class="absolute hidden group-hover:block right-0 mt-2 w-48 rounded-md border border-slate-200 bg-white shadow-lg">
                                        <div class="py-2">
                                            @foreach($availableBrands as $switchBrand)
                                                <a href="{{ route('brand.home', $switchBrand) }}" class="block px-4 py-2 text-sm hover:bg-slate-100 {{ $brand && $brand->id === $switchBrand->id ? 'font-semibold text-slate-900' : 'text-slate-600' }}">
                                                    {{ $switchBrand->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <nav class="hidden lg:flex items-center gap-6 text-sm font-medium">
                                @foreach($navLinks as $item)
                                    <a href="{{ route($item['route'], $brand) }}" class="hover:text-slate-900 {{ request()->routeIs($item['route']) ? 'text-slate-900' : 'text-slate-600' }}">{{ $item['label'] }}</a>
                                @endforeach
                            </nav>
                            <a href="{{ $brand ? route('brand.checkout.show', $brand) : route('landing') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300">
                                <span>Cart</span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1">
                @if(session('status'))
                    <div class="bg-emerald-50 border-b border-emerald-200">
                        <div class="max-w-4xl mx-auto px-4 py-3 text-sm text-emerald-800">
                            {{ session('status') }}
                        </div>
                    </div>
                @endif

                {{ $slot ?? '' }}
            </main>

            <footer class="bg-slate-900 text-slate-200 mt-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid gap-6 md:grid-cols-3">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $brand->name ?? 'Shnikh Agrobiotech & Cordygen' }}</h3>
                        <p class="mt-2 text-sm text-slate-400">{{ $brand->short_description ?? 'Integrated agri-biotech and wellness brands driven by science, quality, and sustainability.' }}</p>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold uppercase tracking-wider text-slate-400">Contact</h4>
                        <dl class="mt-3 space-y-1 text-sm">
                            @if($brand?->contact_phone)
                                <div>Phone: <a href="tel:{{ $brand->contact_phone }}" class="hover:text-white">{{ $brand->contact_phone }}</a></div>
                            @endif
                            @if($brand?->contact_email)
                                <div>Email: <a href="mailto:{{ $brand->contact_email }}" class="hover:text-white">{{ $brand->contact_email }}</a></div>
                            @endif
                            @if($brand?->contact_whatsapp)
                                <div>WhatsApp: <a href="https://wa.me/{{ preg_replace('/\D/', '', $brand->contact_whatsapp) }}" class="hover:text-white">{{ $brand->contact_whatsapp }}</a></div>
                            @endif
                        </dl>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold uppercase tracking-wider text-slate-400">Quick Actions</h4>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <a href="{{ $brand ? route('brand.contact', $brand) : route('landing') }}" class="rounded-full bg-white/10 px-4 py-2 text-xs uppercase tracking-wide hover:bg-white/20">Contact</a>
                            @if($brand)
                                <a href="{{ route('brand.orders.track', $brand) }}" class="rounded-full bg-white/10 px-4 py-2 text-xs uppercase tracking-wide hover:bg-white/20">Track Order</a>
                                <a href="{{ route('brand.blog.index', $brand) }}" class="rounded-full bg-white/10 px-4 py-2 text-xs uppercase tracking-wide hover:bg-white/20">Latest Updates</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="border-t border-slate-800 py-4 text-center text-xs text-slate-500">
                    © {{ now()->year }} {{ config('app.name', 'Shnikh & Cordygen') }}. All rights reserved.
                </div>
            </footer>
        </div>
    </body>
</html>
