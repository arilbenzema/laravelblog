<!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="{{url('frontend/assets/img/navbar-logo.svg')}}" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}" href="{{ route('welcome') }}">Laman Utama</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang Blog</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Hubungi Kami</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('posts.index') ? 'active' : '' }}" href="{{ route('posts.index') }}">Blog Posts</a></li>
                        @can('is-admin')
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        @endcan

                {{-- Button Log Masuk--}}
                <div class="d-flex align-items-center gap-3">
                    @auth
                    <span class="text-white">Hello, {{ auth()->user()->name }}!</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                        class="btn btn-danger btn-sm px-4"
                        onclick="return confirm('Are you sure you want to log out?')">Log Keluar
                    </button>
                    </form>
                    <!-- -->
                    @else
                    <a href="{{ route('login') }}"
                    class="btn btn-success btn-sm px-4 {{ request()->routeIs('login') ? 'text-danger fw-bold' : '' }}"
                    aria-current="{{ request()->routeIs('login') ? 'page' : '' }}">Log Masuk
            </a>
                {{-- Button Register --}}
                    <a href="{{ route('register') }}"
                    class="btn btn-primary btn-sm px-4 {{ request()->routeIs('register') ? 'active' : '' }}"
                    aria-current="{{ request()->routeIs('register') ? 'page' : '' }}">Daftar
                    @endauth

            </a>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
