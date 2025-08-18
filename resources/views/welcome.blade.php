@extends('layouts.app')

@section('content')

<div class="container py-5">
  {{-- Header --}}
  <div class="text-center mb-5">
    <h1 class="h3 fw-light text-dark mb-2">Aplikasi Blog</h1>
    <p class="text-muted small mb-0">Platform Pembelajaran Pengaturcaraan</p>
  </div>

  {{-- Intro --}}
  <div class="mb-4">
    <h2 class="h4 fw-light text-dark mb-1">Dari Blog Kami</h2>
    <p class="text-muted small mb-0">
      Belajar cara membangunkan kemahiran pengaturcaraan dan teknologi dengan panduan kami.
    </p>
  </div>

  {{-- Cards --}}
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

    <div class="col">
      <article class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center gap-2 small text-muted mb-2">
            <time datetime="2024-12-15">15 Dis 2024</time>
            <span class="badge bg-primary-subtle text-primary">Pembangunan Web</span>
          </div>

          <h3 class="h5 mb-2 fw-bold">
            <a href="#" class="text-decoration-none link-dark link-opacity-75-hover">
              Asas Laravel untuk Pemula
            </a>
          </h3>

          <p class="card-text text-secondary small mb-0">
            Pelajari asas-asas Laravel dari awal hingga mahir. Panduan lengkap untuk memulakan projek pertama anda
            dengan kerangka kerja PHP yang popular ini. Termasuk tips dan trik untuk pembangunan yang berkesan.
          </p>
        </div>

        <div class="card-footer bg-white border-0 pt-0">
          <hr class="mt-0 mb-3">
          <div class="d-flex align-items-center gap-2">
            <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                 alt="" class="rounded-circle" width="32" height="32">
            <div class="small">
              <div class="fw-medium text-dark">Ahmad Rahman</div>
              <div class="text-muted">Pengajar Laravel</div>
            </div>
          </div>
        </div>
      </article>
    </div>

    <div class="col">
      <article class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center gap-2 small text-muted mb-2">
            <time datetime="2024-12-10">10 Dis 2024</time>
            <span class="badge bg-success-subtle text-success">Pangkalan Data</span>
          </div>

          <h3 class="h5 mb-2 fw-bold">
            <a href="#" class="text-decoration-none link-dark link-opacity-75-hover">
              Menguasai Eloquent ORM dalam Laravel
            </a>
          </h3>

          <p class="card-text text-secondary small mb-0">
            Panduan komprehensif untuk menggunakan Eloquent ORM dengan berkesan. Pelajari relationship, query builder,
            dan tips optimisasi untuk aplikasi yang lebih pantas.
          </p>
        </div>

        <div class="card-footer bg-white border-0 pt-0">
          <hr class="mt-0 mb-3">
          <div class="d-flex align-items-center gap-2">
            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                 alt="" class="rounded-circle" width="32" height="32">
            <div class="small">
              <div class="fw-medium text-dark">Siti Nurhaliza</div>
              <div class="text-muted">Pembangun Backend</div>
            </div>
          </div>
        </div>
      </article>
    </div>

    <div class="col">
      <article class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center gap-2 small text-muted mb-2">
            <time datetime="2024-12-05">5 Dis 2024</time>
            <span class="badge bg-purple-subtle text-purple" style="--bs-text-opacity:1">Frontend</span>
          </div>

          <h3 class="h5 mb-2 fw-bold">
            <a href="#" class="text-decoration-none link-dark link-opacity-75-hover">
              Reka Bentuk Responsif dengan Tailwind CSS
            </a>
          </h3>

          <p class="card-text text-secondary small mb-0">
            Pelajari cara mencipta antara muka pengguna yang menarik dan responsif menggunakan Tailwind CSS.
            Tips dan teknik terkini untuk reka bentuk web moden yang mesra mudah alih.
          </p>
        </div>

        <div class="card-footer bg-white border-0 pt-0">
          <hr class="mt-0 mb-3">
          <div class="d-flex align-items-center gap-2">
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                 alt="" class="rounded-circle" width="32" height="32">
            <div class="small">
              <div class="fw-medium text-dark">Farid Azman</div>
              <div class="text-muted">Pereka UI/UX</div>
            </div>
          </div>
        </div>
      </article>
    </div>

  </div>
</div>
@endsection
