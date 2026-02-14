<?php
session_start();
header('Content-Type: application/json');

require_once "accesseur/UtilisateurDAO.php";

$idUtilisateur = filter_input(INPUT_POST, 'id_utilisateur', FILTER_VALIDATE_INT);

if (!$idUtilisateur) {
    echo json_encode([
        'reussite' => false
    ]);
    exit;
}

$utilisateur = UtilisateurDAO::detaillerUtilisateur(
    new Utilisateur([
        'id' => $idUtilisateur
    ])
);

if (!$utilisateur) {
    echo json_encode([
        'reussite' => false, 
        'message' => 'Utilisateur non trouvé'
    ]);
    exit;
}

// Mettre à jour la session
$_SESSION['id_utilisateur'] = $utilisateur->id;
$_SESSION['pseudo'] = $utilisateur->pseudo;
$_SESSION['email'] = $utilisateur->email;
$_SESSION['fichier_image'] = $utilisateur->fichier_image;

echo json_encode(['reussite' => true]);
exit;
