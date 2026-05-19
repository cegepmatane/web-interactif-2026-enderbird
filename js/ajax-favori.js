// Favoris pistes
const boutonsPisteFavori = document.querySelectorAll('.bouton-piste.favori');

function initialiserEvenementBoutonPisteFavori(bouton) {
    bouton.addEventListener('click', gererClicBoutonPisteFavori);
}

boutonsPisteFavori.forEach(initialiserEvenementBoutonPisteFavori);

async function gererClicBoutonPisteFavori(evenement) {
    const bouton = evenement.currentTarget;

    const idMorceau = bouton.dataset.itemId;
    const idUtilisateur = bouton.dataset.userId;

    try {
        // Attendre la réponse
        const response = await fetch('ajax-ajouter-supprimer-favori.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id_morceau: idMorceau, id_utilisateur: idUtilisateur })
        });

        // // Débuggage si erreur php
        // const text = await response.text();
        // console.error('Non-JSON response:', text);

        const resultat = await response.json();
        if (resultat.reussite && resultat.type) {
            if (resultat.type == "Ajouter" && !bouton.classList.contains('actif')) {
                bouton.classList.add('actif');
            }
            if (resultat.type == "Effacer" && bouton.classList.contains('actif')) {
                bouton.classList.remove('actif');
            }
        } else {
            console.error('Server error:', resultat.message);
        }
        
    } catch (erreur) {
        console.error('Fetch error:', erreur);
    }
}
