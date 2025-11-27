<?php

namespace App\Http\Controllers;

use App\Models\Brand;

class FaqController extends Controller
{
    public function index(Brand $brand)
    {
        $faqs = $brand->faqs()->where('is_active', true)->orderBy('sort_order')->get();

        return response()->json([
            'data' => $faqs,
        ]);
    }
}
