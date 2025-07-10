@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/dataTables.dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/dataTables.min.js') }}"></script>
<script src="{{ asset('js/tables/usersTable.js') }}"></script>

@section('title', 'Usuários')

@section('content')
    <div class="container d-flex justify-content-center my-5">
        <div class="card w-100" style="max-width: 900px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Lista de Usuários</h2>
                    <a href="{{ route('users.createUser') }}" class="btn btn-primary">
                        <i class="bi bi-person-plus"></i> Novo Usuário
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger text-center">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="filterTipoUsuario" class="form-label">Filtrar por Tipo de Usuário:</label>
                        <select id="filterTipoUsuario" class="form-select">
                            <option value="">Todos</option>
                            @foreach ($tiposUsuario as $tipo)
                                <option value="{{ $tipo->nome }}">{{ $tipo->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="table-responsive">
                    <table id="usuariosTable" class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Tipo de Usuário</th>
                                <th class="text-center" style="width: 150px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $usuario)
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->tipoUsuario->nome ?? '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('users.editUser', $usuario->id) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteUserModal{{ $usuario->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <div class="modal fade" id="deleteUserModal{{ $usuario->id }}" tabindex="-1"
                                            aria-labelledby="deleteUserLabel{{ $usuario->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteUserLabel{{ $usuario->id }}">Confirmar
                                                            exclusão</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Fechar"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        Tem certeza que deseja excluir o usuário
                                                        <strong>{{ $usuario->name }}</strong>?
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>

                                                        <form action="{{ route('users.deleteUser', $usuario->id) }}"
                                                            method="POST" class="m-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Excluir</button>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection