// Observateur pour animations au scroll
const observateur = new IntersectionObserver((entrees) => {
    entrees.forEach((entree, index) => {
        if (entree.isIntersecting) {
            setTimeout(() => {
                entree.target.classList.add('visible');
            }, index * 80);
        }
    });
}, { threshold: 0.1 });

// Observer les éléments
document.querySelectorAll('.item-legende, #album-vedette, .piste, .commentaire').forEach(el => {
    observateur.observe(el);
});

// AJAX #1 : Recherche
const champRecherche = document.getElementById('champ-recherche');
const listeSuggestions = document.getElementById('liste-suggestions');

champRecherche.addEventListener('input', () => {
    listeSuggestions.classList.toggle('active', champRecherche.value.length > 0);
});

document.addEventListener('click', (e) => {
    if (!e.target.closest('#zone-recherche')) {
        listeSuggestions.classList.remove('active');
    }
});

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

// AJAX #3 : Rating
document.querySelectorAll('.zone-rating').forEach(zone => {
    const etoiles = zone.querySelectorAll('.etoile');
    etoiles.forEach(etoile => {
        etoile.addEventListener('click', function() {
            const note = parseInt(this.dataset.note);
            etoiles.forEach((e, i) => {
                e.classList.toggle('active', i < note);
            });
        });
    });
});

// Favoris pistes
document.querySelectorAll('.bouton-piste.favori').forEach(btn => {
    btn.addEventListener('click', function() {
        this.classList.toggle('actif');
    });
});
// Jouer pistes
document.querySelectorAll('.bouton-piste.jouer').forEach(btn => {
    btn.addEventListener('click', function() {
        let search = "https://open.spotify.com/search/" + btn.value;
        window.open(search, '_blank');
    });
});

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