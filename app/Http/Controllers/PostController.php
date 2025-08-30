<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function index(Request $request)
    {
         $query = Post::with('user')->orderBy('created_at', 'desc');

        // Handle search function
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            // title, content, category, user
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('content', 'like', '%' . $searchTerm . '%')
                    ->orWhere('category', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('user', function($q) use ($searchTerm) {
                        $q->where('name', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        return view('posts.index', [
            'posts' => $query->get()
        ]);
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->with('comments', 'user')->firstOrFail();
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $users = User::select('id','name','email')->orderBy('name')->get();
        return view('posts.create', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'slug'     => 'required|string|unique:posts,slug',
            'content'  => 'required|string',
            'category' => 'required|string|max:100',
            'user_id'  => 'required|exists:users,id',   // wajib pilih author
            'image'    => 'nullable|string|max:2048',
        ]);

        // Auto-isi author & author_info dari user terpilih (DB anda NOT NULL)
        $u = User::findOrFail($validated['user_id']);
        $validated['author']      = $u->name;
        $validated['author_info'] = $u->email;

        $post = Post::create($validated);

        return redirect()
            ->route('posts.show', ['slug' => $post->slug])
            ->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        $users = User::select('id','name','email')->orderBy('name')->get();
        return view('posts.edit', compact('post', 'users'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'slug'     => 'required|string|unique:posts,slug,' . $post->id,
            'content'  => 'required|string',
            'category' => 'required|string|max:100',
            'user_id'  => 'required|exists:users,id',   // wajib pilih author
            'image'    => 'nullable|string|max:2048',
        ]);

        $u = User::findOrFail($validated['user_id']);
        $validated['author']      = $u->name;
        $validated['author_info'] = $u->email;

        $post->update($validated);

        return redirect()
            ->route('posts.show', ['slug' => $post->slug])
            ->with('success', 'Post has been updated!');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post deleted successfully!');
    }
}
