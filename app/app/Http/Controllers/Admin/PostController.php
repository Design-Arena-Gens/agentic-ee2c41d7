<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $brands = Brand::query()->orderBy('name')->get();

        $posts = Post::query()
            ->with('brand')
            ->when($request->filled('brand_id'), fn ($query) => $query->where('brand_id', $request->integer('brand_id')))
            ->latest('published_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.posts.index', compact('posts', 'brands'));
    }

    public function create(): View
    {
        $brands = Brand::query()->orderBy('name')->get();

        return view('admin.posts.create', compact('brands'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        $post = Post::query()->create([
            ...$data,
            'author_id' => $request->user()->id,
        ]);

        return redirect()->route('admin.posts.edit', $post)->with('status', 'Post created successfully.');
    }

    public function show(Post $post): View
    {
        $post->load('brand', 'author');

        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        $brands = Brand::query()->orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'brands'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $this->validatedData($request, $post);

        $post->update($data);

        return redirect()->route('admin.posts.edit', $post)->with('status', 'Post updated successfully.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', 'Post deleted.');
    }

    protected function validatedData(Request $request, ?Post $post = null): array
    {
        $data = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'title' => ['required', 'string', 'max:190'],
            'slug' => ['nullable', 'string', 'max:190', 'unique:posts,slug,'.($post->id ?? 'NULL').',id'],
            'excerpt' => ['nullable', 'string', 'max:350'],
            'body' => ['required', 'string'],
            'cover_image' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:draft,scheduled,published,archived'],
            'published_at' => ['nullable', 'date'],
            'meta' => ['nullable', 'string'],
        ]);

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
