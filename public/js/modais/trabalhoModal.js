$(document).ready(function() {
    $('#descricao').summernote({
        placeholder: 'Descreva os detalhes do trabalho...',
        tabsize: 2,
        height: 200,
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link', 'picture']],
          ['view', ['codeview']]
        ]
    });

    $('#btnOpenConfirmModal').click(function() {
        $('#previewTitulo').val($('#titulo').val());
        $('#previewStatus').val($('#status option:selected').text());

        if ($('#previewDescricao').next('.note-editor').length) {
            $('#previewDescricao').summernote('destroy');
        }

        $('#previewDescricao').val($('#descricao').summernote('code'));

        $('#previewDescricao').summernote({
            toolbar: false,
            airMode: false,
            disableDragAndDrop: true,
            height: 200,
            callbacks: {
                onInit: function() {
                    $('#previewDescricao').summernote('disable');
                }
            }
        });

        let confirmModal = new bootstrap.Modal(document.getElementById('confirmSubmitModal'));
        confirmModal.show();
    });

    $('#btnConfirmSubmit').click(function() {
        $('#trabalhoForm').submit();
    });
});