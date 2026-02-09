<?php
header('Content-Type: application/json');
include_once "accesseur/BaseDeDonnees.php";

try {
    $q = $_GET['q'] ?? '';

    $requeteRecherche = BaseDeDonnees::getConnexion()->prepare("
        (
            SELECT 
                nom, 
                artiste,
                id_image
            FROM album
            WHERE nom LIKE :q OR artiste LIKE :q
        )
        UNION
        (
            SELECT 
                morceau.titre AS nom,
                morceau.artiste AS artiste,
                album.id_image
            FROM morceau JOIN album ON morceau.id_album = album.id
            WHERE morceau.titre LIKE :q OR morceau.artiste LIKE :q
        )
        LIMIT 10
    ");
    $requeteRecherche->execute([':q' => "%$q%"]);
    $resultats = $requeteRecherche->fetchAll(PDO::FETCH_ASSOC);

    // Make sure we always return valid JSON
    echo json_encode($resultats ?: []);

} catch (PDOException $e) {
    echo json_encode([]); // fallback empty array if DB fails
}