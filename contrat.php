<?php
//print_r($_GET);
$id = filter_var($_GET['contrat'],FILTER_VALIDATE_INT); 

include "accesseur/ContratDAO.php";
$contrat = ContratDAO::detaillerContrat($id);
//print_r($contrat);

?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Liste des contrats</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="contrats.css">	<style>
	</style>
</head>
<body>
	<div id="header">
		<h1><span>Contrat A Tout</span></h1>
		<nav>
			<div id="menu">
				<a class="lien-page" href="#">Accueil</a> |
				<a class="lien-page" href="#">Contrats</a> |
				<a class="lien-page" href="#">Contacts</a>
			</div>
		</nav>
	</div>
	
	<section id="contenu">
		<header><h2>Contrat <?=formater($contrat->titre)?></h2></header>
			
			<div id="contrat" style="background-color:white;padding:20px;">			
				<div class="contrat-client"><img src="illustration/profil-defaut.png"/></div>
				<p class="contrat-description"><?=formater($contrat->description)?></p>
				<span class="contrat-technologie"><?=formater($contrat->technologie)?></span>
				<!--span class="contrat-debut"><?=formater($contrat->debut)?></span-->
			</div>
				
	
	
	</section>
	
	<footer><span id="signature"></span></footer>
</body>
</html>