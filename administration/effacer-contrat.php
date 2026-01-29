<?php
include_once "../modele/Contrat.php";
//print_r($_GET);
$id=filter_var($_GET['contrat'],Contrat::$filtres['id']);

include_once "accesseur/ContratDAO.php";
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
		<header><h2>Voulez-vous vraiment effacer le contrat <?=formater($contrat->titre)?> ?</h2></header>
		
		<form action="contrats.php" method="post">
			
			<input type="hidden" name="contrat" value="<?=formater($contrat->id)?>"/>
			<input type="submit" name="action-effacer" value="Oui">
			<input type="submit" value="Non">
			
		</form>
	
	</section>
	
	<footer><span id="signature"></span></footer>
</body>
</html>