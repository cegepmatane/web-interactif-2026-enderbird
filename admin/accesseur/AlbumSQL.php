<?php
interface AlbumSQL
{
	public const SQL_LISTE_ALBUM = "SELECT * FROM album";
	public const SQL_DETAIL_ALBUM = "SELECT * FROM album WHERE id = :id";
	public const SQL_DUREE_ALBUM = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(morceau.duree))) as duree FROM album JOIN morceau ON album.id = morceau.id_album WHERE album.id = :id";
	/* Admin */
	public const SQL_AJOUTER_ALBUM = "INSERT into album (id_image, type, nom, date_sortie, artiste) VALUES (:id_image, :type, :nom, :date_sortie, :artiste)";
	public const SQL_EDITER_ALBUM = "UPDATE album SET id_image = :id_image, nom = :nom, date_sortie=:date_sortie, artiste=:artiste WHERE id = :id";
	public const SQL_EFFACER_ALBUM = "DELETE FROM album WHERE id = :id";
}
?>