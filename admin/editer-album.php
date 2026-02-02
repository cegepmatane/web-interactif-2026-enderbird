<?php
include_once "../modele/Album.php";
//print_r($_GET);
$id=filter_var($_GET['album'],Album::$filtres['id']);

include "../accesseur/AlbumDAO.php";
$album = AlbumDAO::detaillerAlbum($id);
$albumView = [
    'id' => (int) $album->id,
    'id_image' => htmlspecialchars($album->id_image, ENT_QUOTES, 'UTF-8'),
    'type' => htmlspecialchars($album->type, ENT_QUOTES, 'UTF-8'),
    'nom' => htmlspecialchars($album->nom, ENT_NOQUOTES, 'UTF-8'),
    'date_sortie' => htmlspecialchars($album->date_sortie, ENT_NOQUOTES, 'UTF-8'),
    'artiste' => htmlspecialchars($album->artiste, ENT_QUOTES, 'UTF-8'),
];
//print_r($album);
?>
<!doctype html>
<html lang="fr">
<head>
	<title>Panneau d'administration d'album à tout</title>
	<link rel="stylesheet" type="text/css" href="formulaire.css">	

</head>
<body>
	<header>
		<h1>Panneau d'administration de album-à-tout</h1>
	</header>
	
	<section id="contenu">
		<header><h2>Éditer le album : <?=formater($album->nom)?></h2></header>
		
		<form action="contrats.php" method="post">
			<input type="hidden" name="id" value="<?=formater($album->id)?>"/>
				
			<div class="champs">
				<label for="id_image">Image</label>
				<img src="../images/albums/<?=formater($album->id_image)?>.png" alt="id_image">
				<input type="file" name="id_image" id="id_image">
			</div>

			<div class="champs">
				<label for="type">Type</label>
				<input type="text" name="type" id="type" value="<?=formater($album->type)?>"/>			
			</div>

			<div class="champs">
				<label for="nom">Nom</label>
				<input type="text" name="nom" id="nom" value="<?=formater($album->nom)?>"/>			
			</div>

			<div class="champs">
				<label for="date_sortie">Date de sortie</label>
				<input type="date" name="date_sortie" id="date_sortie" value="<?=formater($album->date_sortie)?>"/>
			</div>

			<div class="champs">
				<label for="artiste">Artiste</label>
				<input type="text" name="artiste" id="artiste" value="<?=formater($album->artiste)?>"/>			
			</div>
			
			<input type="submit" name="action-editer" value="Enregistrer">
		</form>
	
	</section>
	
	<footer><span id="signature"></span></footer>
</body>
</html>