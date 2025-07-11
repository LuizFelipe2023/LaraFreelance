document.querySelectorAll('.favorito-btn').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.preventDefault();

        const trabalhoId = this.dataset.trabalhoId;
        const icon = this.querySelector('i');
        const label = this.querySelector('.favorito-text');

        fetch(favoritoToggleUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ trabalho_id: trabalhoId })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'added') {
                icon.classList.replace('bi-star', 'bi-star-fill');
                label.textContent = 'Desfavoritar';
            } else {
                icon.classList.replace('bi-star-fill', 'bi-star');
                label.textContent = 'Favoritar';
            }
        })
        .catch(err => console.error('Erro ao favoritar:', err));
    });
});
