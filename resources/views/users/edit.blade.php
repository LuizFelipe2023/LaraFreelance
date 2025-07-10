@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">

@section('content')
<div class="register-container">
    <div class="card">
        <div class="card-header">Editar Usuário</div>

        <div class="card-body">
            <form method="POST" action="{{ route('users.updateUser', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome completo</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="tipo_usuario" class="form-label">Tipo de Usuário</label>
                        <select id="tipo_usuario" class="form-select @error('tipo_usuario') is-invalid @enderror"
                            name="tipo_usuario" required>
                            <option value="" disabled>Selecione o tipo</option>
                            @foreach($usuariosTipo as $tipo)
                                @if(in_array($tipo->id, [2, 3]))
                                    <option value="{{ $tipo->id }}" {{ $user->tipo_usuario == $tipo->id ? 'selected' : '' }}>
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
                        <label for="password" class="form-label">Nova Senha</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Deixe em branco para manter a senha atual.</small>
                    </div>

                    <div class="col-md-12">
                        <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
                        <input id="password_confirmation" type="password" class="form-control"
                            name="password_confirmation">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
