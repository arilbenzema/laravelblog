@extends('layouts.app')

@section('title', $post->title)
@section('content')


  {{-- Success message --}}
  @if (session('success'))
  <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-0" role="alert">
    {{-- Ikon check-circle --}}
    <i class="bi bi-check-circle-fill me-2"></i>
    <div>{{ session('success') }}</div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


<div class="container py-5" style="max-width: 700px;">

  {{-- Header + Actions --}}
  <div class="d-flex justify-content-between align-items-start mb-3">
    <h1 class="fw-bold mb-0">{{ $post->title }}</h1>

    <div class="d-flex gap-2">
      <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-warning btn-sm">Edit Post</a>

      <form action="{{ route('posts.destroy', $post->slug) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone');" class="d-inline">
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

  {{-- Post content --}}
  <article class="mb-4">
    <div class="bg-white border rounded-3 shadow-sm p-4 p-md-5">
      <div class="text-secondary fs-5 lh-lg" style="white-space: pre-line;">
        {{ $post->content }}
      </div>
    </div>
  </article>

  {{-- Author --}}
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

  {{-- Comment form --}}
  <div class="bg-light border rounded-3 shadow-sm p-4 p-md-5 my-4">
    <h4 class="h5 fw-semibold text-dark mb-4">Leave a Comment</h4>

    @if (session('error'))
      <div class="alert alert-danger mb-4" role="alert">{{ session('error') }}</div>
    @endif

    <form action="{{ route('comments.store', $post->slug) }}" method="POST">
      @csrf
      <div class="row g-3">
        <div class="col-12 col-md-6">
          <label for="author_name" class="form-label">Name *</label>
          <input id="author_name" name="author_name" value="{{ old('author_name') }}"
                 class="form-control @error('author_name') is-invalid @enderror" required>
          @error('author_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-12 col-md-6">
          <label for="author_email" class="form-label">Email *</label>
          <input type="email" id="author_email" name="author_email" value="{{ old('author_email') }}"
                 class="form-control @error('author_email') is-invalid @enderror" required>
          @error('author_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-12">
          <label for="content" class="form-label">Comment *</label>
          <textarea id="content" name="content" rows="4"
                    class="form-control @error('content') is-invalid @enderror"
                    placeholder="Write your comment here..." required>{{ old('content') }}</textarea>
          @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-12">
          <button class="btn btn-primary d-inline-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12M6 12h12"/>
            </svg>
            Post Comment
          </button>
        </div>
      </div>
    </form>
  </div>

  {{-- Comments list (di luar form) --}}
  <div class="mt-5 pt-4 border-top">
    <h3 class="h4 fw-bold text-dark mb-4">
      Comments ({{ $post->comments->count() }})
    </h3>

    @forelse($post->comments as $comment)
      <div class="card mb-3 shadow-sm border-0 border-start border-4 border-primary">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="mb-0 fw-semibold">
              {{ $comment->author_name }}
              <small class="text-muted">• {{ $comment->author_email }}</small>
            </h6>
            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
          </div>
          <p class="mb-0 text-secondary" style="white-space: pre-line;">
            {{ $comment->content }}
          </p>
        </div>
      </div>
    @empty
      <p class="text-muted fst-italic">Belum ada komen.</p>
    @endforelse
  </div>

</div>
@endsection
