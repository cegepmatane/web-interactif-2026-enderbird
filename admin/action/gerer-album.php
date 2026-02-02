<?php

if(!empty($_POST['action-ajouter']))
{
	//echo "action-ajouter";
	include "action/ajouter-album.php";
}
if(!empty($_POST['action-editer']))
{
	//echo "action-editer";
	include "action/editer-album.php";	
}
if(!empty($_POST['action-effacer']))
{
	//echo "action-effacer";
	include "action/effacer-album.php";			
}

	

?>