@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@section('title', $trabalho->titulo)

@section('content')


<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Cabeçalho da Vaga -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h1 class="h3 mb-2">{{ $trabalho->titulo }}</h1>
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <span class="badge rounded-pill 
                                        @switch($trabalho->status)
                                            @case('aberto') bg-success @break
                                            @case('em_negociacao') bg-warning text-dark @break
                                            @case('fechado') bg-secondary @break
                                            @default bg-light text-dark
                                        @endswitch">
                                        {{ ucfirst(str_replace('_', ' ', $trabalho->status)) }}
                                    </span>
                                </div>
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i>
                                    Publicado {{ $trabalho->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                        
                        @if(auth()->user() && auth()->user()->id == $trabalho->cliente_id)
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary rounded-circle" type="button" 
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Editar</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Excluir</a></li>
                            </ul>
                        </div>
                        @endif
                    </div>

                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0">
                            <div class="avatar avatar-lg bg-light rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-building text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">{{ $trabalho->cliente->name ?? 'Empresa não informada' }}</h5>
                            <small class="text-muted">Contratante</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h4 class="h5 mb-3 text-dark">
                        <i class="bi bi-file-text me-2 text-primary"></i> Sobre a oportunidade
                    </h4>
                    <div class="job-description">
                        {!! $trabalho->descricao !!}
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-5">
                <a href="{{ route('trabalhos.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-1"></i> Voltar para vagas
                </a>
                
                @if($trabalho->status === 'aberto')
                <a href="{{ route('candidaturas.create', ['trabalho' => $trabalho->id]) }}" 
                   class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-send-check me-1"></i> Candidatar-se agora
                </a>
                @else
                <button class="btn btn-secondary rounded-pill px-4" disabled>
                    <i class="bi bi-lock me-1"></i> Vaga encerrada
                </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection