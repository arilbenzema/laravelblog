<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;


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
        // authorize dulu
        Gate::authorize('create', Post::class);

        $users = User::select('id','name','email')->orderBy('name')->get();
        return view('posts.create', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('create', Post::class);

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
        // authorize dulu
        Gate::authorize('update', $post);

        $users = User::select('id','name','email')->orderBy('name')->get();
        return view('posts.edit', compact('post', 'users'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        Gate::authorize('update', $post);
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'slug'     => 'required|string|unique:posts,slug,' . $post->id,
            'content'  => 'required|string',
            'category' => 'required|string|max:100',
            'user_id'  => 'required|exists:users,id',   // wajib pilih author
            'image'    => 'nullable|string|max:2048',
        ]);

        if (Gate::check('is-author')) {
            // Admin boleh tukar author
            $validatedData['user_id'] = auth()->user()->id;
        }

        $u = User::findOrFail($validated['user_id']);
        $validated['author']      = $u->name;
        $validated['author_info'] = $u->email;

        $post->update($validatedData);

        return redirect()
            ->route('posts.show', ['slug' => $post->slug])
            ->with('success', 'Post has been updated!');
    }

    public function destroy(Post $post): RedirectResponse
    {
        Gate::authorize('delete', $post);
        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post deleted successfully!');
    }
}
