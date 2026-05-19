<?php
header('Content-Type: application/json');
require_once "accesseur/CollectionDAO.php";
require_once "accesseur/UtilisateurDAO.php";

try {
    $donnees = json_decode(file_get_contents('php://input'), true);
    $collection = new Collection([
        'id_album' => $donnees['id_album'],
        'id_utilisateur' => $donnees['id_utilisateur']
    ]);

    $utilisateur = UtilisateurDAO::detaillerUtilisateur(new Utilisateur(['id' => $collection->id_utilisateur]));
    $collections = CollectionDAO::listerCollectionsUtilisateur($utilisateur) ?? []; //Les collections de l'utilisateur

    $albumDansCollection = false;
    foreach($collections as $collectionTemp) {
        // Vérifier si déjà enregistré
        if ($collectionTemp->id_album == $collection->id_album) { 
            $albumDansCollection = true;
            break;
        }
    }

    if($albumDansCollection) {
        $reussite = CollectionDAO::effacerCollection($collection);

        echo json_encode([
            'reussite' => (bool)$reussite,
            'type' => "Effacer"
        ]);
    } else {
        $reussite = CollectionDAO::ajouterCollection($collection);

        echo json_encode([
            'reussite' => (bool)$reussite,
            'type' => "Ajouter"
        ]);
    }

} catch (PDOException $erreur) {
    echo json_encode([
        'reussite' => false,
        'message' => 'Erreur serveur'
    ]);
}
?>