<?php
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
  
  session_start();
  require_once dirname(__DIR__, 1) . "/accesseur/UtilisateurDAO.php";
  
  if (empty($_SESSION['inscription'])) {
    $_SESSION['erreur'] = "Inscription invalide";
    header("Location: inscription-identification.php");
    exit;
  }
  
  $inscription = $_SESSION['inscription'];
  
  // =========================
  // Validation finale
  // =========================
  if (
    empty($inscription['pseudo']) ||
    empty($inscription['courriel']) ||
    empty($inscription['role']) ||
    empty($inscription['mot_de_passe'])
  ) {
  
    $_SESSION['erreur'] = "Informations manquantes";
    header("Location: inscription-identification.php");
    exit;
  }
  
  // =========================
  // Validation courriel
  // =========================
  if (!filter_var($inscription['courriel'], FILTER_VALIDATE_EMAIL)) {
  
    $_SESSION['erreur'] = "Courriel invalide";
    header("Location: inscription-identification.php");
    exit;
  }
  
  // =========================
  // Vérification doublons
  // =========================
  $utilisateurCourriel = UtilisateurDAO::trouverCourriel(
    new Utilisateur([
      'courriel' => $inscription['courriel']
    ])
  );
  
  if ($utilisateurCourriel) {
  
    $_SESSION['erreur'] = "Ce courriel est déjà utilisé";
    header("Location: inscription-identification.php");
    exit;
  }
  
  // =========================
  // Création utilisateur
  // =========================
  
  $nouvelUtilisateur = new Utilisateur([
    'pseudo' => $inscription['pseudo'],
    'courriel' => $inscription['courriel'],
    'mot_de_passe' => $inscription['mot_de_passe'],
    'role' => $inscription['role']
  ]);
  
  $reussiteUtilisateur = UtilisateurDAO::ajouterUtilisateur($nouvelUtilisateur);
  
  // =========================
  // Succès
  // =========================
  
  if ($reussiteUtilisateur) {
    // connexion auto après inscription
    $_SESSION['id_utilisateur'] = $reussiteUtilisateur->id;
    unset($_SESSION['inscription']);
  
    header("Location: /membre/");
    exit;
  }
  
  
  // =========================
  // Erreur SQL
  // =========================
  
  $_SESSION['erreur'] = "Erreur lors de l'inscription";
  header("Location: inscription-identification.php");
exit;