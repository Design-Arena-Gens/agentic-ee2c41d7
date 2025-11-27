@csrf
<div class="space-y-4">
    <div>
        <label class="text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" value="{{ old('name', $brand->name ?? '') }}" required class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $brand->slug ?? '') }}" required class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Tagline</label>
            <input type="text" name="tagline" value="{{ old('tagline', $brand->tagline ?? '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="text-sm font-medium text-gray-700">Primary color</label>
            <input type="text" name="primary_color" value="{{ old('primary_color', $brand->primary_color ?? '#0f172a') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Secondary color</label>
            <input type="text" name="secondary_color" value="{{ old('secondary_color', $brand->secondary_color ?? '#0ea5e9') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="text-sm font-medium text-gray-700">Contact email</label>
            <input type="email" name="contact_email" value="{{ old('contact_email', $brand->contact_email ?? '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Contact phone</label>
            <input type="text" name="contact_phone" value="{{ old('contact_phone', $brand->contact_phone ?? '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">WhatsApp</label>
        <input type="text" name="contact_whatsapp" value="{{ old('contact_whatsapp', $brand->contact_whatsapp ?? '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Logo URL</label>
        <input type="text" name="logo_path" value="{{ old('logo_path', $brand->logo_path ?? '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Short description</label>
        <textarea name="short_description" rows="3" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('short_description', $brand->short_description ?? '') }}</textarea>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">About content (HTML)</label>
        <textarea name="about_content" rows="8" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('about_content', $brand->about_content ?? '') }}</textarea>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Social links (JSON)</label>
        <textarea name="social_links" rows="4" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('social_links', isset($brand) && $brand->social_links ? json_encode($brand->social_links, JSON_PRETTY_PRINT) : '') }}</textarea>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Metadata (JSON)</label>
        <textarea name="metadata" rows="4" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('metadata', isset($brand) && $brand->metadata ? json_encode($brand->metadata, JSON_PRETTY_PRINT) : '') }}</textarea>
    </div>
</div>

<div class="mt-6 flex justify-end gap-3">
    <a href="{{ route('admin.brands.index') }}" class="rounded-md border border-gray-200 px-4 py-2 text-sm">Cancel</a>
    <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Save brand</button>
</div>
