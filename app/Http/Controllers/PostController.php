<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', [
            'posts' => $posts]);

    }
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('posts.show',compact('post'));

    }

    public function create()
    {
    // Logic for creating a new post can be added here
    }

    public function store()
    {
    // Logic for storing a new post can be added here
    }

    public function update()
    {
    // Logic for updating a post can be added here
    }

    public function destroy()
    {
    // Logic for deleting a post can be added here
    }

    public function edit()
    {
    // Logic for editing a post can be added here
    }


}









