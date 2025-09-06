@extends('layouts.app')
@section('title', 'Posts')
@section('content')

<div class="container py-5">
{{-- Intro --}}
  <div class="text-center">
    <h2 class="h4 fw-light text-dark mb-1">Blog Post</h2>
    <p class="text-muted small mb-0">
      Platform Pembelajaran Pengaturcaraan.
    </p>
  </div>

<!-- Search Component dengan Input Group (tanpa absolute) -->
<div class="mx-auto mb-4" style="max-width: 500px;">
  <form method="GET" action="{{ route('posts.index') }}">
    <div class="input-group input-group-md">

      <!-- Ikon search kiri -->
      <span class="input-group-text bg-white">
        <i class="bi bi-search text-muted"></i>
      </span>

      <!-- Input -->
      <input type="text"
             name="search"
             value="{{ request('search') }}"
             class="form-control"
             placeholder="Search posts..."
             aria-label="Search posts">

      <!-- Clear button -->
      @if(request('search'))
        <button type="button"
                onclick="document.querySelector('input[name=search]').value=''; this.closest('form').submit();"
                class="btn btn-outline-secondary">
          <i class="bi bi-x-circle"></i>
        </button>
      @endif

      <!-- Submit button -->
      <button class="btn btn-primary" type="submit">
        <i class="bi bi-search"></i> Cari
      </button>
    </div>
  </form>
</div>
<!-- End -->
  @can('create', App\Models\Post::class)
  <div class="container py-5 d-flex justify-content-start">
    <a href="{{ route('posts.create') }}" class="btn btn-primary">
        + Tambah Blog Post
    </a>
</div>
  @endcan

<!-- Search Results Info -->
@if(request('search'))
  <div class="mb-4 text-center">
    <p class="text-muted small">
      Showing results for
      "<span class="fw-semibold">{{ request('search') }}</span>"

      @if($posts->count() > 0)
        – {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} found
      @else
        – No posts found
      @endif
    </p>
  </div>
@endif
<!-- End -->

{{-- Cards --}}
  <div class="container py-5">
  <div class="vstack gap-4">

        @foreach ($posts as $post)
      <article class="card h-100 shadow-sm" style="max-width: 700px;">
        <div class="card-body">
          <div class="d-flex align-items-center gap-2 small text-muted mb-2">
            <time datetime="{{ $post->created_at }}">{{ $post->created_at->format('d M Y') }}</time>
            <span class="badge bg-primary-subtle text-primary">{{ $post->category }}</span>
          </div>

          <h3 class="h5 mb-2 fw-bold">
            <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none link-dark link-opacity-75-hover">
              {{ $post->title }}
            </a>
          </h3>

          <p class="card-text text-secondary small mb-0">
            {{ $post->content }}
          </p>
        </div>

        <div class="card-footer bg-white border-0 pt-0">
          <hr class="mt-0 mb-3">
          <div class="d-flex align-items-center gap-2">
            <img src="{{ $post->image }}"
                 alt="" class="rounded-circle" width="32" height="32">
            <div class="small">
              <div class="fw-medium text-dark">{{ $post->author }}</div>
              <div class="text-muted">{{ $post->author_info }}</div>
            </div>
          </div>
        </div>
      </article>

        @endforeach
    </div>
</div>

@endsection
