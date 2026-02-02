<?php
	//print_r($_POST);
		
	$contrat = new Album($_POST);
	
	//include_once "../accesseur/AlbumDAO.php";
	AlbumDAO::editerAlbum($album);
	