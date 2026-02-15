// AJAX #2 : Bookmark
document.querySelectorAll('.bouton-bookmark').forEach(btn => {
    btn.addEventListener('click', async function() {
        const idAlbum = this.dataset.itemId;
        const idUtilisateur = this.dataset.userId;

        try {
            // Attendre la réponse
            const response = await fetch('../ajax-collectionner.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id_album: idAlbum, id_utilisateur: idUtilisateur })
            });

            // // Débuggage si erreur php
            // const text = await response.text();
            // console.error('Non-JSON response:', text);

            const resultat = await response.json();
            if (resultat.reussite && resultat.type) {
                if (resultat.type == "Ajouter" && !this.classList.contains('actif')) {
                    this.classList.add('actif');
                    this.innerHTML = '<span>✓</span> Dans ma collection';
                }
                if (resultat.type == "Effacer" && this.classList.contains('actif')) {
                    this.classList.remove('actif');
                    this.innerHTML = '<span>🔖</span> Ajouter à ma collection';
                }
            } else {
                console.error('Server error:', resultat.message);
            }
            
        } catch (erreur) {
            console.error('Fetch error:', erreur);
        }
    });
});