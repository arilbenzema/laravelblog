@extends('layouts.app')

@section('title', $post['title'])

@section('content')
<div class="container py-5" style="max-width: 700px;">
  <h1 class="fw-bold mb-3">{{ $post->title }}</h1>

  <div class="text-muted small mb-3">
    <time datetime="{{ $post->created_at }}">{{ $post->created_at->format('d M Y') }}</time>
    <span class="badge bg-primary-subtle text-primary">{{ $post->category }}</span>
  </div>

  <div class="mb-4">
    {!! nl2br(e($post->content)) !!}
  </div>

  <div class="d-flex align-items-center gap-2 mt-4">
    <img src="{{ $post->image }}" class="rounded-circle" width="48" height="48" alt="">
    <div>
      <strong>{{ $post->author }}</strong><br>
      <small class="text-muted">{{ $post->author_info }}</small>
    </div>
  </div>

  <div class="mt-4">
    <a href="{{ route('posts.index') }}" class="btn btn-outline-primary btn-sm">← Kembali ke Senarai</a>
  </div>
</div>
@endsection
