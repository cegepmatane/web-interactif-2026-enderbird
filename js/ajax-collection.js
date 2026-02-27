// AJAX #2 : Bookmark
const boutonsBookmark = document.querySelectorAll('.bouton-bookmark');

function initialiserEvenementBoutonBookmark(bouton) {
    bouton.addEventListener('click', gererClicBoutonBookmark);
}

boutonsBookmark.forEach(initialiserEvenementBoutonBookmark);

async function gererClicBoutonBookmark(evenement) {
    const bouton = evenement.currentTarget;
    const idAlbum = bouton.dataset.itemId;
    const idUtilisateur = bouton.dataset.userId;

    try {
        // Attendre la réponse
        const response = await fetch('ajax-collectionner.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id_album: idAlbum, id_utilisateur: idUtilisateur })
        });

        // // Débuggage si erreur php
        // const text = await response.text();
        // console.error('Non-JSON response:', text);

        const resultat = await response.json();
        if (resultat.reussite && resultat.type) {
            if (resultat.type == "Ajouter" && !bouton.classList.contains('actif')) {
                bouton.classList.add('actif');
                bouton.innerHTML = '<span>✓</span> Dans ma collection';
            }
            if (resultat.type == "Effacer" && bouton.classList.contains('actif')) {
                bouton.classList.remove('actif');
                bouton.innerHTML = '<span>🔖</span> Ajouter à ma collection';
            }
        } else {
            console.error('Server error:', resultat.message);
        }
        
    } catch (erreur) {
        console.error('Fetch error:', erreur);
    }
}
