<?php
interface CollectionSQL
{
	public const SQL_LISTE_COLLECTION = "
		SELECT
    		id_album,
    		id_utilisateur,
    		date
		FROM collection
	";
	
	public const SQL_LISTE_COLLECTIONS_UTILISATEUR = "
		SELECT
    		id_album,
    		id_utilisateur,
    		date
		FROM collection
		WHERE id_utilisateur = :id_utilisateur;
	";
	
	public const SQL_AJOUTER_COLLECTION = "INSERT INTO collection (id_album, id_utilisateur, date) VALUES (:id_album, :id_utilisateur, NOW())";

	public const SQL_EFFACER_COLLECTION = "DELETE FROM collection WHERE id_album = :id_album AND id_utilisateur = :id_utilisateur";
}
?>