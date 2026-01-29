<?php
interface MorceauSQL
{
	
	public const SQL_LISTE_CONTRATS = "SELECT * FROM morceau";
	public const SQL_DETAIL_CONTRAT = "SELECT * FROM morceau WHERE id = :id"; 

}
?>