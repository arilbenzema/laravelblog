@extends('layouts.app')
@section('title', 'Create Post')

@section('content')
<div class="container py-4"> {{-- kecilkan dari py-5 ke py-4 --}}
  <div class="row justify-content-center">
    <div class="col-lg-8">

      {{-- Notifikasi --}}
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger">
          <strong>Please check the following inputs:</strong>
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
          <h5 class="mb-0">Tambah Blog Post</h5>
        </div>

        <div class="card-body">
          <form action="{{ route('posts.store') }}" method="POST" novalidate>
            @csrf

            {{-- Title --}}
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" name="title" id="title"
                     class="form-control @error('title') is-invalid @enderror"
                     value="{{ old('title') }}" required autofocus>
              @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Slug --}}
            <div class="mb-3">
              <label for="slug" class="form-label">Slug</label>
              <div class="input-group">
                <span class="input-group-text">/posts/</span>
                <input type="text" name="slug" id="slug"
                       class="form-control @error('slug') is-invalid @enderror"
                       value="{{ old('slug') }}" placeholder="tajuk-post-anda" required>
              </div>
              @error('slug') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
              <div class="form-text">Auto dari tajuk, boleh ubah jika perlu.</div>
            </div>

             {{-- Author Information --}}
            <div class="mb-3">
              <label for="content" class="form-label">Content</label>
              <textarea name="content" id="content" rows="6"
                        class="form-control @error('content') is-invalid @enderror"
                        required>{{ old('content') }}</textarea>
              @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row g-3">

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

              {{-- Category --}}
              <div class="col-md-6">
                <label for="category" class="form-label">Category</label>
                <input type="text" name="category" id="category"
                       class="form-control @error('category') is-invalid @enderror"
                       value="{{ old('category') }}" required>
                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              {{-- Image URL --}}
              <div class="col-md-6">
                <label for="image" class="form-label">Image (URL)</label>
                <input type="text" name="image" id="image"
                       class="form-control @error('image') is-invalid @enderror"
                       value="{{ old('image') }}" placeholder="https://...">
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="d-flex gap-2 mt-4">
              <button type="submit" class="btn btn-primary">Create Post</button>
              <a href="{{ route('posts.index') }}" class="btn btn-light">Batal</a>
            </div>
          </form>
        </div>
      </div>

      <div class="small text-muted mt-3">Tip: Slug dijana automatik daripada tajuk.</div>
    </div>
  </div>
</div>

{{-- Auto-generate slug dari title (Bootstrap only) --}}
<script>
  const titleInput = document.getElementById('title');
  const slugInput  = document.getElementById('slug');
  function slugify(t) {
    return t.toString()
      .normalize('NFD').replace(/[\u0300-\u036f]/g,'')
      .toLowerCase().trim()
      .replace(/[^a-z0-9\s-]/g,'')
      .replace(/\s+/g,'-')
      .replace(/-+/g,'-');
  }
  titleInput?.addEventListener('input', () => {
    if (!slugInput.dataset.touched) slugInput.value = slugify(titleInput.value);
  });
  slugInput?.addEventListener('input', () => slugInput.dataset.touched = true);
</script>
@endsection
