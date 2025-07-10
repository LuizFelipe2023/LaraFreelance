<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg fixed-top bg-light navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
                    <i class="bi bi-boxes me-1"></i> <strong class="fw-bold">LaraFreelance</strong>
                </a>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto">

                    </ul>

                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link mx-2" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right pe-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-2" href="{{ route('register') }}">
                                <i class="bi bi-person-plus pe-1"></i>Registrar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <main class="py-4 mt-5">
            @yield('content')
        </main>


        <footer class="text-center text-white">
            <div class="p-3 bg-light">
                <!-- Redes sociais com Bootstrap Icons -->
                <section class="mb-2 social-icons">
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998;" href="#"
                        role="button">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee;" href="#"
                        role="button">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39;" href="#"
                        role="button">
                        <i class="bi bi-google"></i>
                    </a>
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac;" href="#"
                        role="button">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca;" href="#"
                        role="button">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #333333;" href="#"
                        role="button">
                        <i class="bi bi-github"></i>
                    </a>
                </section>

                <!-- Copyright -->
                <div class="text-center text-dark mt-2" style="font-size: 0.9rem;">
                    © {{ now()->year }} Todos os direitos reservados |
                    <a href="https://getbootstrap.com/docs/5.3/icons/">Bootstrap Icons</a>
                </div>
            </div>
        </footer>

    </div>
</body>

</html>