@csrf
<div class="space-y-4">
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" value="{{ old('title', $page->title ?? '') }}" required class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $page->slug ?? '') }}" required class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="text-sm font-medium text-gray-700">Brand</label>
            <select name="brand_id" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" @selected(old('brand_id', $page->brand_id ?? '') == $brand->id)>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Template</label>
            <input type="text" name="template" value="{{ old('template', $page->template ?? 'default') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Tagline</label>
        <input type="text" name="tagline" value="{{ old('tagline', $page->tagline ?? '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="text-sm font-medium text-gray-700">Hero title</label>
            <input type="text" name="hero_title" value="{{ old('hero_title', $page->hero_title ?? '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Hero image</label>
            <input type="text" name="hero_image" value="{{ old('hero_image', $page->hero_image ?? '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Hero subtitle</label>
        <textarea name="hero_subtitle" rows="3" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('hero_subtitle', $page->hero_subtitle ?? '') }}</textarea>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Content (HTML)</label>
        <textarea name="content" rows="10" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('content', $page->content ?? '') }}</textarea>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Sections (JSON)</label>
        <textarea name="sections" rows="5" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('sections', isset($page) && $page->sections ? json_encode($page->sections, JSON_PRETTY_PRINT) : '') }}</textarea>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Metadata (JSON)</label>
        <textarea name="meta" rows="4" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('meta', isset($page) && $page->meta ? json_encode($page->meta, JSON_PRETTY_PRINT) : '') }}</textarea>
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $page->is_active ?? true))>
        <span class="text-sm text-gray-700">Published</span>
    </div>
</div>

<div class="mt-6 flex justify-end gap-3">
    <a href="{{ route('admin.pages.index') }}" class="rounded-md border border-gray-200 px-4 py-2 text-sm">Cancel</a>
    <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Save page</button>
</div>
