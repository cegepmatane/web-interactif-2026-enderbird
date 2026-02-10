// AJAX #1 : Recherche
const champRecherche = document.getElementById('champ-recherche');
const listeSuggestions = document.getElementById('liste-suggestions');

function rechercher(recherche){
    listeSuggestions.classList.toggle('active', recherche.length > 0);

    if (recherche.length === 0) {
        listeSuggestions.innerHTML = '';
        return;
    }

    fetch('../recherche-album-morceau.php?recherche=' + encodeURIComponent(recherche))
        .then(resultat => resultat.json())
        .then(donnees => {
            listeSuggestions.innerHTML = '';

            donnees.forEach(donnee => {
                const div = document.createElement('div');
                div.className = 'suggestion';

                div.innerHTML = `
                    <div class="suggestion-pochette">
                        <img src="../images/albums/${donnee.fichier_image ?? "defaut.png"}" alt="Pochette album">
                    </div>
                    <div class="suggestion-info">
                        <div class="suggestion-titre">${donnee.nom ?? ""}</div>
                        <div class="suggestion-artiste">${donnee.artiste ?? ""}</div>
                        <div class="suggestion-point">•</div>
                        <div class="suggestion-annee">${donnee.annee ?? ""}</div>
                        <div class="suggestion-type">${donnee.type ?? ""}</div>
                    </div>
                    
                `;

                listeSuggestions.appendChild(div);
            });
        });
}
champRecherche.addEventListener('input', () => {
    rechercher(champRecherche.value.trim());
});

document.addEventListener('click', (e) => {
    if (!e.target.closest('#zone-recherche')) {
        listeSuggestions.classList.remove('active');
    }
});

