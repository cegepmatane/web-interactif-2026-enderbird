<?php
    header('Content-Type: application/json');

    include_once "accesseur/VoteDAO.php";

    try {
        $donnees = json_decode(file_get_contents('php://input'), true);

        $vote = new Vote([
            'id_album' => $donnees['id_album'] ?? null,
            'id_utilisateur' => $donnees['id_utilisateur'] ?? null,
            'note' => $donnees['note'] ?? null
        ]);

        $reussite = VoteDAO::ajouterVote($vote);

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