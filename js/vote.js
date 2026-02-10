// AJAX #3 : Rating
document.querySelectorAll('.zone-rating').forEach(zone => {
    let dejaVote = false; // Un click seulement

    const etoiles = zone.querySelectorAll('.etoile');
    etoiles.forEach(etoile => {
        etoile.addEventListener('click', async function() {
            if (dejaVote) return; // Rien faire si déjà clické
            dejaVote = true;

            // Get PHP values from the zone itself
            const idAlbum = zone.dataset.itemId;
            const idUtilisateur = zone.dataset.userId;
            const note = parseInt(this.dataset.note);

            etoiles.forEach((e, i) => {
                e.classList.toggle('active', i < note);
            });

            try {
                // Attendre la réponse
                const response = await fetch('../voter-etoile.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id_album: idAlbum, id_utilisateur: idUtilisateur, note: note })
                });

                // // Débuggage si erreur php
                // const text = await response.text();
                // console.error('Non-JSON response:', text);

                const resultat = await response.json();

                if (!resultat.reussite) {
                    console.error('Server error:', resultat.message);
                    
                    // Donner le droit de voter
                    dejaVote = false;
                    etoiles.forEach(e => e.classList.remove('active'));
                }
            } catch (erreur) {
                console.error('Fetch error:', erreur);

                // Donner le droit de voter
                dejaVote = false;
                etoiles.forEach(e => e.classList.remove('active'));
            }
        });
    });
});