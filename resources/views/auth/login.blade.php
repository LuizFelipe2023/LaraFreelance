@extends('layouts.guest')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@section('content')
    <div class="login-container">
        <div class="card">
            <div class="card-header">{{ __('Login') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            required autocomplete="current-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Lembrar de mim') }}
                        </label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        @if (Route::has('password.request'))
                            <a class="btn-link" href="{{ route('password.request') }}">
                                {{ __('Esqueceu a senha?') }}
                            </a>
                        @endif
                        <button type="submit" class="btn btn-primary">
                            {{ __('Entrar') }}
                        </button>
                    </div>

                    <div class="text-center mt-2">
                        <span class="text-muted">Ainda não tem uma conta?</span>
                        <a href="{{ route('register') }}" class="btn-link">Cadastre-se</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
