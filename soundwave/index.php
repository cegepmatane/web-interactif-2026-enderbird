<?php
    include "../accesseur/AlbumDAO.php";
    $albumNo1 = AlbumDAO::detaillerAlbum(2);
    $dureeAlbumNo1 = AlbumDAO::getDureeAlbum(2);

    include "../accesseur/MorceauDAO.php";
    $morceauxNo1 = MorceauDAO::detaillerMorceauxAlbum(2);

    include "../accesseur/VoteDAO.php";

    // AFFICHAGE
    require_once "../header.php";
?>

    <title>SoundWave - Ma Musique</title>
    <link rel="stylesheet" href="../css/general.css">
    <script src="../js/general.js" defer></script>

    <!-- En-tête -->
    <header id="entete-principal">
        <h1 id="titre-site">SoundWave</h1>
        <p id="slogan">Ta musique, ton style</p>

        <!-- AJAX #1 : Recherche auto-complete -->
        <div id="zone-recherche">
            <span id="icone-recherche">🔍</span>
            <input type="text" id="champ-recherche" placeholder="Rechercher un artiste, un album, une piste...">
            <div id="liste-suggestions">
                <div class="suggestion">
                    <div class="suggestion-pochette"></div>
                    <div class="suggestion-info">
                        <div class="suggestion-titre">Neon Dreams</div>
                        <div class="suggestion-artiste">Synthwave Collective</div>
                    </div>
                </div>
                <!-- <div class="suggestion">
                    <div class="suggestion-pochette"></div>
                    <div class="suggestion-info">
                        <div class="suggestion-titre">Midnight City</div>
                        <div class="suggestion-artiste">Electric Pulse</div>
                    </div>
                </div>
                <div class="suggestion">
                    <div class="suggestion-pochette"></div>
                    <div class="suggestion-info">
                        <div class="suggestion-titre">Digital Love</div>
                        <div class="suggestion-artiste">Cyber Symphony</div>
                    </div>
                </div> -->
            </div>
        </div>
    </header>

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
                <img src="../images/<?=AlbumDAO::formater($albumNo1->id_image)?>.png" alt="Pochette album">
            </div>
            <div class="info-album-vedette">
                <h2><?=AlbumDAO::formater($albumNo1->nom)?></h2>
                <p class="artiste-vedette"><?=AlbumDAO::formater($albumNo1->artiste)?></p>

                <div class="stats-album">
                    <div class="stat-item">
                        <div class="stat-nombre"><?=count($morceauxNo1)?></div>
                        <div class="stat-label">Pistes</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre"><?=AlbumDAO::formater($dureeAlbumNo1)?></div>
                        <div class="stat-label">Durée</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre"><?=AlbumDAO::formater($albumNo1->date_sortie)?></div>
                        <div class="stat-label">Date sortie</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre"><?=AlbumDAO::formater($albumNo1->type)?></div>
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
                <span class="piste-numero"><?=MorceauDAO::formater($morceau->ordre)?></span>
                <div class="piste-pochette">
                    <img src="../images/<?=AlbumDAO::formater($albumNo1->id_image)?>.png" alt="Pochette">
                </div>
                <div class="piste-info">
                    <div class="piste-titre"><?=MorceauDAO::formater($morceau->titre)?></div>
                    <div class="piste-artiste"><?=MorceauDAO::formater($morceau->artiste)?></div>
                </div>
                <span class="piste-duree"><?=MorceauDAO::formater($morceau->duree)?></span>
                <div class="piste-actions">
                    <button class="bouton-piste favori" title="Favoris">❤️</button>
                    <button value="<?=MorceauDAO::formater($morceau->artiste)?> <?=MorceauDAO::formater($morceau->titre)?>" class="bouton-piste jouer" title="Jouer">▶️</button>
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
require_once "../footer.php";
?>