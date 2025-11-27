<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ResearchProject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ResearchProjectController extends Controller
{
    public function index(): View
    {
        $projects = ResearchProject::query()->with('brand')->latest()->paginate(25);

        return view('admin.research.index', compact('projects'));
    }

    public function create(): View
    {
        $brands = Brand::query()->orderBy('name')->get();

        return view('admin.research.create', compact('brands'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        $project = ResearchProject::query()->create($data);

        return redirect()->route('admin.research-projects.edit', $project)->with('status', 'Research project created successfully.');
    }

    public function show(ResearchProject $researchProject): View
    {
        $researchProject->load('brand');

        return view('admin.research.show', compact('researchProject'));
    }

    public function edit(ResearchProject $researchProject): View
    {
        $brands = Brand::query()->orderBy('name')->get();

        return view('admin.research.edit', compact('researchProject', 'brands'));
    }

    public function update(Request $request, ResearchProject $researchProject): RedirectResponse
    {
        $data = $this->validatedData($request, $researchProject);

        $researchProject->update($data);

        return redirect()->route('admin.research-projects.edit', $researchProject)->with('status', 'Research project updated successfully.');
    }

    public function destroy(ResearchProject $researchProject): RedirectResponse
    {
        $researchProject->delete();

        return redirect()->route('admin.research-projects.index')->with('status', 'Research project removed.');
    }

    protected function validatedData(Request $request, ?ResearchProject $researchProject = null): array
    {
        $data = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'title' => ['required', 'string', 'max:190'],
            'slug' => ['nullable', 'string', 'max:190', 'unique:research_projects,slug,'.($researchProject->id ?? 'NULL').',id'],
            'focus_area' => ['nullable', 'string', 'max:190'],
            'summary' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'partners' => ['nullable', 'string'],
            'status' => ['required', 'in:ideation,in-progress,completed,published'],
            'meta' => ['nullable', 'string'],
        ]);

        $data['partners'] = $this->decodeJson($data['partners'] ?? null);
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
