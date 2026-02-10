<?php
    //https://web.wavesofsounds.space/index.php?albumvedette=7
    if(isset($_GET['albumvedette'])) {
        $id = filter_var($_GET['albumvedette'], FILTER_VALIDATE_INT);
    }
    
    // Album par défaut si $id null
    require_once "accesseur/AlbumDAO.php";
    $albumVedette = AlbumDAO::detaillerAlbum(new Album(['id' => $id])) ?? AlbumDAO::detaillerAlbum(new Album(['id' => 1]));

    require_once "accesseur/MorceauDAO.php";
    $morceauxAlbumVedette = MorceauDAO::detaillerMorceauxAlbum($albumVedette);

    // Votes
    require_once "accesseur/VoteDAO.php";
    $votes = VoteDAO::listerVotesAlbum($albumVedette);
    if ($votes) {
        $vote = $votes[0];
    }
    else {
        $vote = VoteDAO::listerVotes()[0];
        $vote->moyenne = 0;
    }

    // Commentaires
    require_once "accesseur/CommentaireDAO.php";
    $commentaires = CommentaireDAO::listerCommentairesAlbum($albumVedette);

    include_once "header.php";
?>
    <title>SoundWave - Ma Musique</title>

    <!-- #3 - Ajax -->
    <script src="js/vote.js" defer></script>

    <!-- #4 - Ajax -->
    <script src="js/commentaire.js" defer></script>

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
                <img src="images/albums/<?=$albumVedette->fichier_image?>" alt="Pochette album">
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
                    <span class="moyenne-rating"><?= $vote->moyenne ?> / 5</span>
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
                    <img src="images/albums/<?=$albumVedette->fichier_image?>" alt="Pochette">
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
    
        </section>

        <!-- AJAX #4 : Commentaires -->
        <section id="section-commentaires">
            <h2 class="titre-section">💬 Commentaires (<?= count($commentaires ?? 0) ?>)</h2>

            <div class="liste-commentaires" data-user-avatar="<?= $utilisateur->fichier_image ?? 'defaut.jpg' ?>" data-item-id="<?= $albumVedette->id ?>" data-user-id="0">
            
                <?php foreach($commentaires as $commentaire) { ?>

                <div class="commentaire">
                    <div class="avatar-commentaire">
                        <img src="images/utilisateurs/<?= $utilisateur->fichier_image ?? "defaut.jpg" ?>" alt="avatar">
                    </div>
                    <div class="contenu-commentaire">
                        <div class="auteur-commentaire"><?= $commentaire->id_utilisateur ?></div>
                        <div class="texte-commentaire"><?= $commentaire->message ?></div>
                    </div>
                </div>
            
                <?php } ?>
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