<?php
    require_once "accesseur/AlbumDAO.php";
    $albumVedette = new Album(['id' => 2]);
    $albumVedette = AlbumDAO::detaillerAlbum($albumVedette);

    require_once "accesseur/MorceauDAO.php";
    $morceauxAlbumVedette = MorceauDAO::detaillerMorceauxAlbum($albumVedette);

    require_once "accesseur/VoteDAO.php";
    $votes = VoteDAO::listerVotesAlbum($albumVedette);
    $premierVote = $votes[0];

    // AFFICHAGE
    include_once "header.php";
?>
    <title>SoundWave - Ma Musique</title>

    <!-- #3 - Ajax -->
    <script src="js/vote.js" defer></script>

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
                <img src="images/<?=$albumVedette->fichier_image?>" alt="Pochette album">
            </div>
            <div class="info-album-vedette">
                <h2><?=$albumVedette->nom?></h2>
                <p class="artiste-vedette"><?=$albumVedette->artiste?></p>

                <div class="stats-album">
                    <div class="stat-item">
                        <div class="stat-nombre"><?=count($morceauxAlbumVedette)?></div>
                        <div class="stat-label">Pistes</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre"><?=$albumVedette->duree?></div>
                        <div class="stat-label">Durée</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre"><?=$albumVedette->date_sortie?></div>
                        <div class="stat-label">Date sortie</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre"><?=$albumVedette->type?></div>
                        <div class="stat-label">Type</div>
                    </div>
                </div>

                <!-- AJAX #3 : Rating -->
                <div class="zone-rating" data-item-id="<?= $albumVedette->id ?>" data-user-id="0">
                    <span>Votre note :</span>
                    <div class="etoiles">
                        <span class="etoile" data-note="1">⭐</span>
                        <span class="etoile" data-note="2">⭐</span>
                        <span class="etoile" data-note="3">⭐</span>
                        <span class="etoile" data-note="4">⭐</span>
                        <span class="etoile" data-note="5">⭐</span>
                    </div>
                    <span class="moyenne-rating"><?= $premierVote->moyenne ?> / 5</span>
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

            <?php foreach($morceauxAlbumVedette as $morceau) { ?>

            <article class="piste">
                <span class="piste-numero"><?=$morceau->ordre?></span>
                <div class="piste-pochette">
                    <img src="images/<?=$albumVedette->fichier_image?>" alt="Pochette">
                </div>
                <div class="piste-info">
                    <div class="piste-titre"><?=$morceau->titre?></div>
                    <div class="piste-artiste"><?=$morceau->artiste?></div>
                </div>
                <span class="piste-duree"><?=$morceau->duree?></span>
                <div class="piste-actions">
                    <button class="bouton-piste favori" title="Favoris">❤️</button>
                    <button value="<?=$morceau->artiste?> <?=$morceau->titre?>" class="bouton-piste jouer" title="Jouer">▶️</button>
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

<!-- Pied de page -->
<?php
include_once "footer.php";
?>