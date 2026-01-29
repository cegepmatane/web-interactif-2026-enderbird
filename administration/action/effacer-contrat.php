<?php
	include_once "../modele/Contrat.php";
	//print_r($_POST);

	$id=filter_var($_POST['contrat'],Contrat::$filtres['id']);
	//print_r($contrat);

	if($_POST['action-effacer'] == "Oui")
	{
		//include_once "../accesseur/ContratDAO.php";
		ContratDAO::effacerContrat($id);
	}
