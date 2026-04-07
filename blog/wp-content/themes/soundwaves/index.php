<?php
    // require_once "accesseur/AlbumDAO.php";
    // $albumVedette = AlbumDAO::listerAlbumVedette()[0];

    // require_once "accesseur/MorceauDAO.php";
    // $morceauxAlbumVedette = MorceauDAO::detaillerMorceauxAlbum($albumVedette);

    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', true);
    define('WP_DEBUG_DISPLAY', true);
    ini_set('display_errors', 1);

    require_once get_template_directory() . "/accesseur/AlbumDAO.php";
    require_once get_template_directory() . "/accesseur/MorceauDAO.php";

    $albumVedette = AlbumDAO::listerAlbumVedette()[0];
    $morceauxAlbumVedette = MorceauDAO::detaillerMorceauxAlbum($albumVedette);

    get_header();
?>

    <title>SoundWave - Ma Musique</title>

    <main id="contenu-principal">
        <!-- Album en vedette avec pochette personnalisable -->
        <section id="album-vedette">
            <div class="pochette-album">
                <img src="https://web.wavesofsounds.space/images/albums/<?=$albumVedette->fichier_image?>" alt="Pochette album">
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
            </div>
        </section>

        <!-- Liste des pistes -->
        <section id="liste-pistes">
            <h2 class="titre-section">🎵 Pistes de l'album</h2>

            <?php foreach($morceauxAlbumVedette as $morceau) { ?>
            <article class="piste">
                <span class="piste-numero"><?=$morceau->ordre?></span>
                <div class="piste-pochette">
                    <img src="https://web.wavesofsounds.space/images/albums/<?=$albumVedette->fichier_image?>" alt="Pochette">
                </div>
                <div class="piste-info">
                    <div class="piste-titre"><?=$morceau->titre?></div>
                    <div class="piste-artiste"><?=$morceau->artiste?></div>
                </div>
                <span class="piste-duree"><?=$morceau->duree?></span>
                    <button value="<?=$morceau->artiste?> <?=$morceau->titre?>" class="bouton-piste jouer" title="Jouer">▶️</button>
                </div>
            </article>
            
            <?php } ?>
        </section>
    </main>

<!-- Pied de page -->
<?php get_footer(); ?>