<?php
  require_once dirname(__DIR__, 1) . "/header.php";
  
  if (
    !isset($_SESSION['inscription']['pseudo']) || 
    !isset($_SESSION['inscription']['courriel']) ||
    !isset($_SESSION['inscription']['role'])
    ){

    $_SESSION['erreur'] = "Vous devez compléter le formulaire!";

    header("Location: inscription-information.php");
    exit;
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  
    if(
      empty($_POST['mot_de_passe_1']) ||
      empty($_POST['mot_de_passe_2'])
    ){
      $_SESSION['erreur'] = "Veuillez remplir les deux mots de passe.";
  
    }elseif (strlen($_POST['mot_de_passe_1']) < 8){
      $_SESSION['erreur'] = "Le mot de passe doit contenir au moins 8 caractères.";
  
    }elseif ($_POST['mot_de_passe_1'] !== $_POST['mot_de_passe_2']){
      $_SESSION['erreur'] = "Les mots de passe ne correspondent pas.";
  
    }else{
      $_SESSION['inscription']['mot_de_passe'] = password_hash($_POST['mot_de_passe_1'], PASSWORD_BCRYPT);
  
      header('Location: traitement-inscription.php');
      exit;
    }
  }
?>
  <link rel="stylesheet" href="inscription.css">

  <title>Inscription - Partie 3/3</title>
  
  <h1 class="truc"><span>Inscription</span></h1>
  
  <main id="contenu-principal">
  
    <form method="POST">
    
      <?php if (! empty($_SESSION['erreur'])) {
        echo $_SESSION['erreur'];
        unset($_SESSION['erreur']);
      }?>

      <div>
        <label for="mot_de_passe_1">Mot de passe</label>
        <input id="mot_de_passe_1" type="password" name="mot_de_passe_1">
      </div>

      <div>
        <label for="mot_de_passe_2">Confirmer le mot de passe</label>
        <input id="mot_de_passe_2" type="password" name="mot_de_passe_2">
      </div>
    
      <div class="nav-steps">
        <a href="inscription-information.php">← Précédent</a>
        <button type="submit">Terminer</button>
      </div>
    </form>
  
  </main>

  <!-- Pied de page -->
  <?php include_once dirname(__DIR__, 1) . "/footer.php"; ?>