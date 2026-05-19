// SPLASH : Afficher les morceaux
const albumsSplash = document.querySelectorAll('.album-splash');

function initialiserAlbumSplash(album) {
    const overlay = album.querySelector('.overlay-afficher');
    const splashMorceaux = album.querySelector('.splash-morceaux');
    const infoAlbum = album.querySelector('.info-album-splash');
    const texte = overlay.querySelector('p');

    overlay.addEventListener('click', function() {
        gererClicOverlay(album, splashMorceaux, infoAlbum, texte);
    });
}

albumsSplash.forEach(initialiserAlbumSplash);

function gererClicOverlay(album, splashMorceaux, infoAlbum, texte) {
    splashMorceaux.classList.toggle('actif');
    infoAlbum.classList.toggle('actif');
    album.classList.toggle('actif');

    if (splashMorceaux.classList.contains('actif')) {
        texte.textContent = 'Masquer les infos';
    } else {
        texte.textContent = 'Afficher les infos';

        const pistes = splashMorceaux.querySelectorAll('.piste');
        pistes.forEach(retirerClasseVisible);

        infoAlbum.classList.remove('visible');
    }

    // Pour que ça soit beau
    descendreVersAlbum(album);
}

function retirerClasseVisible(piste) {
    piste.classList.remove('visible');
}

function descendreVersAlbum(album) {
    const navigation = document.querySelector('nav');
    const albumTop = album.getBoundingClientRect().top + window.scrollY - navigation.offsetHeight;
    window.scrollTo({ top: albumTop, behavior: 'smooth' });
}
