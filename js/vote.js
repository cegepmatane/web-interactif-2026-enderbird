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