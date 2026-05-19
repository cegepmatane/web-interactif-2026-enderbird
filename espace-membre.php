<?php
    // Album par défaut si $id null
    require_once "accesseur/AlbumDAO.php";
    $albumCollections = AlbumDAO::detaillerAlbum(new Album(['id' => $id]));

    // IMPORTANT - $utilisateur est créé dans le header
    require_once "header.php";

    require_once "accesseur/MorceauDAO.php";
    $morceauxFavoris = MorceauDAO::detaillerMorceauxFavoris($utilisateur);

    // Favori (presque pareil que collection)
    require_once "accesseur/FavoriDAO.php";
    $favoris = FavoriDAO::listerFavorisUtilisateur($utilisateur) ?? [];
?>

    <title>SoundWave - Ma Musique</title>

    <!-- #5 - Ajax -->
    <script src="js/ajax-favori.js" defer></script>

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

        <!-- Liste des pistes -->
        <section id="liste-pistes">
            <h2 class="titre-section">🎵 Morceaux favoris</h2>

            <?php 
            if (!$morceauxFavoris){
                echo "<p>Vide pour l'instant, mettez des coeurs sur des morceaux pour les voir apparaître ici !</p>";
            } else {
                $noMorceau = 0;
                foreach($morceauxFavoris as $morceau) { 
                    $noMorceau++;

                    $morceauDansFavori = false;
                    foreach($favoris as $favori) {
                        if ($favori->id_morceau == $morceau->id) {
                            $morceauDansFavori = true;
                            break;
                        }
                    }
                    $album = AlbumDAO::detaillerAlbum(new Album(['id' => $morceau->id_album]));
                ?>

                <article class="piste">
                    <span class="piste-numero"><?=$noMorceau?></span>
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
            
            
            <?php } 
            }?>
        </section>
    </main>

<!-- Pied de page -->
<?php
include_once "footer.php";
?>