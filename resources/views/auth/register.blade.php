@extends('layouts.guest')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@section('content')
    <div class="register-container">
        <div class="card">
            <div class="card-header">{{ __('Criar Conta') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row g-4">

                        <div class="col-md-6">
                            <label for="name" class="form-label">Nome completo</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tipo_usuario" class="form-label">Tipo de Usuário</label>
                            <select id="tipo_usuario" class="form-select @error('tipo_usuario') is-invalid @enderror"
                                name="tipo_usuario" required>
                                <option value="" disabled selected>Selecione o tipo</option>
                                @foreach($tiposUsuario as $tipo)
                                    @if(in_array($tipo->id, [2, 3]))
                                        <option value="{{ $tipo->id }}" {{ old('tipo_usuario') == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->nome }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('tipo_usuario')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">Senha</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="password-confirm" class="form-label">Confirmar Senha</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('login') }}" class="btn-link">
                            Já possui conta?
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Criar Conta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection