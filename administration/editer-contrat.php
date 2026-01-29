<?php
include_once "../modele/Contrat.php";
//print_r($_GET);
$id=filter_var($_GET['contrat'],Contrat::$filtres['id']);

include "accesseur/ContratDAO.php";
$contrat = ContratDAO::detaillerContrat($id);
//print_r($contrat);
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
		<header><h2>&Eacute;diter le contrat <?=formater($contrat->titre)?></h2></header>
		
		<form action="contrats.php" method="post">
			<input type="hidden" name="id" value="<?=formater($contrat->id)?>"/>
				
			<div class="champs">
				<label for="titre">Titre</label>
				<input type="text" name="titre" id="titre" value="<?=formater($contrat->titre)?>"/>			
			</div>
		
			<div class="champs">
				<label for="client">Client</label>
				<input type="text" name="client" id="client" value="<?=formater($contrat->client)?>"/>			
			</div>
		
			<div class="champs">
				<label for="titre">Description</label>
				<textarea name="description" id="description"><?=formater($contrat->description)?></textarea>
			</div>
		
			<div class="champs">
				<label for="technologie">Technologie</label>
				<textarea name="technologie" id="technologie"><?=formater($contrat->technologie)?></textarea>
			</div>
			
			<div class="champs">
				<label for="debut">D&eacute;but</label>
				<input type="text" name="debut" id="debut" value="<?=formater($contrat->debut)?>"/>			
			</div>
			
			<input type="submit" name="action-editer" value="Enregistrer">
		</form>
	
	</section>
	
	<footer><span id="signature"></span></footer>
</body>
</html>