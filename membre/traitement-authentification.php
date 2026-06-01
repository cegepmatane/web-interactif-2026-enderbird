<?php
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  session_start();
  require_once dirname(__DIR__, 1) . "/accesseur/UtilisateurDAO.php";
  
  if (isset($_POST['utilisateur-authentification'])) {
  
    // 1. Récupération + nettoyage
    $filtreUtilisateur = [
      'courriel' => FILTER_SANITIZE_EMAIL,
      'mot_de_passe' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ];
  
    $donnees = filter_input_array(INPUT_POST, $filtreUtilisateur);
  
    // 2. Validation champs vides
    if (empty($donnees['courriel']) || empty($donnees['mot_de_passe'])) {
      $_SESSION['erreur'] = "Champs requis";
      header('Location: /membre/');
      exit;
    }
  
    // 3. Validation courriel
    if (!filter_var($donnees['courriel'], FILTER_VALIDATE_EMAIL)) {
      $_SESSION['erreur'] = "Courriel invalide";
      header('Location: /membre/');
      exit;
    }
  
    // 4. Recherche utilisateur
    $utilisateur = UtilisateurDAO::trouverCourriel(
      new Utilisateur(['courriel' => $donnees['courriel']])
    );
  
    // 5. Vérification mot de passe

    $motdepasseOk = false;
    
    if ($utilisateur) {
      $hashInfo = password_get_info($utilisateur->mot_de_passe);

      if (!empty($hashInfo['algo'])) {
        // mot de passe hashé
        $motdepasseOk = password_verify($donnees['mot_de_passe'], $utilisateur->mot_de_passe);
      } else {
        // mot de passe en clair (DEV seulement)
        $motdepasseOk = ($donnees['mot_de_passe'] === $utilisateur->mot_de_passe);
      }
    }

    if ($utilisateur && $motdepasseOk) {
      $_SESSION['id_utilisateur'] = $utilisateur->id;
  
      header('Location: /membre/');
      exit;
  
    } else {
      $_SESSION['erreur'] = "Courriel ou mot de passe invalide";
      header('Location: /membre/');
      exit;
    }
  }
?>