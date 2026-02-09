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
document.querySelectorAll('.item-legende, .album-vedette, .piste, .commentaire').forEach(el => {
    observateur.observe(el);
});

// SPLASH : Afficher les morceaux
document.addEventListener('DOMContentLoaded', () => {
    const albums = document.querySelectorAll('.album-vedette');

    albums.forEach(album => {
        const overlay = album.querySelector('.overlay-afficher');
        const splashMorceaux = album.querySelector('.splash-morceaux');
        const texte = overlay.querySelector('p');

        overlay.addEventListener('click', () => {
            splashMorceaux.classList.toggle('actif');

            if (splashMorceaux.classList.contains('actif')) {
                texte.textContent = 'Masquer les morceaux';
            } else {
                texte.textContent = 'Afficher les morceaux';
                splashMorceaux.querySelectorAll('.piste').forEach(piste => {
                    piste.classList.remove('visible');
                });
            }
        });
    });
});