<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(): View
    {
        $brands = Brand::query()->orderBy('name')->get();

        return view('admin.brands.index', compact('brands'));
    }

    public function create(): View
    {
        return view('admin.brands.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        $brand = Brand::query()->create($data);

        return redirect()->route('admin.brands.edit', $brand)->with('status', 'Brand created successfully.');
    }

    public function show(Brand $brand): View
    {
        $brand->load(['pages', 'products', 'posts']);

        return view('admin.brands.show', compact('brand'));
    }

    public function edit(Brand $brand): View
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand): RedirectResponse
    {
        $data = $this->validatedData($request, $brand);

        $brand->update($data);

        return redirect()->route('admin.brands.edit', $brand)->with('status', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand): RedirectResponse
    {
        $brand->delete();

        return redirect()->route('admin.brands.index')->with('status', 'Brand deleted.');
    }

    protected function validatedData(Request $request, ?Brand $brand = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:190'],
            'slug' => ['required', 'string', 'max:120', 'unique:brands,slug,'.($brand->id ?? 'NULL').',id'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'primary_color' => ['nullable', 'string', 'max:10'],
            'secondary_color' => ['nullable', 'string', 'max:10'],
            'logo_path' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:190'],
            'contact_phone' => ['nullable', 'string', 'max:40'],
            'contact_whatsapp' => ['nullable', 'string', 'max:40'],
            'social_links' => ['nullable', 'string'],
            'short_description' => ['nullable', 'string'],
            'about_content' => ['nullable', 'string'],
            'metadata' => ['nullable', 'string'],
        ]);

        $data['social_links'] = $this->decodeJson($data['social_links'] ?? null);
        $data['metadata'] = $this->decodeJson($data['metadata'] ?? null);

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
