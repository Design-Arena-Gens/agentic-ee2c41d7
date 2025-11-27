@csrf
<div class="space-y-4">
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" value="{{ old('title', $researchProject->title ?? '') }}" required class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $researchProject->slug ?? '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="text-sm font-medium text-gray-700">Brand</label>
            <select name="brand_id" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
                @foreach($brands as $brandOption)
                    <option value="{{ $brandOption->id }}" @selected(old('brand_id', $researchProject->brand_id ?? '') == $brandOption->id)>{{ $brandOption->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Status</label>
            <select name="status" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
                @foreach(['ideation','in-progress','completed','published'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $researchProject->status ?? 'in-progress') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Focus area</label>
        <input type="text" name="focus_area" value="{{ old('focus_area', $researchProject->focus_area ?? '') }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Summary</label>
        <textarea name="summary" rows="3" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('summary', $researchProject->summary ?? '') }}</textarea>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Content (HTML)</label>
        <textarea name="content" rows="10" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('content', $researchProject->content ?? '') }}</textarea>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Partners (JSON)</label>
        <textarea name="partners" rows="5" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('partners', isset($researchProject) && $researchProject->partners ? json_encode($researchProject->partners, JSON_PRETTY_PRINT) : '') }}</textarea>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Metadata (JSON)</label>
        <textarea name="meta" rows="4" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('meta', isset($researchProject) && $researchProject->meta ? json_encode($researchProject->meta, JSON_PRETTY_PRINT) : '') }}</textarea>
    </div>
</div>

<div class="mt-6 flex justify-end gap-3">
    <a href="{{ route('admin.research-projects.index') }}" class="rounded-md border border-gray-200 px-4 py-2 text-sm">Cancel</a>
    <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Save project</button>
</div>
