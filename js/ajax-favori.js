// Favoris pistes
document.querySelectorAll('.bouton-piste.favori').forEach(btn => {
    btn.addEventListener('click', async function() {
        const idMorceau = this.dataset.itemId;
        const idUtilisateur = this.dataset.userId;

        try {
            // Attendre la réponse
            const response = await fetch('../ajax-ajouter-supprimer-favori.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id_morceau: idMorceau, id_utilisateur: idUtilisateur })
            });

            // // Débuggage si erreur php
            // const text = await response.text();
            // console.error('Non-JSON response:', text);

            const resultat = await response.json();
            if (resultat.reussite && resultat.type) {
                if (resultat.type == "Ajouter" && !this.classList.contains('actif')) {
                    this.classList.add('actif');
                }
                if (resultat.type == "Effacer" && this.classList.contains('actif')) {
                    this.classList.remove('actif');
                }
            } else {
                console.error('Server error:', resultat.message);
            }
            
        } catch (erreur) {
            console.error('Fetch error:', erreur);
        }
    });
});