@csrf
<div class="space-y-4">
    <div>
        <label class="text-sm font-medium text-gray-700">Brand</label>
        <select name="brand_id" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" @selected(old('brand_id', $faq->brand_id ?? '') == $brand->id)>{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Question</label>
        <input type="text" name="question" value="{{ old('question', $faq->question ?? '') }}" required class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Answer</label>
        <textarea name="answer" rows="4" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none" required>{{ old('answer', $faq->answer ?? '') }}</textarea>
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="text-sm font-medium text-gray-700">Sort order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $faq->sort_order ?? 0) }}" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">
        </div>
        <div class="flex items-center gap-2 mt-6">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $faq->is_active ?? true))>
            <span class="text-sm text-gray-700">Active</span>
        </div>
    </div>
    <div>
        <label class="text-sm font-medium text-gray-700">Metadata (JSON)</label>
        <textarea name="meta" rows="3" class="mt-1 w-full rounded-md border border-gray-200 px-3 py-2 focus:border-gray-400 focus:outline-none">{{ old('meta', isset($faq) && $faq->meta ? json_encode($faq->meta, JSON_PRETTY_PRINT) : '') }}</textarea>
    </div>
</div>

<div class="mt-6 flex justify-end gap-3">
    <a href="{{ route('admin.faqs.index') }}" class="rounded-md border border-gray-200 px-4 py-2 text-sm">Cancel</a>
    <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Save</button>
</div>
