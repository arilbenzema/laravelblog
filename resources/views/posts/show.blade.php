@extends('layouts.app')

@section('title', $post->title)
@section('content')

@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

<div class="container py-5" style="max-width: 700px;">

  {{-- Header + Actions --}}
  <div class="d-flex justify-content-between align-items-start mb-3">
    <h1 class="fw-bold mb-0">{{ $post->title }}</h1>

    <div class="d-flex gap-2">
      <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit Post</a>

      <form action="{{ route('posts.destroy', $post) }}" method="POST"
            onsubmit="return confirm('Are sure you want to delete this post? This action cannot be undone');" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Delete Post</button>
      </form>
    </div>
  </div>

  <div class="text-muted small mb-3">
    <time datetime="{{ $post->created_at }}">{{ $post->created_at->format('d M Y') }}</time>
    <span class="badge bg-primary-subtle text-primary">{{ $post->category }}</span>
  </div>

  <div class="mb-4">
    {!! nl2br(e($post->content)) !!}
  </div>

  <div class="d-flex align-items-center gap-2 mt-4">
    @if($post->image)
      <img src="{{ $post->image }}" class="rounded-circle" width="48" height="48" alt="{{ $post->author }}">
    @else
      <div class="rounded-circle bg-secondary" style="width:48px;height:48px;"></div>
    @endif
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
