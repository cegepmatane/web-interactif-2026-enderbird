document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('#navigation-utilisateur .utilisateur')
    .forEach(link => {
        link.addEventListener('click', async function(e) {
            e.preventDefault(); // empêcher le href="#" de scroller

            const idUtilisateur = this.dataset.userId;

            try {
                const response = await fetch('../ajax-changer-utilisateur.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `id_utilisateur=${idUtilisateur}`
                });

                // // Débuggage si erreur php
                // const text = await response.text();
                // console.error('Non-JSON response:', text);

                const resultat = await response.json();

                if (resultat.reussite) {
                    // Recharge la page après mise à jour de la session
                    window.location.reload();
                } else {
                    console.error('Erreur serveur AJAX');
                }
            } catch (erreur) {
                console.error(erreur);
            }
        });
    });
});
