@extends('layouts.app')

@section('content')

{{-- Cards --}}
  <div class="container py-5">
  <div class="d-flex justify-content-center">
      <article class="card h-100 shadow-sm" style="max-width: 700px;">
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
@endsection
