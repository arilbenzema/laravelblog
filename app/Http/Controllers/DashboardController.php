<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::with('comments', 'user')->get();
        $comments = Comment::with('post', 'user')->get();
        $users = User::with('posts')->get();

        // Collections Exercise: Generate comprehensive statistics
        $statistics = [
            'overview' => [
                'total_posts' => $posts->count(),
                'total_comments' => $comments->count(),
                'total_users' => $users->count(),
                'posts_this_month' => $posts->filter(function($post) {
                    return $post->created_at->isCurrentMonth();
                })->count(),
            ],

            'posts' => [
                'total' => $posts->count(),
                'by_category' => $posts->groupBy('category')->map->count()->sortDesc(),
                'monthly_posts' => $posts->groupBy(function($post) {
                    return $post->created_at->format('Y-m');
                })->map->count()->sortDesc()->take(6),
                'recent_posts' => $posts->sortByDesc('created_at')->take(5),
                'posts_by_author' => $posts->groupBy('user.name')->map->count()->sortDesc(),
            ],

            'content_analysis' => [
                'average_word_count' => round($posts->avg(function($post) {
                    return str_word_count($post->content ?? '');
                })),
                'longest_posts' => $posts->sortByDesc(function($post) {
                    return str_word_count($post->content ?? '');
                })->take(5)->map(function($post) {
                    return [
                        'title' => $post->title,
                        'slug' => $post->slug,
                        'word_count' => str_word_count($post->content ?? ''),
                        'author' => $post->user->name ?? 'Unknown'
                    ];
                }),
                'shortest_posts' => $posts->sortBy(function($post) {
                    return str_word_count($post->content ?? '');
                })->take(5)->map(function($post) {
                    return [
                        'title' => $post->title,
                        'slug' => $post->slug,
                        'word_count' => str_word_count($post->content ?? ''),
                        'author' => $post->user->name ?? 'Unknown'
                    ];
                }),
            ],

            'engagement' => [
                'total_comments' => $comments->count(),
                'comments_this_month' => $comments->filter(function($comment) {
                    return $comment->created_at->isCurrentMonth();
                })->count(),
                'posts_with_most_comments' => $posts->sortByDesc(function($post) {
                    return $post->comments->count();
                })->take(5)->map(function($post) {
                    return [
                        'title' => $post->title,
                        'slug' => $post->slug,
                        'comments_count' => $post->comments->count(),
                        'author' => $post->user->name ?? 'Unknown'
                    ];
                }),
                'recent_comments' => $comments->sortByDesc('created_at')->take(10)->map(function($comment) {
                    return [
                        'id' => $comment->id,
                        'content' => Str::limit($comment->content, 100),
                        'author' => $comment->author_name,
                        'post_title' => $comment->post->title ?? 'Unknown Post',
                        'post_slug' => $comment->post->slug ?? '',
                        'created_at' => $comment->created_at->diffForHumans(),
                    ];
                }),
                'average_comments_per_post' => round($posts->avg(function($post) {
                    return $post->comments->count();
                }), 1),
            ],

            'activity' => [
                'daily_activity' => $posts->concat($comments)->groupBy(function($item) {
                    return $item->created_at->format('Y-m-d');
                })->map->count()->sortKeysDesc()->take(30),
                'top_commenters' => $comments->groupBy('author_name')->map->count()->sortDesc()->take(10),
                'most_active_authors' => $users->sortByDesc(function($user) {
                    return $user->posts->count();
                })->take(5)->map(function($user) {
                    return [
                        'name' => $user->name,
                        'posts_count' => $user->posts->count(),
                        'latest_post' => $user->posts->sortByDesc('created_at')->first()?->title,
                    ];
                }),
            ]
        ];

        return view('admin.dashboard.index', compact('statistics'));
    }
}
