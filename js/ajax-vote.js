// AJAX #3 : Rating
const zonesRating = document.querySelectorAll('.zone-rating');

function initialiserZoneRating(zone) {
    const etoiles = zone.querySelectorAll('.etoile');
    etoiles.forEach(function(etoile) {
        initialiserEvenementEtoile(etoile, zone, etoiles);
    });
}

zonesRating.forEach(initialiserZoneRating);

function initialiserEvenementEtoile(etoile, zone, etoiles) {
    etoile.addEventListener('click', function(evenement) {
        gererClicEtoile(evenement, zone, etoiles);
    });
}

async function gererClicEtoile(evenement, zone, etoiles) {
    const etoileCliquee = evenement.currentTarget;
    const moyenneSpan = etoileCliquee.closest('.zone-rating').querySelector('.moyenne-rating');

    // Get PHP values from the zone itself
    const idAlbum = zone.dataset.itemId;
    const idUtilisateur = zone.dataset.userId;
    const note = parseInt(etoileCliquee.dataset.note);

    try {
        // Attendre la réponse
        const response = await fetch('ajax-voter-etoile.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id_album: idAlbum, id_utilisateur: idUtilisateur, note: note })
        });

        // // Débuggage si erreur php
        // const text = await response.text();
        // console.error('Non-JSON response:', text);

        const resultat = await response.json();

        // Early return si erreur
        if (!resultat.reussite) {
            console.error('Server error:', resultat.message);
            return;
        }

        moyenneSpan.textContent = resultat.moyenne + " / 5";

        switch (resultat.type) {

            case "Ajouter":
                etoiles.forEach(activerEtoileSelonNote(note));
                break;

            case "Editer":
                etoiles.forEach(retirerActivationEtoile);

                if (note != resultat.ancienneNote) {
                    etoiles.forEach(activerEtoileSelonNote(note));
                } else {
                    etoiles.forEach(retirerActivationEtoile);
                }
                break;

            case "Effacer":
                etoiles.forEach(retirerActivationEtoile);
                break;

            default:
                console.error("Type inconnu :", resultat.type);
                break;
        }

    } catch (erreur) {
        console.error('Fetch error:', erreur);
    }
}

function activerEtoileSelonNote(note) {
    return function(etoile, incrementation) {
        etoile.classList.toggle('active', incrementation < note);
    };
}

function retirerActivationEtoile(etoile) {
    etoile.classList.remove('active');
}
