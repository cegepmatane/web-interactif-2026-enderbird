<?php
    require_once "accesseur/AlbumDAO.php";
    require_once "accesseur/MorceauDAO.php";

    // $_GET - https://web.wavesofsounds.space/liste-morceaux.php?id-album=5
    $idAlbumGET = 1;
    if(isset($_GET['id-album'])) {
        $idAlbumGET = filter_var($_GET['id-album'], FILTER_VALIDATE_INT);

        $album = AlbumDAO::detaillerAlbum(new Album(['id' => $idAlbumGET]));
    }
    // $_GET - https://web.wavesofsounds.space/liste-morceaux.php?id-morceau=26
    $idMorceauGET = 0;
    $ordreMorceauGET = 0;
    if(isset($_GET['id-morceau'])) {
        $idMorceauGET = filter_var($_GET['id-morceau'], FILTER_VALIDATE_INT);

        $morceau = MorceauDAO::detaillerMorceau(new Morceau(['id' => $idMorceauGET]));
        $ordreMorceauGET = $morceau->ordre;
        $album = AlbumDAO::detaillerAlbum(new Album(['id' => $morceau->id_album]));
    }
    // Si $_GET n'est pas valide
    if (!$album) {
        header("Location: liste-albums.php");
        exit(); 
    }

    $morceaux = MorceauDAO::detaillerMorceauxAlbum($album);
    // Si $_GET['id-morceau'] n'est pas dans l'album

    // Commentaires
    require_once "accesseur/CommentaireDAO.php";
    $commentaires = CommentaireDAO::listerCommentairesAlbum($album);

    // IMPORTANT - $utilisateur est créé dans le header
    require_once "header.php";

    // Votes
    require_once "accesseur/VoteDAO.php";
    $votes = VoteDAO::listerVotesAlbum($album);
    $vote = new Vote(['id_utilisateur' => $utilisateur->id, 'id_album' => $album->id, 'moyenne' => ($votes[0]->moyenne ?? 0)]);
    if ($votes) {
        foreach($votes as $voteTemp) {
            if ($voteTemp->id_utilisateur == $utilisateur->id) $vote = VoteDAO::detaillerVote($vote);
        }
    }
    
    // Collection
    require_once "accesseur/CollectionDAO.php";
    $collections = CollectionDAO::listerCollectionsUtilisateur($utilisateur) ?? [];

    $albumDansCollection = false;
    foreach($collections as $collection) {
        if ($collection->id_album == $album->id) {
            $albumDansCollection = true;
            break;
        }
    }

    // Favori (presque pareil que collection)
    require_once "accesseur/FavoriDAO.php";
    $favoris = FavoriDAO::listerFavorisUtilisateur($utilisateur) ?? [];
?>
    
    <title><?= $album->nom ?> - <?= $album->artiste ?></title>

    <!-- #3 - Ajax -->
    <script src="js/ajax-vote.js" defer></script>
    <!-- #2 - Ajax -->
    <script src="js/ajax-collection.js" defer></script>
    <!-- #5 - Ajax -->
    <script src="js/ajax-favori.js" defer></script>
    <!-- #4 - Ajax -->
    <script src="js/ajax-commentaire.js" defer></script>

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
        <section id="album-vedette" <?php if ($ordreMorceauGET == 0) echo 'class="selectionne"'?>>
            <div class="pochette-album">
                <img src="images/albums/<?=$album->fichier_image?>" alt="Pochette album">
            </div>
            <div class="info-album-vedette">
                <h2><?=$album->nom?></h2>
                <p class="artiste-vedette"><?=$album->artiste?></p>

                <div class="stats-album">
                    <div class="stat-item">
                        <div class="stat-nombre"><?=count($morceaux)?></div>
                        <div class="stat-label">Pistes</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre"><?=$album->duree?></div>
                        <div class="stat-label">Durée</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre"><?=$album->date_sortie?></div>
                        <div class="stat-label">Date sortie</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre"><?=$album->type?></div>
                        <div class="stat-label">Type</div>
                    </div>
                </div>

                <!-- AJAX #3 : Rating -->
                <div class="zone-rating" 
                    data-item-id="<?= $album->id ?>" 
                    data-user-id="<?= $utilisateur->id ?>">
                    <span>Votre note :</span>
                    <div class="etoiles">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span class="etoile <?= ($vote->note >= $i) ? 'active' : '' ?>" data-note="<?= $i ?>">⭐</span>
                        <?php endfor; ?>
                    </div>
                    <span class="moyenne-rating"><?= $vote->moyenne ?> / 5</span>
                </div>

                <!-- AJAX #2 : Bookmark -->
                <button class="bouton-bookmark <?php echo $albumDansCollection ? 'actif' : ''; ?>" 
                    data-item-id="<?= $album->id ?>" 
                    data-user-id="<?= $utilisateur->id ?>">
                    
                    <?php if($albumDansCollection) { ?>
                    <span>✓</span> Dans ma collection
                    <?php } else { ?>
                    <span>🔖</span> Ajouter à ma collection
                    <?php } ?>
                </button>
            </div>
        </section>

        <!-- Liste des pistes -->
        <section id="liste-pistes">
            <h2 class="titre-section">🎵 Pistes de l'album</h2>

            <?php foreach($morceaux as $morceau) { 
                $morceauDansFavori = false;
                foreach($favoris as $favori) {
                    if ($favori->id_morceau == $morceau->id) {
                        $morceauDansFavori = true;
                        break;
                    }
                }?>
                
                <article class="piste <?php if ($morceau->ordre == $ordreMorceauGET) echo 'selectionne'?>">
                    <span class="piste-numero"><?=$morceau->ordre?></span>
                    <div class="piste-pochette">
                        <img src="images/albums/<?=$album->fichier_image?>" alt="Pochette">
                    </div>
                    <div class="piste-info">
                        <div class="piste-titre"><?=$morceau->titre?></div>
                        <div class="piste-artiste"><?=$morceau->artiste?></div>
                    </div>
                    <span class="piste-duree"><?=$morceau->duree?></span>
                    <div class="piste-actions">
                        <button class="bouton-piste favori <?php echo $morceauDansFavori ? 'actif' : ''; ?>" title="Favoris" 
                        data-item-id="<?= $morceau->id ?>" 
                        data-user-id="<?= $utilisateur->id ?>">❤️</button>
                        <button value="<?=$morceau->artiste?> <?=$morceau->titre?>" class="bouton-piste jouer" title="Jouer">▶️</button>
                    </div>
                </article>
            
            <?php } ?>
        </section>

        <!-- AJAX #4 : Commentaires -->
        <section id="section-commentaires">
            <h2 class="titre-section">💬 Commentaires (<?= count($commentaires ?? 0) ?>)</h2>

            <div class="liste-commentaires" 
                data-item-id="<?= $album->id ?>" 
                data-user-id="<?= $utilisateur->id ?>">
            
                <?php foreach($commentaires as $commentaire) { 
                    $utilisateurCommentaire = UtilisateurDAO::detaillerUtilisateur(new Utilisateur(['id' => $commentaire->id_utilisateur]));
                ?>
                    <div class="commentaire" data-item-id="<?= $commentaire->id ?>">
                        <div class="avatar-commentaire">
                            <img src="images/utilisateurs/<?= $utilisateurCommentaire->fichier_image ?>" alt="avatar">
                        </div>
                        <div class="contenu-commentaire">
                            <div class="auteur-commentaire"><?= $utilisateurCommentaire->pseudo ?></div>
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