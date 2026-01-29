<?php
	//print_r($_POST);
		
	$contrat = new Contrat($_POST);
	
	//include_once "../accesseur/ContratDAO.php";
	ContratDAO::editerContrat($contrat);
	