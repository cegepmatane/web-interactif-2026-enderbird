<?php
ini_set('upload_max_filesize', '100M');
ini_set('post_max_size', '110M');
ini_set('memory_limit', '128M');

print_r($_POST);
print_r($_FILES);

include_once "../accesseur/ImageDAO.php";
include_once "../accesseur/AlbumDAO.php";
include_once "../modele/Image.php";
include_once "../modele/Album.php";

try {
    // Si tout rempli
    $required = ['type','nom','date_sortie','artiste'];
    foreach ($required as $field) {
        // Supprimer l'image temporaire si formulaire incomplet
        if (empty(trim($_POST[$field] ?? ''))) {
            throw new Exception("Veuillez remplir le champ $field");
        }
    }

    // Temporaire
    $image = new Image(['id' => 0, 'nom_fichier' => 'temp']);
    $image = ImageDAO::ajouterImage($image);

    // Si image existe
    if (!isset($_FILES['id_image']) || $_FILES['id_image']['error'] !== UPLOAD_ERR_OK) {
        ImageDAO::effacerImage($image->id);
        throw new Exception("Aucun fichier image n'a été téléchargé ou erreur de téléchargement.");
    }

    // Vérifier extension et préparer nom de l'image
    $ext = strtolower(pathinfo($_FILES['id_image']['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['png','jpg','jpeg','gif'])) {
        ImageDAO::effacerImage($image->id);
        throw new Exception("Type de fichier non autorisé.");
    }

    // Uploadage et renommage de l'image
    $newFilename = $image->id . '.' . $ext;
    $destination = "../images/$newFilename";

    if (!move_uploaded_file($_FILES['id_image']['tmp_name'], $destination)) {
        ImageDAO::effacerImage($image->id); // Supprimer l'image temporaire si erreur
        throw new Exception("Erreur lors de l'upload de l'image.");
    }

    // Updatage
    $image->nom_fichier = $newFilename;
    ImageDAO::editerImage($image);

    // Bon image id
    $albumData = $_POST;
    $albumData['id_image'] = $image->id;
    $album = new Album($albumData);
    AlbumDAO::ajouterAlbum($album);

} catch (Exception $e) {
    // supprimer l'image en cas d'erreur inattendue
    if (isset($image->id)) ImageDAO::effacerImage($image->id);
    if (isset($destination) && file_exists($destination)) unlink($destination);

    die("Erreur : " . $e->getMessage());
}
?>
