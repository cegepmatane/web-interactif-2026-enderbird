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

// Jouer pistes
document.querySelectorAll('.bouton-piste.jouer').forEach(bouton => {
    bouton.addEventListener('click', function() {
        window.open("https://open.spotify.com/search/" + bouton.value, '_blank');
    });
});
