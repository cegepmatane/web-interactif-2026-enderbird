<?php
include_once "../modele/Album.php";
//print_r($_GET);
$id=filter_var($_GET['album'],Album::$filtres['id']);

include "../accesseur/AlbumDAO.php";
$album = AlbumDAO::detaillerAlbum($id);
include "../accesseur/ImageDAO.php";
$image = ImageDAO::detaillerImage($album->id_image);
?>
<!doctype html>
<html lang="fr">
<head>
	<title>Panneau d'administration d'album à tout</title>
	<link rel="stylesheet" type="text/css" href="css/formulaire.css">	

</head>
<body>
	<header>
		<h1>Panneau d'administration de album-à-tout</h1>
	</header>
	
	<section id="contenu">
		<header><h2>Éditer le album : <?=AlbumDAO::formater($album->nom)?></h2></header>
		
		<form action="index.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?=$album->id?>"/>
				
			<div class="champs">
				<label for="id_image">Image</label>
				<img src="../images/<?=$image->nom_fichier?>" alt="id_image">
				<input type="file" name="id_image" id="id_image" accept="image/*">
			</div>

			<div class="champs">
				<label for="type">Type</label>
				<input type="text" name="type" id="type" value="<?=AlbumDAO::formater($album->type)?>"/>			
			</div>

			<div class="champs">
				<label for="nom">Nom</label>
				<input type="text" name="nom" id="nom" value="<?=AlbumDAO::formater($album->nom)?>"/>			
			</div>

			<div class="champs">
				<label for="date_sortie">Date de sortie</label>
				<input type="date" name="date_sortie" id="date_sortie" value="<?=$album->date_sortie?>"/>
			</div>

			<div class="champs">
				<label for="artiste">Artiste</label>
				<input type="text" name="artiste" id="artiste" value="<?=AlbumDAO::formater($album->artiste)?>"/>			
			</div>
			
			<input type="submit" name="action-editer" value="Enregistrer">
		</form>
	
	</section>
	
	<footer><span id="signature"></span></footer>
</body>
</html>