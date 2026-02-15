// Descendre vers l'élement (ANCHOR)
const selectionne = document.querySelector(".selectionne");
if (selectionne) {
    let ancre = selectionne.getBoundingClientRect().top + window.scrollY - document.querySelector('nav').offsetHeight - 32;
    window.scrollTo({ top: ancre, behavior: 'smooth' });

    // Du css
    selectionne.classList.add("flash");
    setTimeout(() => {
        selectionne.classList.remove("flash");
    }, 3000);
}

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
document.querySelectorAll('.item-legende, #album-vedette, .piste, .commentaire, .album').forEach(el => {
    observateur.observe(el);
});

// Jouer pistes
document.querySelectorAll('.bouton-piste.jouer').forEach(bouton => {
    bouton.addEventListener('click', function() {
        window.open("https://open.spotify.com/search/" + bouton.value, '_blank');
    });
});
