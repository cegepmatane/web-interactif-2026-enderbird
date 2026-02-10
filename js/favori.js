// Favoris pistes
document.querySelectorAll('.bouton-piste.favori').forEach(btn => {
    btn.addEventListener('click', function() {
        this.classList.toggle('actif');
    });
});