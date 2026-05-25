<?php
  session_start(); // Pour avoir $_SESSION
  
  // On peut détruire la session que si le membre est connecté
  if (isset($_SESSION['id_utilisateur'])) {
    // On vide la variable session
    session_unset();
    // On détruit la session
    session_destroy();
  
    // On retourne à la page d'accueil
    header('Location: /membre/');
  } else {
    $_SESSION['erreur'] = "Vous n'est pas connecté !";
    header('Location: /membre/');
  }
  exit;
?>