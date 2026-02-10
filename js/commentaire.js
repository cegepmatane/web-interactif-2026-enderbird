// AJAX #4 : Commentaires
document.querySelectorAll('.bouton-commenter').forEach(bouton => {
    bouton.addEventListener('click', async function() {
        const liste = this.closest('section').querySelector('.liste-commentaires');
        const avatarFichierImage = liste.dataset.userAvatar;
        const idAlbum = liste.dataset.itemId;
        const idUtilisateur = liste.dataset.userId;

        const champ = this.previousElementSibling;
        const texte = champ.value.trim();

        if (texte) {
            try {
                // Attendre la réponse
                const response = await fetch('../commenter.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id_album: idAlbum, id_utilisateur: idUtilisateur, message: texte })
                });

                // // Débuggage si erreur php
                // const text = await response.text();
                // console.error('Non-JSON response:', text);

                const resultat = await response.json();
                if (!resultat.reussite) {
                    console.error('Server error:', resultat.message);
                } else {
                    const nouveau = document.createElement('div');
                    nouveau.className = 'commentaire visible';
                    nouveau.innerHTML = `
                        <div class="avatar-commentaire">
                            <img src="image/utilisateurs/${avatarFichierImage}" alt="avatar">
                        </div>
                        <div class="contenu-commentaire">
                            <div class="auteur-commentaire">${idUtilisateur}</div>
                            <div class="texte-commentaire">${texte}</div>
                        </div>
                    `;
                    this.closest('section').querySelector('.liste-commentaires').appendChild(nouveau);
                    champ.value = '';
                }
            } catch (erreur) {
                console.error('Fetch error:', erreur);
            }
        }
    });
});