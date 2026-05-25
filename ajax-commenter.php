<?php
header('Content-Type: application/json');
require_once "accesseur/CommentaireDAO.php";

try {
    require_once "accesseur/UtilisateurDAO.php";
    require_once "modele/Album.php";

    // GET → LISTE COMMENTAIRES
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $idAlbum = $_GET['id_album'];

        if ($idAlbum) {
            $commentaires = CommentaireDAO::listerCommentairesAlbum(new Album(['id' => $idAlbum]));

            $resultat = [];
            foreach ($commentaires as $commentaire) {
                $utilisateur = UtilisateurDAO::detaillerUtilisateur(new Utilisateur(['id' => $commentaire->id_utilisateur]));

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
        }
    } // POST → AJOUTER COMMENTAIRE
    else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();

        if (empty($_SESSION['id_utilisateur'])) {
          echo json_encode([
            'reussite' => false,
            'code' => 'NOT_AUTHENTICATED',
            'message' => 'Utilisateur non connecté'
          ]);
          exit;
        }

        $donnees = json_decode(file_get_contents('php://input'), true);

        if ($donnees) {
            $idAlbum = $donnees['id_album'] ?? null;
            $idUtilisateur = $_SESSION['id_utilisateur'];
            $message = $donnees['message'] ?? '';

            $commentaire = new Commentaire([
                'id_album' => $idAlbum,
                'id_utilisateur' => $idUtilisateur,
                'message' => $message
            ]);

            $reussite = CommentaireDAO::ajouterCommentaire($commentaire);

            echo json_encode([
                'reussite' => (bool)$reussite
            ]);
        }
    }
} catch (PDOException $erreur) {
    echo json_encode([
        'reussite' => false,
        'message' => 'Erreur'
    ]);
}