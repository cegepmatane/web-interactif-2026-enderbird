<?php
  require_once dirname(__DIR__, 1) . "/header.php";
  
  if (
    !isset($_SESSION['inscription']['pseudo']) || 
    !isset($_SESSION['inscription']['courriel'])
    ){

    $_SESSION['erreur'] = "Vous devez compléter le formulaire!";

    header("Location: inscription-identification.php");
    exit;
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['role'])){
      $_SESSION['inscription']['role'] = $_POST['role'];

      header("Location: inscription-mot-de-passe.php");
      exit;
    } else {
      $_SESSION['erreur'] = "Champ(s) manquant(s)";
    }
  }
?>
  <link rel="stylesheet" href="inscription.css">

  <title>Inscription - Partie 2/3</title>
  
  <h1 class="truc"><span>Inscription</span></h1>
  
  <main id="contenu-principal">
  
    <form method="POST">
    
      <?php if (! empty($_SESSION['erreur'])) {
        echo $_SESSION['erreur'];
        unset($_SESSION['erreur']);
      }?>
    
      <?php
        $roles = [
          'auditeur' => 'Auditeur',
          'artiste' => 'Artiste',
          'createur' => 'Créateur'
        ];
        
        foreach ($roles as $value => $label) { ?>
          <input
            type="radio"
            id="<?= $value ?>"
            name="role"
            value="<?= $value ?>"
            class="radio-hidden"
            <?= (($_SESSION['inscription']['role'] ?? '') === $value) ? 'checked' : '' ?>
          >
        
          <label for="<?= $value ?>" class="radio-style"><?= $label ?></label>
        <?php }
      ?>
    
      <div class="nav-steps">
        <a href="inscription-identification.php">← Précédent</a>
        <button type="submit">Suivant</button>
      </div>
    </form>
  
  </main>

  <!-- Pied de page -->
  <?php include_once dirname(__DIR__, 1) . "/footer.php"; ?>