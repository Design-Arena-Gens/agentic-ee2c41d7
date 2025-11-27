<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Support\Facades\Schema;

class LandingController extends Controller
{
    public function index()
    {
        $brands = Schema::hasTable('brands')
            ? Brand::query()
                ->with([
                    'products' => fn ($query) => $query->where('is_active', true)->limit(3),
                    'posts' => fn ($query) => $query->where('status', 'published')->latest('published_at')->limit(3),
                ])
                ->orderBy('name')
                ->get()
            : collect();

        return view('landing', [
            'brands' => $brands,
        ]);
    }
}
