<?php
interface FavoriSQL
{
	public const SQL_LISTE_FAVORI = "
		SELECT
    		id_morceau,
    		id_utilisateur,
    		date
		FROM favori
	";
	
	public const SQL_LISTE_FAVORIS_UTILISATEUR = "
		SELECT
    		id_morceau,
    		id_utilisateur,
    		date
		FROM favori
		WHERE id_utilisateur = :id_utilisateur;
	";
	
	public const SQL_AJOUTER_FAVORI = "INSERT INTO favori (id_morceau, id_utilisateur, date) VALUES (:id_morceau, :id_utilisateur, NOW())";

	public const SQL_EFFACER_FAVORI = "DELETE FROM favori WHERE id_morceau = :id_morceau AND id_utilisateur = :id_utilisateur";
}
?>