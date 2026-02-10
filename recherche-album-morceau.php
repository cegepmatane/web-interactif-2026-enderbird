<?php
header('Content-Type: application/json');
include_once "accesseur/AlbumDAO.php";

try {
    $recherche = $_GET['recherche'] ?? '';

    // Valider si vraiment JSON
    echo json_encode(AlbumDAO::rechercherAlbumMorceau($recherche) ?: []);

} catch (PDOException $e) {
    echo json_encode([]); // Si erreurs 
}
?>