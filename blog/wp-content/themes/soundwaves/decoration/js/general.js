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
const elementsAObserver = document.querySelectorAll('.item-legende, #album-vedette, .piste, .album, .article');
function observerElement(element) {
    observateur.observe(element);
}
elementsAObserver.forEach(observerElement);



