$(document).ready(function() {
    $('#observacoes').summernote({
        placeholder: 'Escreva suas observações aqui...',
        tabsize: 2,
        height: 150,
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link']],
          ['view', ['codeview']]
        ]
    });

    $('#btnOpenConfirmModal').click(function() {
        $('#previewNome').val($('#nome').val());
        $('#previewTelefone').val($('#telefone').val());
        $('#previewEmail').val($('#email').val());
        $('#previewEndereco').val($('#endereco').val());
        $('#previewEscolaridade').val($('#escolaridade option:selected').text());

        let anexoInput = $('#anexo')[0];
        if (anexoInput.files.length > 0) {
            $('#previewAnexo').val(anexoInput.files[0].name);
        } else {
            $('#previewAnexo').val('Nenhum arquivo selecionado');
        }

        $('#previewObservacoes').html($('#observacoes').summernote('code'));

       
        let confirmModal = new bootstrap.Modal(document.getElementById('confirmSubmitModal'));
        confirmModal.show();
    });

    $('#btnConfirmSubmit').click(function() {
        $('#candidaturaForm').submit();
    });
});