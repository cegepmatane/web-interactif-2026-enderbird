<?php
// echo dirname(__DIR__, 2) . "/dao/AlbumDAO.php";
include dirname(__DIR__, 2) . "/dao/AlbumDAO.php";
$albumNo1 = AlbumDAO::detaillerAlbum(2);
$dureeAlbumNo1 = AlbumDAO::getDureeAlbum(2);
// print_r($albumNo1);
// print_r($dureeAlbumNo1);

include dirname(__DIR__, 2) . "/dao/MorceauDAO.php";
$morceauxNo1 = MorceauDAO::detaillerMorceauxAlbum(2);
// print_r($morceauxNo1);

// AFFICHAGE
require_once dirname(__DIR__) . "/header.php";
?>

    <title>SoundWave - Ma Musique</title>
    <link rel="stylesheet" href="../css/general.css">

    <main id="contenu-principal">
        <!-- Légende Ajax -->
        <section id="legende-ajax">
            <div class="item-legende">
                <div class="icone-legende">🔍</div>
                <div class="titre-legende">Recherche</div>
                <div class="desc-legende">Auto-complete Ajax</div>
            </div>
            <div class="item-legende">
                <div class="icone-legende">🔖</div>
                <div class="titre-legende">Bookmark</div>
                <div class="desc-legende">Sauvegarder albums</div>
            </div>
            <div class="item-legende">
                <div class="icone-legende">⭐</div>
                <div class="titre-legende">Rating</div>
                <div class="desc-legende">Noter les albums</div>
            </div>
            <div class="item-legende">
                <div class="icone-legende">💬</div>
                <div class="titre-legende">Commentaire</div>
                <div class="desc-legende">Réagir sans reload</div>
            </div>
        </section>

        <!-- Album en vedette avec pochette personnalisable -->
        <section id="album-vedette">
            <div class="pochette-album">
                <img src="../../images/albums/<?= $albumNo1->id_image ?>.png" alt="Pochette album">
                <div class="overlay-personnaliser">
                    <span>🎨</span>
                    <p>Personnaliser la pochette</p>
                </div>
            </div>
            <div class="info-album-vedette">
                <h2><?= $albumNo1->nom ?></h2>
                <p class="artiste-vedette"><?= $albumNo1->artiste ?></p>

                <div class="stats-album">
                    <div class="stat-item">
                        <div class="stat-nombre"><?= count($morceauxNo1) ?></div>
                        <div class="stat-label">Pistes</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre"><?= $dureeAlbumNo1 ?></div>
                        <div class="stat-label">Durée</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre"><?= $albumNo1->date_sortie ?></div>
                        <div class="stat-label">Date sortie</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre"><?= $albumNo1->type ?></div>
                        <div class="stat-label">Type</div>
                    </div>
                </div>

                <!-- AJAX #3 : Rating -->
                <div class="zone-rating">
                    <span>Votre note :</span>
                    <div class="etoiles">
                        <span class="etoile active" data-note="1">⭐</span>
                        <span class="etoile active" data-note="2">⭐</span>
                        <span class="etoile active" data-note="3">⭐</span>
                        <span class="etoile active" data-note="4">⭐</span>
                        <span class="etoile" data-note="5">⭐</span>
                    </div>
                    <span class="moyenne-rating">4.3 / 5</span>
                </div>

                <!-- AJAX #2 : Bookmark -->
                <button class="bouton-bookmark">
                    <span>🔖</span> Ajouter à ma collection
                </button>
            </div>
        </section>

        <!-- Liste des pistes -->
        <section id="liste-pistes">
            <h2 class="titre-section">🎵 Pistes de l'album</h2>

            <?php foreach($morceauxNo1 as $morceau) { ?>

            <article class="piste">
                <span class="piste-numero"><?= $morceau->ordre ?></span>
                <div class="piste-pochette">
                    <img src="../../images/albums/<?= $albumNo1->id_image ?>.png" alt="Pochette">
                </div>
                <div class="piste-info">
                    <div class="piste-titre"><?= $morceau->titre ?></div>
                    <div class="piste-artiste"><?= $morceau->artiste ?></div>
                </div>
                <span class="piste-duree"><?= $morceau->duree ?></span>
                <div class="piste-actions">
                    <button class="bouton-piste favori" title="Favoris">❤️</button>
                    <button value="<?=$morceau->artiste ?> <?= $morceau->titre ?>" class="bouton-piste jouer" title="Jouer">▶️</button>
                </div>
            </article>
            
            <?php } ?>
            
            <!-- <article class="piste">
                <span class="piste-numero">2</span>
                <div class="piste-pochette">
                    <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=100&h=100&fit=crop" alt="Pochette">
                </div>
                <div class="piste-info">
                    <div class="piste-titre">Neon Boulevard</div>
                    <div class="piste-artiste">Synthwave Collective</div>
                </div>
                <span class="piste-duree">3:45</span>
                <div class="piste-actions">
                    <button class="bouton-piste favori actif" title="Favoris">❤️</button>
                    <button class="bouton-piste" title="Jouer">▶️</button>
                </div>
            </article> -->

        </section>

        <!-- AJAX #4 : Commentaires -->
        <section id="section-commentaires">
            <h2 class="titre-section">💬 Commentaires (3)</h2>

            <div class="liste-commentaires">
                <div class="commentaire">
                    <div class="avatar-commentaire">🎧</div>
                    <div class="contenu-commentaire">
                        <div class="auteur-commentaire">DJ_Maxime</div>
                        <div class="texte-commentaire">Cet album est incroyable ! La piste 3 est mon coup de coeur 💜</div>
                    </div>
                </div>
                <!-- <div class="commentaire">
                    <div class="avatar-commentaire">🎹</div>
                    <div class="contenu-commentaire">
                        <div class="auteur-commentaire">SynthLover42</div>
                        <div class="texte-commentaire">Les vibes rétro sont parfaites. On se croirait dans les années 80 !</div>
                    </div>
                </div> -->
            </div>

            <div class="formulaire-commentaire">
                <input type="text" class="champ-commentaire" placeholder="Partagez votre avis sur cet album...">
                <button class="bouton-commenter">Envoyer</button>
            </div>
        </section>
    </main>



    <script>
        // Observateur pour animations au scroll
        const observateur = new IntersectionObserver((entrees) => {
            entrees.forEach((entree, index) => {
                if (entree.isIntersecting) {
                    setTimeout(() => {
                        entree.target.classList.add('visible');
                    }, index * 80);
                }
            });
        }, { threshold: 0.1 });

        // Observer les éléments
        document.querySelectorAll('.item-legende, #album-vedette, .piste, .commentaire').forEach(el => {
            observateur.observe(el);
        });

        // AJAX #1 : Recherche
        const champRecherche = document.getElementById('champ-recherche');
        const listeSuggestions = document.getElementById('liste-suggestions');

        champRecherche.addEventListener('input', () => {
            listeSuggestions.classList.toggle('active', champRecherche.value.length > 0);
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('#zone-recherche')) {
                listeSuggestions.classList.remove('active');
            }
        });

        // AJAX #2 : Bookmark
        document.querySelectorAll('.bouton-bookmark').forEach(btn => {
            btn.addEventListener('click', function() {
                this.classList.toggle('actif');
                const texte = this.querySelector('span').nextSibling;
                if (this.classList.contains('actif')) {
                    this.innerHTML = '<span>✓</span> Dans ma collection';
                } else {
                    this.innerHTML = '<span>🔖</span> Ajouter à ma collection';
                }
            });
        });

        // AJAX #3 : Rating
        document.querySelectorAll('.zone-rating').forEach(zone => {
            const etoiles = zone.querySelectorAll('.etoile');
            etoiles.forEach(etoile => {
                etoile.addEventListener('click', function() {
                    const note = parseInt(this.dataset.note);
                    etoiles.forEach((e, i) => {
                        e.classList.toggle('active', i < note);
                    });
                });
            });
        });

        // Favoris pistes
        document.querySelectorAll('.bouton-piste.favori').forEach(btn => {
            btn.addEventListener('click', function() {
                this.classList.toggle('actif');
            });
        });
        // Jouer pistes
        document.querySelectorAll('.bouton-piste.jouer').forEach(btn => {
            btn.addEventListener('click', function() {
                let search = "https://open.spotify.com/search/" + btn.value;
                window.open(search, '_blank');
            });
        });

        // AJAX #4 : Commentaires
        document.querySelectorAll('.bouton-commenter').forEach(btn => {
            btn.addEventListener('click', function() {
                const champ = this.previousElementSibling;
                const texte = champ.value.trim();
                if (texte) {
                    const liste = this.closest('section').querySelector('.liste-commentaires');
                    const nouveau = document.createElement('div');
                    nouveau.className = 'commentaire visible';
                    nouveau.innerHTML = `
                        <div class="avatar-commentaire">🎵</div>
                        <div class="contenu-commentaire">
                            <div class="auteur-commentaire">Moi</div>
                            <div class="texte-commentaire">${texte}</div>
                        </div>
                    `;
                    liste.appendChild(nouveau);
                    champ.value = '';
                }
            });
        });
    </script>

<!-- Pied de page -->
<?php
require_once dirname(__DIR__) . "/footer.php";
?>