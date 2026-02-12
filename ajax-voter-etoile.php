<?php
header('Content-Type: application/json');
require_once "accesseur/VoteDAO.php";
require_once "accesseur/UtilisateurDAO.php";

try {
    $donnees = json_decode(file_get_contents('php://input'), true);
    $vote = new Vote([
        'id_album' => $donnees['id_album'],
        'id_utilisateur' => $donnees['id_utilisateur'],
        'note' => $donnees['note'] ?? null
    ]);

    $utilisateur = UtilisateurDAO::detaillerUtilisateur(new Utilisateur(['id' => $favori->id_utilisateur]));
    $votes = VoteDAO::listerVotesUtilisateur($utilisateur) ?? []; //Les votes de l'utilisateur

    $albumDansVote = false;
    foreach($votes as $voteTemp) {
        // Vérifier si déjà enregistré
        if ($voteTemp->id_album == $vote->id_album) { 
            $albumDansVote = true;
            break;
        }
    }

    if($albumDansFavori) {
        $reussite = FavoriDAO::effacerFavori($favori);

        echo json_encode([
            'reussite' => (bool)$reussite,
            'type' => "Effacer"
        ]);
    } else {
        $reussite = FavoriDAO::ajouterFavori($favori);

        echo json_encode([
            'reussite' => (bool)$reussite,
            'type' => "Ajouter"
        ]);
    }

} catch (PDOException $erreur) {
    echo json_encode([
        'reussite' => false,
        'message' => $erreur->getMessage()
    ]);
}
?>