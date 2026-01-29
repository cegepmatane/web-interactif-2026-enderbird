<?php
	include "accesseur/ContratDAO.php";
	$contrats = ContratDAO::listerContrats();
	//print_r($contrats);

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
		<header><h2>Contrats offerts</h2></header>
	
		<div id="liste-contrats">
		
		<?php
		foreach($contrats as $contrat)
		{
		?>
			<div class="contrat">			
				<h4><a href="contrat.php?contrat=<?=$contrat->id?>"><?=formater($contrat->titre)?></a></h4>
				<div class="contrat-client"><img src="illustration/profil-defaut.png"/></div>
				<p class="contrat-description"><?=formater($contrat->description)?></p>
				<span class="contrat-technologie"><?=formater($contrat->technologie)?></span>
				<!--span class="contrat-debut"><?=formater($contrat->debut)?></span-->
			</div>
		<?php
		}
		?>
				
		</div>
	
	
	</section>
	
	<footer><span id="signature"></span></footer>
</body>
</html>