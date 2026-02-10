<?php
interface FavoriSQL
{
	public const SQL_LISTE_FAVORI = "
		SELECT
    		id,
    		id_album,
    		id_utilisateur,
    		date
		FROM favori
		ORDER BY id_album, date DESC
	";
	
	public const SQL_LISTE_FAVORIS_ALBUM = "
		SELECT
    		id,
    		id_album,
    		id_utilisateur,
    		date
		FROM favori
		WHERE id_album = :id_album;
	";

    public const SQL_DETAIL_FAVORI = "
		SELECT
    		id,
    		id_album,
    		id_utilisateur,
    		date
		FROM favori
		WHERE id = :id;
	";
	
	public const SQL_AJOUTER_FAVORI = "INSERT INTO favori (id_album, id_utilisateur, date) VALUES (:id_album, :id_utilisateur, NOW())";
}
?>