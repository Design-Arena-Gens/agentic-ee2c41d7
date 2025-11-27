<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ResearchProject;
use Illuminate\Contracts\View\View;

class ResearchController extends Controller
{
    public function index(Brand $brand): View
    {
        $projects = $brand->researchProjects()->latest()->paginate(9);

        return view('brands.research.list', compact('brand', 'projects'));
    }

    public function show(Brand $brand, ResearchProject $researchProject): View
    {
        abort_unless($researchProject->brand_id === $brand->id, 404);

        $related = $brand->researchProjects()
            ->where('id', '!=', $researchProject->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('brands.research.show', [
            'brand' => $brand,
            'project' => $researchProject,
            'related' => $related,
        ]);
    }
}
