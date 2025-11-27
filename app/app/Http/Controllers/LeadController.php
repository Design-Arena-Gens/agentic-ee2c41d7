<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LeadController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:30'],
            'organization' => ['nullable', 'string', 'max:190'],
            'interest' => ['required', 'in:shnikh,cordygen,both'],
            'message' => ['nullable', 'string'],
        ]);

        $brand = null;
        if ($validated['interest'] !== 'both') {
            $brand = Brand::query()->where('slug', $validated['interest'])->first();
        }

        $lead = Lead::query()->create([
            ...$validated,
            'brand_id' => $brand?->id,
            'metadata' => [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ],
        ]);

        Log::info('New lead captured', [
            'lead_id' => $lead->id,
            'interest' => $lead->interest,
        ]);

        return back()->with('status', 'Thanks! Our team will contact you within 24 hours.');
    }
}
