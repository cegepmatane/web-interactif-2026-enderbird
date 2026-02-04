<?php
include "../accesseur/AlbumDAO.php";
$albums = AlbumDAO::listerAlbums();

include "../accesseur/MorceauDAO.php";
$morceauxNo1 = MorceauDAO::detaillerMorceauxAlbum(2);

// AFFICHAGE
require_once "../header.php";
?>

    <title>SoundWave - Découvrez des choses</title>
    <link rel="stylesheet" href="../css/splash.css">
    <script src="../js/splash.js" defer></script>

    <!-- En-tête -->
    <header id="entete-principal">
        <h1 id="titre-site">SoundWave</h1>
        <p id="slogan">Ta musique, ton style</p>
    </header>

    <main id="contenu-principal">
        
        <?php foreach($albums as $album) { 
            $morceaux = MorceauDAO::detaillerMorceauxAlbum($album->id);
            $duree = AlbumDAO::getDureeAlbum($album->id);
        ?>

        <!-- Album en vedette avec pochette personnalisable -->
        <section class="album-vedette">
            <div class="pochette-album">
                <img src="../images/<?=AlbumDAO::formater($album->id_image)?>.png" alt="Pochette album">
                <div class="overlay-afficher">
                    <span>🎶</span>
                    <p>Afficher les morceaux</p>
                </div>
            </div>

            <div class="info-album-vedette">
                <h2><?=AlbumDAO::formater($album->nom)?></h2>
                <p class="artiste-vedette"><?=AlbumDAO::formater($album->artiste)?></p>

                <div class="stats-album">
                    <div class="stat-item">
                        <div class="stat-nombre"><?=count($morceaux)?></div>
                        <div class="stat-label">Pistes</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre"><?=AlbumDAO::formater($duree)?></div>
                        <div class="stat-label">Durée</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre"><?=AlbumDAO::formater($album->date_sortie)?></div>
                        <div class="stat-label">Date sortie</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre"><?=AlbumDAO::formater($album->type)?></div>
                        <div class="stat-label">Type</div>
                    </div>
                </div>
            </div>

            <!-- Container caché -->
            <div class="splash-morceaux">
                <?php foreach($morceaux as $morceau) { ?>
                    <article class="piste">
                        <span class="piste-numero"><?=MorceauDAO::formater($morceau->ordre)?></span>
                        <div class="piste-info">
                            <div class="piste-titre"><?=MorceauDAO::formater($morceau->titre)?></div>
                            <div class="piste-artiste"><?=MorceauDAO::formater($morceau->artiste)?></div>
                        </div>
                        <span class="piste-duree"><?=MorceauDAO::formater($morceau->duree)?></span>
                        <div class="piste-actions">
                            <button class="bouton-piste favori" title="Favoris">❤️</button>
                            <button value="<?=MorceauDAO::formater($morceau->artiste)?> <?=MorceauDAO::formater($morceau->titre)?>"         class="bouton-piste jouer" title="Jouer">▶️</button>
                        </div>
                    </article>
                <?php } ?>
            </div>
        </section>

        <?php } ?>
    </main>

<!-- Pied de page -->
<?php
require_once "../footer.php";
?>