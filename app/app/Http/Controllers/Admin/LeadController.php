<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Lead;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request): View
    {
        $brands = Brand::query()->orderBy('name')->get();

        $leads = Lead::query()
            ->with('brand')
            ->when($request->filled('brand_id'), fn ($query) => $query->where('brand_id', $request->integer('brand_id')))
            ->latest()
            ->paginate(25)
            ->withQueryString();

        return view('admin.leads.index', compact('leads', 'brands'));
    }

    public function show(Lead $lead): View
    {
        $lead->load('brand');

        return view('admin.leads.show', compact('lead'));
    }

    public function destroy(Lead $lead): RedirectResponse
    {
        $lead->delete();

        return redirect()->route('admin.leads.index')->with('status', 'Lead archived successfully.');
    }
}
