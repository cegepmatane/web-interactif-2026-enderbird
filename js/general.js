// Descendre vers l'élement (ANCHOR)
const elementSelectionne = document.querySelector(".selectionne");

if (elementSelectionne) {
    descendreVersElementSelectionne(elementSelectionne);
    appliquerEffetFlash(elementSelectionne);
}
function descendreVersElementSelectionne(elementSelectionne) {
    const navigation = document.querySelector('nav');
    const positionAncre = elementSelectionne.getBoundingClientRect().top + window.scrollY - navigation.offsetHeight - 32;

    window.scrollTo({ top: positionAncre, behavior: 'smooth' });
}
function appliquerEffetFlash(elementSelectionne) {
    elementSelectionne.classList.add("flash");
    setTimeout(retirerEffetFlash, 3000, elementSelectionne);
}
function retirerEffetFlash(elementSelectionne) {
    elementSelectionne.classList.remove("flash");
}

// Observateur pour animations au scroll
function gererIntersection(entrees, observateur) {
    entrees.forEach(gererEntreeIntersection);
}
function gererEntreeIntersection(entree, index) {
    if (entree.isIntersecting) {
        setTimeout(appliquerClasseVisible, index * 80, entree.target);
    }
}
function appliquerClasseVisible(element) {
    element.classList.add('visible');
}
const observateur = new IntersectionObserver(gererIntersection, { threshold: 0.1 });


// Observer les éléments
const elementsAObserver = document.querySelectorAll('.item-legende, #album-vedette, .piste, .commentaire, .album');
function observerElement(element) {
    observateur.observe(element);
}
elementsAObserver.forEach(observerElement);


// Jouer pistes
const boutonsJouerPiste = document.querySelectorAll('.bouton-piste.jouer');
function initialiserEvenementBoutonJouer(bouton) {
    bouton.addEventListener('click', gererClicBoutonJouer);
}
boutonsJouerPiste.forEach(initialiserEvenementBoutonJouer);

function gererClicBoutonJouer(evenement) {
    const bouton = evenement.currentTarget;
    window.open("https://open.spotify.com/search/" + bouton.value, '_blank');
}

// Cool script pour sélectionner la page active :) 
(function () {
    if (window.hasRunActiveClass) return;
    window.hasRunActiveClass = true;

    const pageActuelle = window.location.pathname;

    document.querySelectorAll("nav a").forEach(lien => {
        const href = lien.getAttribute("href");

        if (!href) return;

        // correspondance stricte
        if (pageActuelle === href) {
            lien.classList.add("actif");
        }
    });
})();