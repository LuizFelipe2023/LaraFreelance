@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<link href="{{ asset('css/summernote.css') }}" rel="stylesheet">
<script src="{{ asset('js/summernote.js') }}"></script>
<script src="{{ asset('js/form/trabalhoEditor.js') }}"></script>
<script src="{{ asset('js/modais/trabalhoModal.js') }}"></script>
@section('content')
<div class="register-container">
    <div class="card">
        <div class="card-header">Criar Novo Trabalho</div>

        <div class="card-body">
            <form id="trabalhoForm" method="POST" action="{{ route('trabalhos.store') }}">
                @csrf
                <div class="row g-4">

                    <div class="col-md-12">
                        <label for="titulo" class="form-label">Título</label>
                        <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror"
                            name="titulo" value="{{ old('titulo') }}" required>
                        @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea id="descricao" name="descricao" rows="6"
                            class="form-control @error('descricao') is-invalid @enderror" required>{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" class="form-select @error('status') is-invalid @enderror" name="status" required>
                            <option value="aberto" {{ old('status') == 'aberto' ? 'selected' : '' }}>Aberto</option>
                            <option value="em_negociacao" {{ old('status') == 'em_negociacao' ? 'selected' : '' }}>Em Negociação</option>
                            <option value="fechado" {{ old('status') == 'fechado' ? 'selected' : '' }}>Fechado</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-primary" id="btnOpenConfirmModal">Salvar</button>
                    <a href="{{ route('trabalhos.index') }}" class="btn btn-warning text-decoration-none ms-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmSubmitLabel">Confirme os dados antes de enviar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
          <form id="previewForm">
            <div class="row g-4">
              <div class="col-md-12">
                <label for="previewTitulo" class="form-label">Título</label>
                <input type="text" id="previewTitulo" class="form-control" readonly>
              </div>

              <div class="col-md-12">
                <label for="previewDescricao" class="form-label">Descrição</label>
                <textarea id="previewDescricao" class="form-control" rows="6" readonly></textarea>
              </div>

              <div class="col-md-12">
                <label for="previewStatus" class="form-label">Status</label>
                <input type="text" id="previewStatus" class="form-control" readonly>
              </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar e Editar</button>
        <button type="button" class="btn btn-primary" id="btnConfirmSubmit">Confirmar Envio</button>
      </div>
    </div>
  </div>
</div>
@endsection
