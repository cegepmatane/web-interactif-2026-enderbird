// SPLASH : Afficher les morceaux
document.querySelectorAll('.album-splash').forEach(album => {
    const overlay = album.querySelector('.overlay-afficher');
    const splashMorceaux = album.querySelector('.splash-morceaux');
    const infoAlbum = album.querySelector('.info-album-splash');
    const texte = overlay.querySelector('p');

    overlay.addEventListener('click', () => {
        splashMorceaux.classList.toggle('actif');
        infoAlbum.classList.toggle('actif');
        album.classList.toggle('actif');

        if (splashMorceaux.classList.contains('actif')) {
            texte.textContent = 'Masquer les infos';
        } else {
            texte.textContent = 'Afficher les infos';
            splashMorceaux.querySelectorAll('.piste').forEach(piste => {
                piste.classList.remove('visible');
            });
            infoAlbum.classList.remove('visible');
        }

        // Pour que ça soit beau
        let albumTop = album.getBoundingClientRect().top + window.scrollY - document.querySelector('nav').offsetHeight - 10;
        window.scrollTo({ top: albumTop, behavior: 'smooth' });
    });
});
