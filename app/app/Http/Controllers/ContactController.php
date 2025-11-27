<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request, Brand $brand): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:30'],
            'subject' => ['nullable', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        ContactMessage::query()->create([
            ...$data,
            'brand_id' => $brand->id,
            'meta' => [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ],
        ]);

        Log::info('Contact form submitted', [
            'brand_id' => $brand->id,
            'email' => $data['email'] ?? null,
        ]);

        return back()->with('status', 'Thanks for reaching out. We will respond soon.');
    }
}
