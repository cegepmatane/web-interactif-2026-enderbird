<?php
header('Content-Type: application/json');
require_once "accesseur/FavoriDAO.php";
require_once "accesseur/UtilisateurDAO.php";

try {
    $donnees = json_decode(file_get_contents('php://input'), true);
    $favori = new Favori([
        'id_morceau' => $donnees['id_morceau'],
        'id_utilisateur' => $donnees['id_utilisateur']
    ]);

    $utilisateur = UtilisateurDAO::detaillerUtilisateur(new Utilisateur(['id' => $favori->id_utilisateur]));
    $favoris = FavoriDAO::listerFavorisUtilisateur($utilisateur) ?? []; //Les favoris de l'utilisateur

    $albumDansFavori = false;
    foreach($favoris as $favoriTemp) {
        // Vérifier si déjà enregistré
        if ($favoriTemp->id_morceau == $favori->id_morceau) { 
            $albumDansFavori = true;
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