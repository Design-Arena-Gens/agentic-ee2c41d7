<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(): View
    {
        $pages = Page::query()->with('brand')->orderBy('brand_id')->orderBy('slug')->paginate(25);

        return view('admin.pages.index', compact('pages'));
    }

    public function create(): View
    {
        $brands = Brand::query()->orderBy('name')->get();

        return view('admin.pages.create', compact('brands'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        $page = Page::query()->create($data);

        return redirect()->route('admin.pages.edit', $page)->with('status', 'Page created successfully.');
    }

    public function show(Page $page): View
    {
        $page->load('brand');

        return view('admin.pages.show', compact('page'));
    }

    public function edit(Page $page): View
    {
        $brands = Brand::query()->orderBy('name')->get();

        return view('admin.pages.edit', compact('page', 'brands'));
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $data = $this->validatedData($request, $page);

        $page->update($data);

        return redirect()->route('admin.pages.edit', $page)->with('status', 'Page updated successfully.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();

        return redirect()->route('admin.pages.index')->with('status', 'Page deleted.');
    }

    protected function validatedData(Request $request, ?Page $page = null): array
    {
        $data = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'slug' => ['required', 'string', 'max:150', 'unique:pages,slug,'.($page->id ?? 'NULL').',id'],
            'title' => ['required', 'string', 'max:190'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'template' => ['nullable', 'string', 'max:120'],
            'hero_title' => ['nullable', 'string', 'max:190'],
            'hero_subtitle' => ['nullable', 'string'],
            'hero_image' => ['nullable', 'string', 'max:255'],
            'sections' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'meta' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['sections'] = $this->decodeJson($data['sections'] ?? null);
        $data['meta'] = $this->decodeJson($data['meta'] ?? null);
        $data['is_active'] = $request->boolean('is_active', true);

        return $data;
    }

    protected function decodeJson(?string $value): ?array
    {
        if (blank($value)) {
            return null;
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : null;
    }
}
