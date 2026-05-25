<?php
  // IMPORTANT - $utilisateur créé dans le header: 
  require_once dirname(__DIR__, 1) . "/header.php";
  /** @var Utilisateur|null $utilisateur */
?>

  <!-- #5 - Ajax -->
  <script src="/js/ajax-favori.js" defer></script>

  <main id="contenu-principal">

    <!-- ------------------------------------------------------------ -->
    <!-- --------------- FORMULAIRE AUTHENTIFICATION ---------------- -->
    <!-- ------------------------------------------------------------ -->

    <?php if (empty($_SESSION['id_utilisateur'])) {?>
      <title>SoundWave - Se connecter</title>

      <?php 
        $utilisateurPage = null;
        if (isset($_GET['id_utilisateur'])){
          $utilisateurPage = UtilisateurDAO::detaillerUtilisateur(new Utilisateur(['id' => $_GET['id_utilisateur']]));
        } 
      ?>

      <!-- formulaire de connexion membre -->
      <form action="traitement-authentification.php" method="post">
        <div id="erreur">
          <?php if (! empty($_SESSION['erreur'])) {
            echo $_SESSION['erreur'];
            unset($_SESSION['erreur']);
          }?>
        </div>

        <div>
          <label for="courriel">Courriel :</label>
          <input type="courriel" name="courriel" id="courriel" value="<?= $utilisateurPage?->courriel ?>">
        </div>

        <div>
          <label for="mot_de_passe">Mot de passe :</label>
          <input type="password" name="mot_de_passe" id="mot_de_passe">
        </div>

        <div>
          <input type="submit" name="utilisateur-authentification" value="Se connecter">
          <a href="inscription-identification.php" class="bouton">Créer un compte</a>
        </div>
      </form>

    <!-- ------------------------------------------------------------ -->
    <!-- --------------- FORMULAIRE AUTHENTIFICATION ---------------- -->
    <!-- ------------------------------------------------------------ -->
     
    <?php } else {?>
      <title>SoundWave - Espace Membre</title>

      <?php
        require_once dirname(__DIR__, 1) . "/accesseur/AlbumDAO.php";
        require_once dirname(__DIR__, 1) . "/accesseur/MorceauDAO.php";
        $morceauxFavoris = MorceauDAO::detaillerMorceauxFavoris($utilisateur);
        require_once dirname(__DIR__, 1) . "/accesseur/FavoriDAO.php";
        $favoris = FavoriDAO::listerFavorisUtilisateur($utilisateur) ?? [];
      ?>

      <div class="membre">
        <div class="image">
          <img src="/images/utilisateurs/<?= $utilisateur->fichier_image ?>" alt="avatar">
        </div>

        <h3>Pseudo : </h3>
        <p><?= $utilisateur->pseudo ?></p>

        <h3>Courriel :</h3>
        <p><?= $utilisateur->courriel ?></p>
      </div>

    <a href="deconnexion.php" class="bouton-deconnexion">Se déconnecter</a>

    <!-- Liste des pistes -->
    <section id="liste-pistes">
      <h2 class="titre-section">🎵 Morceaux favoris</h2>

      <?php if (!$morceauxFavoris){
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
          $album = AlbumDAO::detaillerAlbum(new Album(['id' => $morceau->id_album])); ?>

          <article class="piste">
            <span class="piste-numero"><?=$noMorceau?></span>
            <div class="piste-pochette">
              <img src="../images/albums/<?=$album->fichier_image?>" alt="Pochette">
            </div>
            <div class="piste-info">
              <div class="piste-titre"><?=$morceau->titre?></div>
              <div class="piste-artiste"><?=$morceau->artiste?></div>
            </div>
            <span class="piste-duree"><?=$morceau->duree?></span>
            <div class="piste-actions">
              <button class="bouton-piste favori <?php echo $morceauDansFavori ? 'actif' : ''; ?>" title="Favoris" data-item-id="<?= $morceau->id ?>" data-user-id="<?= $utilisateur?->id ?>">❤️</button>
              <button value="<?=$morceau->artiste?> <?=$morceau->titre?>" class="bouton-piste jouer" title="Jouer">▶️</button>
            </div>
        </article>
        <?php } 
      }?>
    </section>

    <?php }?>
    
  </main>

  <!-- Pied de page -->
  <?php include_once dirname(__DIR__, 1) . "/footer.php"; ?>