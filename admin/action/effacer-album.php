<?php
	include_once "../modele/Album.php";
	print_r($_POST);
	
	$id = filter_var($_POST['id'], Album::$filtres['id']);
	$id_image = filter_var($_POST['id_image'], Album::$filtres['id_image']);
	
	if ($_POST['action-effacer'] == "Oui") {
	    include_once "../accesseur/AlbumDAO.php";
	    include_once "../accesseur/ImageDAO.php";
	
	    $image = ImageDAO::detaillerImage($id_image);
	    $filePath = "../images/" . $image->nom_fichier;
	
	    AlbumDAO::effacerAlbum($id);
	    ImageDAO::effacerImage($id_image);
	
	    if (file_exists($filePath)) {
	        unlink($filePath);
	        echo "Image supprimée du serveur.";
	    } else {
	        echo "Fichier image non trouvé sur le serveur.";
	    }
	}
?>
