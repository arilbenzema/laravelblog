<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/tentang-blog', [\App\Http\Controllers\AboutController::class,
'index'
])->name('about');


Route::get('/hubungi-kami', function () {
    return view('contact');
})->name('contact');

Route::get('posts/create', [\App\Http\Controllers\PostController::class,'create'])->name('posts.create');
Route::post('posts', [\App\Http\Controllers\PostController::class,'store'])->name('posts.store');

Route::post('posts/{slug}/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');


Route::get('posts/{post:slug}/edit', [\App\Http\Controllers\PostController::class,'edit'])->name('posts.edit');
Route::put('posts/{post:slug}', [\App\Http\Controllers\PostController::class,'update'])->name('posts.update');
Route::delete('posts/{post:slug}', [\App\Http\Controllers\PostController::class,'destroy'])->name('posts.destroy');

Route::get('posts', [\App\Http\Controllers\PostController::class,'index'])->name('posts.index');
Route::get('posts/{slug}', [\App\Http\Controllers\PostController::class,'show'])->name('posts.show');



