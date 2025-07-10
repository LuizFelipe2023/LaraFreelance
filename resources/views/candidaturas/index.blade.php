@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/dataTables.dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/dataTables.min.js') }}"></script>
<script src="{{ asset('js/tables/candidaturasTable.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/candidaturas.css') }}">
@section('title', 'Candidaturas')
@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold text-dark mb-1">Candidaturas Recebidas</h1>
                <p class="text-muted mb-0">Gerencie todas as candidaturas para suas vagas</p>
            </div>
            <div>
                <button class="btn btn-sm btn-outline-secondary rounded-3 me-2">
                    <i class="bi bi-download me-1"></i> Exportar
                </button>
                <button class="btn btn-sm btn-primary rounded-3">
                    <i class="bi bi-funnel me-1"></i> Filtrar
                </button>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-0">
                @if(session('success'))
                    <div
                        class="alert alert-success border-0 rounded-0 border-start-0 border-end-0 border-3 border-success bg-light-success">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div
                        class="alert alert-danger border-0 rounded-0 border-start-0 border-end-0 border-3 border-danger bg-light-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    </div>
                @endif

                <div class="list-group list-group-flush">
                    @foreach ($candidaturas as $candidatura)
                        <div class="list-group-item p-4 border-0 border-bottom" style="overflow: visible;">
                            <div class="row align-items-center" style="position: relative;">
                                <!-- Coluna de informações -->
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <div class="d-flex align-items-start">
                                        <div class="me-3">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 48px; height: 48px;">
                                                <i class="bi bi-person-fill text-muted fs-4"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold">{{ $candidatura->nome }}</h5>
                                            <div class="text-muted small mb-1">
                                                <i class="bi bi-envelope me-1"></i> {{ $candidatura->email }}
                                            </div>
                                            <div class="text-muted small">
                                                <i class="bi bi-telephone me-1"></i> {{ $candidatura->telefone }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-2 mb-md-0">
                                    <div class="d-flex flex-column">
                                        <span class="small text-muted">Escolaridade</span>
                                        <span class="fw-medium">{{ ucfirst($candidatura->escolaridade) }}</span>
                                    </div>
                                </div>

                                <div class="col-md-3 text-md-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('candidaturas.show', $candidatura->id) }}"
                                            class="btn btn-sm btn-outline-primary rounded-3 px-3">
                                            <i class="bi bi-eye me-1"></i> Ver
                                        </a>

                                        <div class="dropdown" style="position: static;">
                                            <button class="btn btn-sm btn-outline-secondary rounded-3 px-3 dropdown-toggle"
                                                type="button" id="dropdownMenuButton{{ $candidatura->id }}"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow"
                                                aria-labelledby="dropdownMenuButton{{ $candidatura->id }}"
                                                style="min-width: 200px; position: absolute;">
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center py-2"
                                                        href="{{ route('candidaturas.edit', $candidatura->id) }}">
                                                        <i class="bi bi-pencil me-2"></i> Editar
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center py-2 
                                                          {{ !$candidatura->anexo ? 'disabled text-muted' : '' }}"
                                                        href="{{ $candidatura->anexo ? asset('storage/' . $candidatura->anexo) : '#' }}"
                                                        target="_blank">
                                                        <i class="bi bi-file-earmark-text me-2"></i> Ver Currículo
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider my-1">
                                                </li>
                                                <li>
                                                    <button class="dropdown-item d-flex align-items-center py-2 text-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $candidatura->id }}">
                                                        <i class="bi bi-trash me-2"></i> Excluir
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal de Exclusão -->
                        <div class="modal fade" id="deleteModal{{ $candidatura->id }}" tabindex="-1"
                            aria-labelledby="deleteModalLabel{{ $candidatura->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $candidatura->id }}">Confirmar exclusão
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Fechar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Tem certeza que deseja excluir a candidatura de
                                            <strong>{{ $candidatura->nome }}</strong>?</p>
                                        <p class="small text-muted">Esta ação não pode ser desfeita.</p>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-outline-secondary rounded-3 px-4"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('candidaturas.destroy', $candidatura->id) }}" method="POST"
                                            class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger rounded-3 px-4">Excluir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection