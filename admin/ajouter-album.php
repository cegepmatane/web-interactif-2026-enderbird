<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Panneau d'administration de Contrat à tout</title>
	<link rel="stylesheet" type="text/css" href="css/formulaire.css">	
</head>
<body>
	<header>
		<h1>Panneau d'administration de Contrat-à-tout</h1>
		<nav></nav>
	</header>
	
	<section id="contenu">
		<header><h2>Ajouter un album</h2></header>

		<form action="index.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" id="id" value="0">

			<div class="champs">
				<label for="id_image">Image</label>
				<input type="file" name="id_image" id="id_image" accept="image/*">
			</div>

			<div class="champs">
				<label for="type">Type</label>
				<input type="text" name="type" id="type"/>			
			</div>

			<div class="champs">
				<label for="nom">Nom</label>
				<input type="text" name="nom" id="nom"/>			
			</div>

			<div class="champs">
				<label for="date_sortie">Date de sortie</label>
				<input type="date" name="date_sortie" id="date_sortie"/>
			</div>

			<div class="champs">
				<label for="artiste">Artiste</label>
				<input type="text" name="artiste" id="artiste"/>			
			</div>
			
			<input type="submit" name="action-ajouter" value="Enregistrer">
		</form>
	</section>
	
	<footer><span id="signature"></span></footer>
</body>
</html>