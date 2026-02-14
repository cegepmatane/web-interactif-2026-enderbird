// AJAX #4 : Commentaires

const listesCommentaires = document.querySelectorAll('.liste-commentaires');
// Update les commentaires toutes les 15 secondes
setInterval(() => {
    try {
        listesCommentaires.forEach(listeCommentaires => updaterCommentaire(listeCommentaires));
    }
    catch (erreur) {
        console.error('Fetch erreur:', erreur);
    }
}, 15000);

async function updaterCommentaire(listeCommentaires) {
    try {
        const response = await fetch(`ajax-commenter.php?id_album=${listeCommentaires.dataset.itemId}`);
        const donnees = await response.json();

        if (!donnees.reussite) return;

        listeCommentaires.replaceChildren();

        donnees.commentaires.forEach(commentaire => {
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
            listeCommentaires.prepend(nouveau);
        });
        
        // Updater la moyenne (visuel)
        const titre = listeCommentaires.closest('section').querySelector('.titre-section');
        titre.textContent = titre.textContent.replace(/\(\d+\)/, `(${listeCommentaires.children.length})`);

    } catch (erreur) {
        console.error('Fetch erreur:', erreur);
    }
}

document.querySelectorAll('.bouton-commenter').forEach(bouton => {
    bouton.addEventListener('click', async function() {
        let listeCommentaires = this.closest('section').querySelector('.liste-commentaires');
        const idAlbum = listeCommentaires.dataset.itemId;
        const idUtilisateur = listeCommentaires.dataset.userId;

        const champ = this.previousElementSibling;
        const texte = champ.value.trim();

        if (texte) {
            try {
                // Attendre la réponse
                const response = await fetch('../ajax-commenter.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id_album: idAlbum, id_utilisateur: idUtilisateur, message: texte })
                });

                // // Débuggage si erreur php
                // const text = await response.text();
                // console.error('Non-JSON response:', text);

                const resultat = await response.json();
                if (!resultat.reussite) {
                    console.error('Serveur erreur:', resultat.message);
                } else {
                    listeCommentaires = this.closest('section').querySelector('.liste-commentaires');
                    updaterCommentaire(listeCommentaires);
                    champ.value = '';
                }
            } catch (erreur) {
                console.error('Fetch erreur:', erreur);
            }
        }
    });
});
