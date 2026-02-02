<?php
	print_r($_POST);
	
	include_once "../modele/Album.php";
	$album = new Album($_POST);

	include_once "../accesseur/AlbumDAO.php";
	AlbumDAO::ajouterAlbum($album);
