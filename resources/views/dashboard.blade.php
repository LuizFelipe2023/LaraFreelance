@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            {{-- Painel de boas-vindas --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body d-flex flex-column flex-md-row align-items-center gap-4 p-5 bg-white">

                    <div class="flex-shrink-0 text-center">
                        <img src="{{ asset('imgs/jobs.png') }}" alt="Bem-vindo"
                             class="rounded-circle shadow-sm" width="180">
                    </div>

                    <div class="flex-grow-1">
                        <h1 class="h3 mb-3 text-primary fw-bold">
                            Bem-vindo ao <span class="text-dark">LaraFreelance</span>!
                        </h1>
                        <p class="text-muted fs-5 mb-4">
                            Sua jornada profissional começa aqui. Conecte-se com oportunidades, envie propostas e
                            impulsione sua carreira como freelancer.
                        </p>

                        <a href="{{ route('trabalhos.index') }}"
                           class="btn btn-primary px-4 py-2 fw-semibold shadow-sm">
                            <i class="bi bi-search me-1"></i> Explorar vagas
                        </a>
                    </div>
                </div>
            </div>

    
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="bg-white rounded-4 shadow-sm p-4 h-100 hover-shadow">
                        <i class="bi bi-briefcase text-primary fs-2 mb-2"></i>
                        <h4 class="fw-bold text-primary">{{ $totalTrabalhos }}</h4>
                        <p class="text-muted mb-0">Vagas disponíveis</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-white rounded-4 shadow-sm p-4 h-100 hover-shadow">
                        <i class="bi bi-send-check text-success fs-2 mb-2"></i>
                        <h4 class="fw-bold text-success">{{ $totalCandidaturas }}</h4>
                        <p class="text-muted mb-0">Propostas enviadas</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-white rounded-4 shadow-sm p-4 h-100 hover-shadow">
                        <i class="bi bi-buildings text-warning fs-2 mb-2"></i>
                        <h4 class="fw-bold text-warning">{{ $totalEmpresas }}</h4>
                        <p class="text-muted mb-0">Empresas parceiras</p>
                    </div>
                </div>
            </div>

            <div class="text-center text-muted mt-5 small">
                LaraFreelance é uma plataforma inspirada no LinkedIn, desenvolvida com ❤️ usando Laravel.
            </div>

        </div>
    </div>
</div>
@endsection
