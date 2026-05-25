<?php
session_start();
header('Content-Type: application/json');
require_once "accesseur/UtilisateurDAO.php";

$idUtilisateur = filter_input(INPUT_POST, 'id_utilisateur', FILTER_VALIDATE_INT);
$utilisateur = UtilisateurDAO::detaillerUtilisateur(new Utilisateur(['id' => $idUtilisateur]));

if ($utilisateur) {
    // Mettre à jour la session
    $_SESSION['id_utilisateur'] = $utilisateur->id;

    echo json_encode(['reussite' => true]);
    }
else
{
    echo json_encode([
        'reussite' => false,
        'message' => 'Utilisateur non trouvé'
    ]);
}
?>