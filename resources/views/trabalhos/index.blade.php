@extends('layouts.app')

@section('title', 'Oportunidades de Trabalho')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Cabeçalho e Filtros -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0 text-dark">
                            <i class="bi bi-briefcase me-2 text-primary"></i>Oportunidades de Trabalho
                        </h1>
                        @if(auth()->user() && auth()->user()->tipo_usuario == 2)
                            <a href="{{ route('trabalhos.create') }}" class="btn btn-primary rounded-pill px-4">
                                <i class="bi bi-plus-lg me-1"></i> Publicar Vaga
                            </a>
                        @endif
                    </div>

                    <form method="GET" action="{{ route('trabalhos.index') }}">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-search text-muted"></i>
                                    </span>
                                    <input type="text" name="search" value="{{ request('search') }}" 
                                           class="form-control border-start-0" placeholder="Título, descrição ou habilidades">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select name="status" class="form-select">
                                    <option value="">Todos os status</option>
                                    <option value="aberto" {{ request('status') == 'aberto' ? 'selected' : '' }}>Abertas</option>
                                    <option value="em_negociacao" {{ request('status') == 'em_negociacao' ? 'selected' : '' }}>Em negociação</option>
                                    <option value="fechado" {{ request('status') == 'fechado' ? 'selected' : '' }}>Encerradas</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-outline-primary w-100 rounded-pill">
                                    <i class="bi bi-funnel me-1"></i> Filtrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row g-4">
                @forelse ($trabalhos as $trabalho)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        <div class="card-body d-flex flex-column">
                            <!-- Cabeçalho do Card -->
                            <div class="d-flex align-items-start mb-3">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">
                                        <a href="{{ route('trabalhos.show', $trabalho->id) }}" class="text-dark text-decoration-none stretched-link">
                                            {{ $trabalho->titulo }}
                                        </a>
                                    </h5>
                                    <div class="d-flex align-items-center small text-muted mb-2">
                                        <i class="bi bi-building me-1"></i>
                                        <span>{{ $trabalho->cliente->name ?? 'Cliente não especificado' }}</span>
                                    </div>
                                </div>
                                <span class="badge rounded-pill 
                                    @if($trabalho->status === 'aberto') bg-success
                                    @elseif($trabalho->status === 'em_negociacao') bg-warning text-dark
                                    @else bg-secondary @endif">
                                    {{ ucfirst(str_replace('_', ' ', $trabalho->status)) }}
                                </span>
                            </div>

                            <div class="card-text mb-3 text-truncate-3" style="max-height: 6em; overflow: hidden;">
                                {!! strip_tags(Str::limit($trabalho->descricao, 150)) !!}
                            </div>

                            <div class="mt-auto pt-2 border-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ $trabalho->created_at->diffForHumans() }}
                                    </small>
                                    <a href="{{ route('trabalhos.show', $trabalho->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        Ver detalhes
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="bi bi-briefcase display-4 text-muted mb-3"></i>
                            <h4 class="text-muted">Nenhuma oportunidade encontrada</h4>
                            <p class="text-muted mb-4">Tente ajustar seus filtros de busca ou verifique mais tarde.</p>
                            @if(auth()->user() && auth()->user()->tipo_usuario == 2)
                                <a href="{{ route('trabalhos.create') }}" class="btn btn-primary rounded-pill px-4">
                                    <i class="bi bi-plus-lg me-1"></i> Publicar Primeira Vaga
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            @if($trabalhos->hasPages())
            <div class="mt-4">
                <nav aria-label="Page navigation">
                    {{ $trabalhos->withQueryString()->links('pagination::bootstrap-5') }}
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection