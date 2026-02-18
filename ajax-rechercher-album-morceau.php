<?php
header('Content-Type: application/json');
require_once "accesseur/AlbumDAO.php";

try {
    $recherche = filter_input(INPUT_GET, 'recherche', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';

    // Valider si vraiment JSON
    echo json_encode(AlbumDAO::rechercherAlbumMorceau($recherche) ?: []);

} catch (PDOException $erreur) {
    echo json_encode([]); // Si erreurs 
}
?>