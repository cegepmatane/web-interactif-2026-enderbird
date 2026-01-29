<?php
interface ContratSQL
{
	
		public const SQL_LISTE_CONTRATS = "SELECT * FROM contrat";
		public const SQL_DETAIL_CONTRAT = "SELECT * FROM contrat WHERE id = :id"; 
		public const SQL_AJOUTER_CONTRAT = "INSERT into contrat(titre, client, description, technologie, debut) VALUES(:titre, :client, :description, :technologie, :debut)";
		public const SQL_EDITER_CONTRAT = "UPDATE contrat SET titre = :titre, client = :client, client=:description, technologie=:technologie, debut=:debut WHERE id = :id";
		public const SQL_EFFACER_CONTRAT = "DELETE FROM contrat WHERE id = :id";

}
?>