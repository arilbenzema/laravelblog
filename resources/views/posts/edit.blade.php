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

            {{-- Author --}}
             <div class="row g-3">
            <div class="col-md-6">
                <label for="user_id" class="form-label">Author</label>
                @php $selectedId = old('user_id');
                @endphp
            <select name="user_id" id="user_id"
                class="form-select @error('user_id') is-invalid @enderror">
            <option value="">Select an author (optional)</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}" @selected($selectedId == $user->id)>
                {{ $user->name }} ({{ $user->email }})
            </option>
        @endforeach
    </select>
    @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
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
{{-- Auto-update slug on edit (stop when slug manually edited) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
  const titleInput = document.querySelector('input[name="title"]');
  const slugInput  = document.querySelector('input[name="slug"]');
  if (!titleInput || !slugInput) return;

  const slugify = (t) => t.toString()
    .normalize('NFD').replace(/[\u0300-\u036f]/g,'')
    .toLowerCase().trim()
    .replace(/[^a-z0-9\s-]/g,'')
    .replace(/\s+/g,'-')
    .replace(/-+/g,'-');

  // Jika user ubah slug sendiri, hentikan auto-update
  let touched = false;
  slugInput.addEventListener('input', () => { touched = true; });

  // Auto-update selagi slug belum disentuh
  titleInput.addEventListener('input', () => {
    if (!touched) slugInput.value = slugify(titleInput.value);
  });
});
</script>
@endsection

