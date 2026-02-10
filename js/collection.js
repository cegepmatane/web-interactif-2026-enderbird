// AJAX #2 : Bookmark
document.querySelectorAll('.bouton-bookmark').forEach(btn => {
    btn.addEventListener('click', function() {
        this.classList.toggle('actif');
        const texte = this.querySelector('span').nextSibling;
        if (this.classList.contains('actif')) {
            this.innerHTML = '<span>✓</span> Dans ma collection';
        } else {
            this.innerHTML = '<span>🔖</span> Ajouter à ma collection';
        }
    });
});