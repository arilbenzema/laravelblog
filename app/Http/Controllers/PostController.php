<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => 'required',
            'slug'        => 'required|unique:posts,slug',
            'content'     => 'required',
            'category'    => 'required',
            'author'      => 'required',
            'author_info' => 'required',
            'image'       => 'nullable|string|max:2048',
            'created_at'  => 'nullable|date',
            'updated_at'  => 'nullable|date',
        ]);

        $post = Post::create($validated);

        return redirect()
            ->route('posts.show', ['slug' => $post->slug])
            ->with('success', 'Post berjaya ditambah!');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => 'required',
            'slug'        => 'required|unique:posts,slug,' . $post->id,
            'content'     => 'required',
            'category'    => 'required',
            'author'      => 'required',
            'author_info' => 'required',
            'image'       => 'nullable|string|max:2048',
        ]);

        $post->update($validated);

        return redirect()
            ->route('posts.show', ['slug' => $post->slug])
            ->with('success', 'Post berjaya dikemaskini!');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post berjaya dipadam.');
    }
}
