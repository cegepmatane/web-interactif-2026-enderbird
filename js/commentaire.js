// AJAX #4 : Commentaires
document.querySelectorAll('.bouton-commenter').forEach(btn => {
    btn.addEventListener('click', function() {
        const champ = this.previousElementSibling;
        const texte = champ.value.trim();
        if (texte) {
            const liste = this.closest('section').querySelector('.liste-commentaires');
            const nouveau = document.createElement('div');
            nouveau.className = 'commentaire visible';
            nouveau.innerHTML = `
                <div class="avatar-commentaire">🎵</div>
                <div class="contenu-commentaire">
                    <div class="auteur-commentaire">Moi</div>
                    <div class="texte-commentaire">${texte}</div>
                </div>
            `;
            liste.appendChild(nouveau);
            champ.value = '';
        }
    });
});