// AJAX #3 : Rating
document.querySelectorAll('.zone-rating').forEach(zone => {
    const etoiles = zone.querySelectorAll('.etoile');
    etoiles.forEach(etoile => {
        etoile.addEventListener('click', async function() {
            const moyenneSpan = this.closest('.zone-rating').querySelector('.moyenne-rating');

            // Get PHP values from the zone itself
            const idAlbum = zone.dataset.itemId;
            const idUtilisateur = zone.dataset.userId;
            const note = parseInt(this.dataset.note);

            try {
                // Attendre la réponse
                const response = await fetch('../ajax-voter-etoile.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id_album: idAlbum, id_utilisateur: idUtilisateur, note: note })
                });

                // // Débuggage si erreur php
                // const text = await response.text();
                // console.error('Non-JSON response:', text);

                const resultat = await response.json();
                if (resultat.reussite && resultat.type) {
                    moyenneSpan.textContent = resultat.moyenne + " / 5";
                    
                    if (resultat.type == "Ajouter") {
                        etoiles.forEach((e, i) => { e.classList.toggle('active', i < note); });
                    }
                    if (resultat.type == "Editer") {
                        etoiles.forEach(e => e.classList.remove('active'));

                        if (note != resultat.ancienneNote) etoiles.forEach((e, i) => { e.classList.toggle('active', i < note); });
                        else etoiles.forEach(e => e.classList.remove('active'));
                    }
                    if (resultat.type == "Effacer") {
                        etoiles.forEach(e => e.classList.remove('active'));
                    }
                } else {
                    console.error('Server error:', resultat.message);
                }
                    
            } catch (erreur) {
                console.error('Fetch error:', erreur);
            }
        });
    });
});