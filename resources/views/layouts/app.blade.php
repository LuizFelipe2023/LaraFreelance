<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ url('/') }}">
                    <i class="bi bi-briefcase-fill me-2"></i>
                    <span class="fw-bold">LaraFreelance</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto d-flex gap-3 align-items-center">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('candidaturas.index') }}">
                                    <i class="bi bi-file-earmark-text me-1"></i> Candidaturas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('trabalhos.index') }}">
                                    <i class="bi bi-briefcase me-1"></i> Trabalhos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.index') }}">
                                    <i class="bi bi-people me-1"></i> Usuários
                                </a>
                            </li>
                        @endauth

                        @guest
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary px-3 py-1 mx-1" href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary px-3 py-1 mx-1" href="{{ route('register') }}">
                                    <i class="bi bi-person-plus me-1"></i> Registrar
                                </a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    <i class="bi bi-person-circle me-1"></i>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person me-2"></i> {{ __('Perfil') }}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Sair') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main class="py-4 mt-5 mb-5">
            <div class="container">
                @yield('content')
            </div>
        </main>

        <footer class="bg-white py-3 border-top fixed-bottom">
            <div class="container">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <div class="mb-2 mb-md-0">
                        <span class="text-muted small">© {{ now()->year }} LaraFreelance. Todos os direitos
                            reservados.</span>
                    </div>

                    <div class="social-icons">
                        <a class="btn btn-sm btn-outline-secondary m-1" href="#" title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a class="btn btn-sm btn-outline-secondary m-1" href="#" title="Twitter">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a class="btn btn-sm btn-outline-secondary m-1" href="#" title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a class="btn btn-sm btn-outline-secondary m-1" href="#" title="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a class="btn btn-sm btn-outline-secondary m-1" href="#" title="GitHub">
                            <i class="bi bi-github"></i>
                        </a>
                    </div>

                    <div class="mt-2 mt-md-0">
                        <a href="https://getbootstrap.com/docs/5.3/icons/" class="text-muted small" target="_blank">
                            <i class="bi bi-box-seam me-1"></i> Bootstrap Icons
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>

</html>