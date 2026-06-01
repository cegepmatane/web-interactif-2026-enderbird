<?php
  require_once dirname(__DIR__, 1) . "/header.php";
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['pseudo']) && !empty($_POST['courriel']) && filter_var($_POST['courriel'], FILTER_VALIDATE_EMAIL)) {
      $_SESSION['inscription']['pseudo'] = $_POST['pseudo'];
      $_SESSION['inscription']['courriel'] = $_POST['courriel'];
  
      header('Location: inscription-information.php');
      exit;

    } if (!filter_var($_POST['courriel'], FILTER_VALIDATE_EMAIL)) {
      $_SESSION['erreur'] = "Courriel invalide";
    } else {
      $_SESSION['erreur'] = "Champ(s) manquant(s)";
    }
  }
?>
  <link rel="stylesheet" href="inscription.css">

  <title>Inscription - Partie 1/3</title>
  
  <h1 class="truc"><span>Inscription</span></h1>
  
  <main id="contenu-principal">
  
    <form method="POST">
    
      <?php if (! empty($_SESSION['erreur'])) {
        echo $_SESSION['erreur'];
        unset($_SESSION['erreur']);
      }?>
    
      <div>
        <label for="pseudo">Pseudo</label>
        <input id="pseudo" type="text" name="pseudo" value="<?= $_SESSION['inscription']['pseudo'] ?? '' ?>">
      </div>

      <div>
        <label for="courriel">Courriel</label>
        <input id="courriel" type="email" name="courriel" value="<?= $_SESSION['inscription']['courriel'] ?? '' ?>">
      </div>

      <div class="nav-steps">
        <a href="/membre/">← Précédent</a>
        <button type="submit">Suivant</button>
      </div>
    </form>
  
  </main>

  <!-- Pied de page -->
  <?php include_once dirname(__DIR__, 1) . "/footer.php"; ?>
