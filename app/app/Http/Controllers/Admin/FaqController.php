<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Faq;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(): View
    {
        $faqs = Faq::query()->with('brand')->orderBy('brand_id')->orderBy('sort_order')->paginate(25);

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create(): View
    {
        $brands = Brand::query()->orderBy('name')->get();

        return view('admin.faqs.create', compact('brands'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        $faq = Faq::query()->create($data);

        return redirect()->route('admin.faqs.edit', $faq)->with('status', 'FAQ created successfully.');
    }

    public function edit(Faq $faq): View
    {
        $brands = Brand::query()->orderBy('name')->get();

        return view('admin.faqs.edit', compact('faq', 'brands'));
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $data = $this->validatedData($request, $faq);

        $faq->update($data);

        return redirect()->route('admin.faqs.edit', $faq)->with('status', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('status', 'FAQ deleted.');
    }

    protected function validatedData(Request $request, ?Faq $faq = null): array
    {
        $data = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'meta' => ['nullable', 'string'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['meta'] = $this->decodeJson($data['meta'] ?? null);

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
