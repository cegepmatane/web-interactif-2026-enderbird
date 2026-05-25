// AJAX #4 : Commentaires

const listesCommentaires = document.querySelectorAll('.liste-commentaires');

// Update les commentaires toutes les 15 secondes
function mettreAJourTousLesCommentaires() {
    try {
        listesCommentaires.forEach(appelerMiseAJourCommentaire);
    }
    catch (erreur) {
        console.error('Fetch erreur:', erreur);
    }
}
setInterval(mettreAJourTousLesCommentaires, 15000);

function appelerMiseAJourCommentaire(listeCommentaires){ updaterCommentaire(listeCommentaires); }
async function updaterCommentaire(listeCommentaires) {
    try {
        const reponse = await fetch(`/ajax-commenter.php?id_album=${listeCommentaires.dataset.itemId}`);
        const donnees = await reponse.json();

        if (!donnees.reussite) return;

        listeCommentaires.replaceChildren();

        donnees.commentaires.forEach(creerElementCommentaire);

        // Updater la moyenne (visuel)
        const titre = listeCommentaires.closest('section').querySelector('.titre-section');
        titre.textContent = titre.textContent.replace(/\(\d+\)/, `(${listeCommentaires.children.length})`);

    } catch (erreur) {
        console.error('Fetch erreur:', erreur);
    }
}

function creerElementCommentaire(commentaire) {
    const listeCommentaires = document.querySelector(`.liste-commentaires[data-item-id="${commentaire.id_album}"]`) || document.querySelector('.liste-commentaires');

    const nouveau = document.createElement('div');
    nouveau.className = 'commentaire visible';
    nouveau.dataset.itemId = commentaire.id;
    nouveau.innerHTML = `
        <div class="avatar-commentaire">
            <img src="images/utilisateurs/${commentaire.fichier_image}" alt="avatar">
        </div>
        <div class="contenu-commentaire">
            <div class="auteur-commentaire">${commentaire.pseudo}</div>
            <div class="texte-commentaire">${commentaire.message}</div>
        </div>
    `;
    listeCommentaires.append(nouveau);
}


async function envoyerCommentaire(bouton) {
    let listeCommentaires = bouton.closest('section').querySelector('.liste-commentaires');
    const idAlbum = listeCommentaires.dataset.itemId;
    const idUtilisateur = listeCommentaires.dataset.userId;

    const champ = bouton.previousElementSibling;
    const texte = champ.value.trim();

    if (!texte) return;

    try {
        const reponse = await fetch('../ajax-commenter.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                id_album: idAlbum,
                id_utilisateur: idUtilisateur,
                message: texte
            })
        });

        const resultat = await reponse.json();

        if (!resultat.reussite) {
            console.error('Erreur serveur');

            if (resultat.code === "NOT_AUTHENTICATED") {
                window.location.href = "/membre/";
            }
            return;
        }

        updaterCommentaire(listeCommentaires);
        champ.value = '';

    } catch (erreur) {
        console.error('Fetch erreur:', erreur);
    }
}

const boutonsCommenter = document.querySelectorAll('.bouton-commenter');
boutonsCommenter.forEach((bouton) => {
    bouton.addEventListener('click', () => envoyerCommentaire(bouton));
});
const champsCommentaire = document.querySelectorAll('.champ-commentaire');
champsCommentaire.forEach((champ) => {
    champ.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();

            const bouton = e.target
                .closest('.formulaire-commentaire')
                .querySelector('.bouton-commenter');

            envoyerCommentaire(bouton);
        }
    });
});