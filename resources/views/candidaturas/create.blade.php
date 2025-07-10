@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link href="{{ asset('css/summernote.css') }}" rel="stylesheet">
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/summernote.js') }}"></script>
<script src="{{ asset('js/modais/insertCandidaturaModal.js') }}"></script>
<div class="register-container mt-5 mb-5">
    <div class="card">
        <div class="card-header">Nova Candidatura</div>

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        <div class="card-body">
            <form id="candidaturaForm" method="POST" action="{{ route('candidaturas.store', ['trabalho' => $trabalhoId]) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="trabalho_id" value="{{ $trabalhoId }}">

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome Completo</label>
                        <input id="nome" type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}" required>
                        @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input id="telefone" type="text" name="telefone" class="form-control @error('telefone') is-invalid @enderror" value="{{ old('telefone') }}" required>
                        @error('telefone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input id="endereco" type="text" name="endereco" class="form-control @error('endereco') is-invalid @enderror" value="{{ old('endereco') }}">
                        @error('endereco') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="escolaridade" class="form-label">Escolaridade</label>
                        <select id="escolaridade" name="escolaridade" class="form-select @error('escolaridade') is-invalid @enderror">
                            <option value="" disabled {{ old('escolaridade') ? '' : 'selected' }}>Selecione</option>
                            <option value="fundamental" {{ old('escolaridade') == 'fundamental' ? 'selected' : '' }}>Fundamental</option>
                            <option value="medio" {{ old('escolaridade') == 'medio' ? 'selected' : '' }}>Médio</option>
                            <option value="superior" {{ old('escolaridade') == 'superior' ? 'selected' : '' }}>Superior</option>
                            <option value="pos_graduacao" {{ old('escolaridade') == 'pos_graduacao' ? 'selected' : '' }}>Pós-graduação</option>
                        </select>
                        @error('escolaridade') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="anexo" class="form-label">Anexar Currículo (PDF)</label>
                        <input id="anexo" type="file" name="anexo" accept=".pdf" class="form-control @error('anexo') is-invalid @enderror">
                        @error('anexo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="observacoes" class="form-label">Observações</label>
                        <textarea id="observacoes" name="observacoes" class="form-control @error('observacoes') is-invalid @enderror" rows="6">{{ old('observacoes') }}</textarea>
                        @error('observacoes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4 gap-2">
                    <button type="button" id="btnOpenConfirmModal" class="btn btn-primary">Salvar</button>
                    <a href="{{ route('candidaturas.index') }}" class="btn btn-warning text-decoration-none">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmSubmitLabel">Confirme os dados antes de enviar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
          <div class="row g-4">
            <div class="col-md-6">
              <label class="form-label">Nome Completo</label>
              <input type="text" id="previewNome" class="form-control" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Telefone</label>
              <input type="text" id="previewTelefone" class="form-control" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">E-mail</label>
              <input type="text" id="previewEmail" class="form-control" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Endereço</label>
              <input type="text" id="previewEndereco" class="form-control" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Escolaridade</label>
              <input type="text" id="previewEscolaridade" class="form-control" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Arquivo do Currículo</label>
              <input type="text" id="previewAnexo" class="form-control" readonly>
            </div>
            <div class="col-md-12">
              <label class="form-label">Observações</label>
              <div id="previewObservacoes" class="border rounded p-3" style="min-height: 100px; background: #f8f9fa;"></div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar e Editar</button>
        <button type="button" id="btnConfirmSubmit" class="btn btn-primary">Confirmar Envio</button>
      </div>
    </div>
  </div>
</div>
@endsection
