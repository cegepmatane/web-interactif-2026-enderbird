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

        overlay.addEventListener('click', () => {
            splashMorceaux.classList = 'splash-morceaux actif';

            // Toggle tracks display
            if (overlay.querySelector('p').textContent = 'Afficher les morceaux') {
                overlay.querySelector('p').textContent = 'Masquer les morceaux';
            } else {
                overlay.querySelector('p').textContent = 'Afficher les morceaux';
            }
        });
    });
});