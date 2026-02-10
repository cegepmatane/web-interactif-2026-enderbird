<?php
    require_once "accesseur/AlbumDAO.php";
    $albums = AlbumDAO::listerAlbums();

    require_once "accesseur/MorceauDAO.php";
    // $album = new Album(['id' => 1]);
    // $morceauxNo1 = MorceauDAO::detaillerMorceauxAlbum($album);
    // print_r($morceauxNo1);

    // AFFICHAGE
    include_once "header.php";
?>

    <title>SoundWave - Découvrez des choses</title>
    <script src="js/splash.js" defer></script>
    <link rel="stylesheet" href="css/splash.css">

    <main id="contenu-principal">
        
        <?php foreach($albums as $album) { 
            $morceaux = MorceauDAO::detaillerMorceauxAlbum($album);
        ?>

        <!-- Album en vedette avec pochette personnalisable -->
        <section class="album-splash visible">
            <div class="pochette-album">
                <img src="images/<?=$album->fichier_image?>" alt="Pochette album">
                <div class="overlay-afficher">
                    <span>🎶</span>
                    <p>Afficher les infos</p>
                </div>
            </div>

            <div class="info-album-splash">
                <h2><?=$album->nom?></h2>
                <p class="artiste-splash"><?=$album->artiste?></p>

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
            </div>

            <!-- Container caché -->
            <div class="splash-morceaux">
                <?php foreach($morceaux as $morceau) { ?>
                    <article class="piste">
                        <span class="piste-numero"><?=$morceau->ordre?></span>
                        <div class="piste-info">
                            <div class="piste-titre"><?=$morceau->titre?></div>
                            <div class="piste-artiste"><?=$morceau->artiste?></div>
                        </div>
                        <span class="piste-duree"><?=$morceau->duree?></span>
                    </article>
                <?php } ?>
            </div>
        </section>

        <?php } ?>
    </main>

<!-- Pied de page -->
<?php
include_once "footer.php";
?>