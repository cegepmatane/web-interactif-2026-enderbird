<?php
	include_once "accesseur/ContratDAO.php";
	//print_r($contrats);
	include "action/gerer-contrat.php";
	$contrats = ContratDAO::listerContrats();
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Liste des contrats</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="contrats.css">	
	<style>
		*
		{
			font-family: "Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
		}
		a.action
		{
			background-color:white;
			border-radius:1em;
			padding:0.5em;
			text-decoration:none;
			color:#333333;
			font-weight:bold;
			font-family: "Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
		}
		#liste-contrats
		{
			margin-top:1em;
		}
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
	
		<div>
			<a href="ajouter-contrat.html" class="action">Ajouter un contrat</a>
		</div>

		<div id="liste-contrats">
				
		<?php
		foreach($contrats as $contrat)
		{
		?>
			<div class="contrat">			
				<h4><?=formater($contrat->titre)?></h4> 
				<a class="action" href="editer-contrat.php?contrat=<?=$contrat->id?>">&Eacute;diter</a> 
				<a class="action" href="effacer-contrat.php?contrat=<?=$contrat->id?>">Effacer</a></h4>
			</div>
		<?php
		}
		?>
				
		</div>
	
	
	</section>
	
	<footer><span id="signature"></span></footer>
</body>
</html>