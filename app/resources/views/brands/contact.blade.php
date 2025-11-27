<x-layouts.public>
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid gap-10 lg:grid-cols-2">
            <div>
                <h1 class="text-3xl font-semibold text-slate-900">{{ $page->title }}</h1>
                <p class="mt-4 text-lg text-slate-600">{{ $page->hero_subtitle ?? 'Our specialists respond within 24 hours on business days.' }}</p>
                <dl class="mt-8 space-y-4 text-sm text-slate-600">
                    @if($brand->contact_phone)
                        <div>
                            <dt class="font-semibold text-slate-900">Phone</dt>
                            <dd><a href="tel:{{ $brand->contact_phone }}" class="text-sky-600">{{ $brand->contact_phone }}</a></dd>
                        </div>
                    @endif
                    @if($brand->contact_email)
                        <div>
                            <dt class="font-semibold text-slate-900">Email</dt>
                            <dd><a href="mailto:{{ $brand->contact_email }}" class="text-sky-600">{{ $brand->contact_email }}</a></dd>
                        </div>
                    @endif
                    <div>
                        <dt class="font-semibold text-slate-900">Order Tracking</dt>
                        <dd><a href="{{ route('brand.orders.track', $brand) }}" class="text-sky-600">Track existing order</a></dd>
                    </div>
                </dl>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <form action="{{ route('brand.contact.store', $brand) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-sm font-medium text-slate-700">Name</label>
                        <input type="text" name="name" required class="mt-1 block w-full rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none" placeholder="Your name">
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="text-sm font-medium text-slate-700">Email</label>
                            <input type="email" name="email" class="mt-1 block w-full rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none" placeholder="you@example.com">
                        </div>
                        <div>
                            <label class="text-sm font-medium text-slate-700">Phone</label>
                            <input type="text" name="phone" class="mt-1 block w-full rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none" placeholder="+91">
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700">Subject</label>
                        <input type="text" name="subject" class="mt-1 block w-full rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none" placeholder="How can we help?">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700">Message</label>
                        <textarea name="message" rows="5" required class="mt-1 block w-full rounded-md border border-slate-200 px-3 py-2 focus:border-slate-400 focus:outline-none" placeholder="Share details about your requirements"></textarea>
                    </div>
                    <button type="submit" class="w-full rounded-md bg-[var(--brand-primary)] px-4 py-2 text-sm font-semibold text-white hover:bg-[var(--brand-secondary)]">Submit</button>
                </form>
            </div>
        </div>
    </section>
</x-layouts.public>
