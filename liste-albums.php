<?php
    // Album par défaut si $id null
    require_once "accesseur/AlbumDAO.php";
    $albums = AlbumDAO::listerAlbums();

    require_once "accesseur/MorceauDAO.php";

    // IMPORTANT - $utilisateur est créé dans le header
    require_once "header.php";

    // Collection
    require_once "accesseur/CollectionDAO.php";
    $collections = $utilisateur ? (CollectionDAO::listerCollectionsUtilisateur($utilisateur) ?? []) : [];
?>
    <link rel="stylesheet" href="css/liste-albums.css">
    <title>SoundWave - Albums</title>

    <script src="js/general.js" defer></script>

    <!-- #2 - Ajax -->
    <script src="js/ajax-collection.js" defer></script>

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

        <!-- Liste d'albums! -->
        <section id="liste-albums">
        <?php 
        foreach($albums as $album) { 
            $morceauxAlbum = MorceauDAO::detaillerMorceauxAlbum($album);
            
            $albumDansCollection = false;
            foreach($collections as $collection) {
                if ($collection->id_album == $album->id) {
                    $albumDansCollection = true;
                    break;
                }
            }?>
            <article class="album">
                <a href="liste-morceaux.php?id-album=<?= $album->id ?>">
                    <div class="pochette-album">
                        <img src="images/albums/<?=$album->fichier_image?>" alt="Pochette album">
                    </div>
                    <div class="info-album">
                        <h2><?=$album->nom?></h2>
                        <p class="artiste"><?=$album->artiste?></p>
                        <div class="stats-album">
                            <div class="stat-item">
                                <div class="stat-label">Pistes : </div>
                                <div class="stat-nombre"><?=count($morceauxAlbum)?></div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Durée : </div>
                                <div class="stat-nombre"><?=$album->duree?></div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Date sortie : </div>
                                <div class="stat-nombre"><?=$album->date_sortie?></div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Type : </div>
                                <div class="stat-nombre"><?=$album->type?></div>
                            </div>
                        </div>

                    </div>
                </a>
                <!-- AJAX #2 : Bookmark -->
                <button class="bouton-bookmark <?php echo $albumDansCollection ? 'actif' : ''; ?>" 
                    data-item-id="<?= $album->id ?>" 
                    data-user-id="<?= $utilisateur?->id ?>">

                    <?php if($albumDansCollection) { ?>
                    <span>✓</span> Dans ma collection
                    <?php } else { ?>
                    <span>🔖</span> Ajouter à ma collection
                    <?php } ?>
                </button>
            </article>

            <?php } ?>
        </section>
    </main>

<!-- Pied de page -->
<?php
include_once "footer.php";
?>