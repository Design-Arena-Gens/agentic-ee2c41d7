<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BrandBlogController extends Controller
{
    public function index(Request $request, Brand $brand): View
    {
        $posts = $brand->posts()
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('brands.blog.index', compact('brand', 'posts'));
    }

    public function show(Brand $brand, Post $post): View
    {
        abort_unless($post->brand_id === $brand->id && $post->status === 'published', 404);

        $related = $brand->posts()
            ->where('status', 'published')
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('brands.blog.show', compact('brand', 'post', 'related'));
    }
}
