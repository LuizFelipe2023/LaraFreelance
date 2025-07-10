@extends('layouts.app')

@section('title', 'Detalhes da Candidatura')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Cabeçalho estilo LinkedIn -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 fw-bold text-dark mb-1">Detalhes da Candidatura</h1>
                    <p class="text-muted mb-0">Informações completas do candidato</p>
                </div>
                <a href="{{ route('candidaturas.index') }}" class="btn btn-sm btn-outline-secondary rounded-3 px-3 d-flex align-items-center">
                    <i class="bi bi-arrow-left me-1"></i> Voltar
                </a>
            </div>

            <!-- Card principal estilo LinkedIn -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <!-- Seção de perfil -->
                    <div class="d-flex align-items-start mb-4">
                        <div class="flex-grow-1 ms-3">
                            <h2 class="h5 fw-bold mb-1">{{ $candidatura->nome }}</h2>
                            <div class="text-muted mb-2">
                                <i class="bi bi-envelope me-1"></i> {{ $candidatura->email }}
                            </div>
                            <div class="text-muted">
                                <i class="bi bi-telephone me-1"></i> {{ $candidatura->telefone }}
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Seção de informações -->
                    <div class="mb-4">
                        <h3 class="h6 fw-bold text-dark mb-3">Informações Pessoais</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small mb-1">Endereço</label>
                                <div class="fw-normal">{{ $candidatura->endereco }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small mb-1">Escolaridade</label>
                                <div class="fw-normal">{{ ucfirst(str_replace('_', ' ', $candidatura->escolaridade)) }}</div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Seção de currículo -->
                    <div>
                        <h3 class="h6 fw-bold text-dark mb-3">Currículo</h3>
                        @if($candidatura->anexo)
                            <a href="{{ asset('storage/curriculos/' . $candidatura->anexo) }}" target="_blank" class="btn btn-outline-primary rounded-3 px-4 d-inline-flex align-items-center">
                                <i class="bi bi-file-earmark-pdf me-2"></i> Visualizar Currículo
                            </a>
                            <small class="text-muted d-block mt-2">Formato: PDF</small>
                        @else
                            <div class="alert alert-light border rounded-3">
                                <i class="bi bi-info-circle me-2"></i> Nenhum currículo foi enviado.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Ações (opcional) -->
            <div class="d-flex justify-content-end gap-2">
                <a href="#" class="btn btn-outline-secondary rounded-3 px-4">Enviar Mensagem</a>
                <a href="#" class="btn btn-primary rounded-3 px-4">Marcar como Favorito</a>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 12px;
    }
    .btn {
        transition: all 0.2s;
    }
    hr {
        opacity: 0.1;
    }
</style>
@endsection