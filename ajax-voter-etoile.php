<?php
header('Content-Type: application/json');
require_once "accesseur/VoteDAO.php";
require_once "accesseur/UtilisateurDAO.php";
require_once "modele/Album.php";

try {
    $donnees = json_decode(file_get_contents('php://input'), true);
    $vote = new Vote([
        'id_album' => $donnees['id_album'],
        'id_utilisateur' => $donnees['id_utilisateur'],
        'note' => $donnees['note'] ?? null
    ]);

    $utilisateur = UtilisateurDAO::detaillerUtilisateur(new Utilisateur(['id' => $vote->id_utilisateur]));
    $votes = VoteDAO::listerVotesUtilisateur($utilisateur) ?? []; //Les votes de l'utilisateur

    $albumDansVote = false;
    $ancienVote = new Vote(['note' => null]);
    foreach($votes as $voteTemp) {
        // Vérifier si déjà enregistré
        if ($voteTemp->id_album == $vote->id_album) {
            $ancienVote->note = $voteTemp->note;
            $albumDansVote = true;
            break;
        }
    }

    if(!$albumDansVote){
        $reussite = VoteDAO::ajouterVote($vote);

        echo json_encode([
            'reussite' => (bool)$reussite,
            'type' => "Ajouter",
            'moyenne' => VoteDAO::listerVotesAlbum(new Album(['id' => $vote->id_album]))[0]->moyenne ?? 0
        ]);
    } else if($ancienVote->note && $ancienVote->note != $vote->note) {
        $reussite = VoteDAO::editerVote($vote);

        echo json_encode([
            'reussite' => (bool)$reussite,
            'type' => "Editer",
            'moyenne' => VoteDAO::listerVotesAlbum(new Album(['id' => $vote->id_album]))[0]->moyenne ?? 0,
            'ancienneNote' => $ancienVote->note
        ]);
    } else{
        $reussite = VoteDAO::effacerVote($vote);

        echo json_encode([
            'reussite' => (bool)$reussite,
            'type' => "Effacer",
            'moyenne' => VoteDAO::listerVotesAlbum(new Album(['id' => $vote->id_album]))[0]->moyenne ?? 0
        ]);
    }

} catch (PDOException $erreur) {
    echo json_encode([
        'reussite' => false,
        'message' => $erreur->getMessage()
    ]);
}
?>