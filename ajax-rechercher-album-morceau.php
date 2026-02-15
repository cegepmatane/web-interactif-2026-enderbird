<?php
header('Content-Type: application/json');
require_once "accesseur/AlbumDAO.php";

try {
    $recherche = $_GET['recherche'] ?? '';

    // Valider si vraiment JSON
    echo json_encode(AlbumDAO::rechercherAlbumMorceau($recherche) ?: []);

} catch (PDOException $erreur) {
    echo json_encode([]); // Si erreurs 
}
?>