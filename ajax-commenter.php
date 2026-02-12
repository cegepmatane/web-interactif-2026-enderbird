<?php
header('Content-Type: application/json');
require_once "accesseur/CommentaireDAO.php";

try {
    $donnees = json_decode(file_get_contents('php://input'), true);
    $commentaire = new Commentaire([
        'id_album' => $donnees['id_album'] ?? null,
        'id_utilisateur' => $donnees['id_utilisateur'] ?? null,
        'message' => $donnees['message'] ?? ''
    ]);

    $reussite = CommentaireDAO::ajouterCommentaire($commentaire);
    echo json_encode([
        'reussite' => (bool)$reussite
    ]);

} catch (PDOException $erreur) {
    echo json_encode([
        'reussite' => false,
        'message' => $erreur->getMessage()
    ]);
}
?>