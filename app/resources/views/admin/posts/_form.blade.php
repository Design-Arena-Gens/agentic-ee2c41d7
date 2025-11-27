@csrf
<div class="space-y-4">
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" required class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $post->slug ?? '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="text-sm font-medium text-gray-700">Brand</label>
            <select name="brand_id" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
                @foreach($brands as $brandOption)
                    <option value="{{ $brandOption->id }}" @selected(old('brand_id', $post->brand_id ?? request('brand_id')) == $brandOption->id)>{{ $brandOption->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Status</label>
            <select name="status" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
                @foreach(['draft','scheduled','published','archived'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $post->status ?? 'draft') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Excerpt</label>
        <textarea name="excerpt" rows="3" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Body (HTML)</label>
        <textarea name="body" rows="12" required class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('body', $post->body ?? '') }}</textarea>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Cover image URL</label>
        <input type="url" name="cover_image" value="{{ old('cover_image', $post->cover_image ?? '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="text-sm font-medium text-gray-700">Publish at</label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at', isset($post) && $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Metadata (JSON)</label>
            <textarea name="meta" rows="4" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('meta', isset($post) && $post->meta ? json_encode($post->meta, JSON_PRETTY_PRINT) : '') }}</textarea>
        </div>
    </div>
</div>

<div class="mt-6 flex justify-end gap-3">
    <a href="{{ route('admin.posts.index') }}" class="rounded-md border border-gray-200 px-4 py-2 text-sm">Cancel</a>
    <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Save post</button>
</div>
