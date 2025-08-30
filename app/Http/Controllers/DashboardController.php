<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::with('comments', 'user')->get();
        $comments = Comment::with('post', 'user')->get();
        $users = User::with('posts')->get();

        dd($posts, $comments, $users);
        return view('admin.dashboard.index');
    }
}
