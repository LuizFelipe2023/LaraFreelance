@extends('layouts.app')
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<link href="{{ asset('css/summernote.css') }}" rel="stylesheet">
<script src="{{ asset('js/summernote.js') }}"></script>
<script src="{{ asset('js/form/mensagemEditor.js') }}"></script>
@section('title', 'Detalhes da Candidatura')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 fw-bold text-dark mb-1">Detalhes da Candidatura</h1>
                        <p class="text-muted mb-0">Informações completas do candidato</p>
                    </div>
                    <a href="{{ route('candidaturas.index') }}"
                        class="btn btn-sm btn-outline-secondary rounded-3 px-3 d-flex align-items-center">
                        <i class="bi bi-arrow-left me-1"></i> Voltar
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

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start mb-4">
                            <div class="flex-grow-1 ms-3">
                                <h2 class="h5 fw-bold mb-1">{{ $candidatura->nome }}</h2>
                                <div class="text-muted mb-2"><i class="bi bi-envelope me-1"></i> {{ $candidatura->email }}
                                </div>
                                <div class="text-muted"><i class="bi bi-telephone me-1"></i> {{ $candidatura->telefone }}
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Informações Pessoais -->
                        <div class="mb-4">
                            <h3 class="h6 fw-bold text-dark mb-3">Informações Pessoais</h3>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small mb-1">Endereço</label>
                                    <div class="fw-normal">{{ $candidatura->endereco }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small mb-1">Escolaridade</label>
                                    <div class="fw-normal">{{ ucfirst(str_replace('_', ' ', $candidatura->escolaridade)) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div>
                            <h3 class="h6 fw-bold text-dark mb-3">Currículo</h3>
                            @if($candidatura->anexo)
                                <a href="{{ asset('storage/curriculos/' . $candidatura->anexo) }}" target="_blank"
                                    class="btn btn-outline-primary rounded-3 px-4 d-inline-flex align-items-center">
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

                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-outline-info rounded-3 px-4" data-bs-toggle="modal"
                        data-bs-target="#verMensagensModal">
                        Ver Mensagens
                    </button>
                    <button type="button" class="btn btn-outline-secondary rounded-3 px-4" data-bs-toggle="modal"
                        data-bs-target="#mensagemModal">
                        Enviar Mensagem
                    </button>
                    <button class="btn btn-primary rounded-3 px-4 favorito-btn" data-candidatura-id="{{ $candidatura->id }}"
                        data-favoritado="{{ $isFavoritado ? '1' : '0' }}">
                        <i class="bi {{ $isFavoritado ? 'bi-star-fill' : 'bi-star' }}"></i>
                        <span class="ms-1 favorito-text">{{ $isFavoritado ? 'Desfavoritar' : 'Favoritar' }}</span>
                    </button>
                </div>

                <div class="modal fade" id="mensagemModal" tabindex="-1" aria-labelledby="mensagemModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content border-0 shadow rounded-4">
                            <form action="{{ route('mensagens.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="candidatura_id" value="{{ $candidatura->id }}">

                                <div class="modal-header bg-light border-0 rounded-top-4">
                                    <h5 class="modal-title text-primary fw-semibold" id="mensagemModalLabel">
                                        <i class="bi bi-chat-dots-fill me-2"></i> Nova Mensagem
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Fechar"></button>
                                </div>

                                <div class="modal-body px-4">
                                    <div class="mb-3">
                                        <label for="titulo" class="form-label text-muted">Título</label>
                                        <input type="text" name="titulo" id="titulo"
                                            class="form-control rounded-3 shadow-sm" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="corpo" class="form-label text-muted">Corpo da mensagem</label>
                                        <textarea name="corpo" id="corpo" class="form-control rounded-3 shadow-sm" rows="5"
                                            required></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer border-0 bg-light rounded-bottom-4 px-4">
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary px-4">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="verMensagensModal" tabindex="-1" aria-labelledby="verMensagensModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                        <div class="modal-content border-0 shadow rounded-4">
                            <div class="modal-header bg-light border-0 rounded-top-4">
                                <h5 class="modal-title text-primary fw-semibold" id="verMensagensModalLabel">
                                    <i class="bi bi-envelope-paper-fill me-2"></i> Mensagens Enviadas
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Fechar"></button>
                            </div>

                            <div class="modal-body px-4">
                                @if($candidatura->mensagens->isEmpty())
                                    <div class="alert alert-light border text-center">
                                        <i class="bi bi-info-circle me-1"></i> Nenhuma mensagem enviada ainda.
                                    </div>
                                @else
                                    <div class="list-group">
                                        @foreach($candidatura->mensagens as $mensagem)
                                            <div class="list-group-item list-group-item-action mb-3 shadow-sm border-0 rounded-3">
                                                <h6 class="fw-bold text-dark mb-1">{{ $mensagem->titulo }}</h6>
                                                <p class="text-muted small mb-2">{{ $mensagem->corpo }}</p>
                                                <small class="text-muted"><i
                                                        class="bi bi-clock me-1"></i>{{ $mensagem->created_at->format('d/m/Y H:i') }}</small>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="modal-footer bg-light border-0 rounded-bottom-4 px-4">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    const favoritoToggleUrl = "{{ route('favorito.toggle') }}";
                </script>
                <script src="{{ asset('js/favoritos/handleFavoritoCandidatura.js') }}"></script>

            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 12px;
        }

        .btn {
            transition: all 0.2s ease-in-out;
        }

        hr {
            opacity: 0.1;
        }

        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
        }

        .modal-title i {
            opacity: 0.7;
        }

        .list-group-item {
            background-color: #f9f9f9;
        }
    </style>
@endsection