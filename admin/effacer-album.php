<?php
include_once "../modele/Album.php";
//print_r($_GET);
$id=filter_var($_GET['album'],Album::$filtres['id']);

include_once "../accesseur/AlbumDAO.php";
$album = AlbumDAO::detaillerAlbum($id);
//print_r($album);

?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Panneau d'administration de Contrat à tout</title>
	<link rel="stylesheet" type="text/css" href="formulaire.css">	
</head>
<body>
	<header>
		<h1>Panneau d'administration de Contrat-à-tout</h1>
		<nav></nav>
	</header>
	
	<section id="contenu">
		<header><h2>Voulez-vous vraiment effacer le contrat <?=AlbumDAO::formater($album->nom)?> ?</h2></header>
		
		<form action="index.php" method="post">
			
			<input type="hidden" name="album" value="<?=AlbumDAO::formater($album->id)?>"/>
			<input type="submit" name="action-effacer" value="Oui">
			<input type="submit" value="Non">
			
		</form>
	
	</section>
	
	<footer><span id="signature"></span></footer>
</body>
</html>