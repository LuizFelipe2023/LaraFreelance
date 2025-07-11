document.querySelectorAll('.favorito-btn').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.preventDefault();

        const candidaturaId = this.dataset.candidaturaId;
        const icon = this.querySelector('i');
        const label = this.querySelector('.favorito-text');

        fetch(favoritoToggleUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ candidatura_id: candidaturaId })
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
