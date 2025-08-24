@extends('layouts.app')
@section('title', 'Edit Post')
@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      @if($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
          </ul>
        </div>
      @endif

      {{--edit blog post--}}
      <div class="card shadow-sm border-0">
        <div class="card-header bg-white"><h5 class="mb-0">Edit Blog Post</h5></div>
        <div class="card-body">
          <form action="{{ route('posts.update', $post) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-3">
              <label class="form-label">Title</label>
              <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                     value="{{ old('title', $post->title) }}" required>
              @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Slug --}}
            <div class="mb-3">
              <label class="form-label">Slug</label>
              <div class="input-group">
                <span class="input-group-text">/posts/</span>
                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                       value="{{ old('slug', $post->slug) }}" required>
              </div>
              @error('slug') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            {{-- Author Information --}}
            <div class="mb-3">
              <label class="form-label">Content</label>
              <textarea name="content" rows="6" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $post->content) }}</textarea>
              @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Author</label>
                <input type="text" name="author" class="form-control @error('author') is-invalid @enderror"
                       value="{{ old('author', $post->author) }}" required>
                @error('author') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label">Author Info</label>
                <input type="text" name="author_info" class="form-control @error('author_info') is-invalid @enderror"
                       value="{{ old('author_info', $post->author_info) }}" required>
                @error('author_info') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="row g-3 mt-0">
              <div class="col-md-6">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control @error('category') is-invalid @enderror"
                       value="{{ old('category', $post->category) }}" required>
                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label">Image (URL)</label>
                <input type="text" name="image" class="form-control @error('image') is-invalid @enderror"
                       value="{{ old('image', $post->image) }}" placeholder="https://...">
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="d-flex gap-2 mt-4">
              <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
              <a href="{{ route('posts.index', $post) }}" class="btn btn-light">Batal</a>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
