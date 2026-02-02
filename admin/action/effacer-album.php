<?php
	include_once "../modele/Album.php";
	//print_r($_POST);

	$id=filter_var($_POST['contrat'],Album::$filtres['id']);
	//print_r($album);

	if($_POST['action-effacer'] == "Oui")
	{
		//include_once "../accesseur/AlbumDAO.php";
		AlbumDAO::effacerAlbum($id);
	}
