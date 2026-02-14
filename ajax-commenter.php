<?php
header('Content-Type: application/json');
require_once "accesseur/CommentaireDAO.php";

try {
    require_once "accesseur/UtilisateurDAO.php";
    require_once "modele/Album.php";

    // =========================
    // GET → LIST COMMENTS
    // =========================
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $idAlbum = filter_input(INPUT_GET, 'id_album', FILTER_VALIDATE_INT);
        if (!$idAlbum) {
            http_response_code(400);
            echo json_encode([
                'reussite' => false,
                'message' => 'ID album invalide'
            ]);
            exit;
        }

        $commentaires = CommentaireDAO::listerCommentairesAlbum(
            new Album(['id' => $idAlbum])
        );

        $resultat = [];

        foreach ($commentaires as $commentaire) {
            $utilisateur = UtilisateurDAO::detaillerUtilisateur(
                new Utilisateur(['id' => $commentaire->id_utilisateur])
            );

            $resultat[] = [
                'id' => $commentaire->id,
                'id_album' => $commentaire->id_album,
                'message' => $commentaire->message ?? 'Message supprimé ou vide',
                'date' => $commentaire->date,
                'pseudo' => $utilisateur->pseudo ?? 'Utilisateur anonyme',
                'fichier_image' => $utilisateur->fichier_image
            ];
        }
        echo json_encode([
            'reussite' => true,
            'commentaires' => $resultat
        ]);

        exit;
    }

    // =========================
    // POST → ADD COMMENT
    // =========================
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $donnees = json_decode(file_get_contents('php://input'), true);
        if (!$donnees) {
            http_response_code(400);
            echo json_encode([
                'reussite' => false,
                'message' => 'JSON invalide'
            ]);
            exit;
        }

        $idAlbum = $donnees['id_album'] ?? null;
        $idUtilisateur = $donnees['id_utilisateur'] ?? null;
        $message = $donnees['message'] ?? '';

        if (!$idAlbum || !$idUtilisateur || empty($message)) {
            http_response_code(400);
            echo json_encode([
                'reussite' => false,
                'message' => 'Données invalides'
            ]);
            exit;
        }

        $commentaire = new Commentaire([
            'id_album' => $idAlbum,
            'id_utilisateur' => $idUtilisateur,
            'message' => $message
        ]);

        $reussite = CommentaireDAO::ajouterCommentaire($commentaire);

        echo json_encode([
            'reussite' => (bool)$reussite
        ]);

        exit;
    }

    // =========================
    // INVALID METHOD
    // =========================
    http_response_code(405);
    echo json_encode([
        'reussite' => false,
        'message' => 'Méthode non autorisée'
    ]);

} catch (PDOException $erreur) {
    http_response_code(500);

    echo json_encode([
        'reussite' => false,
        'message' => 'Erreur serveur'
        // Never expose $erreur->getMessage() in production
    ]);
}