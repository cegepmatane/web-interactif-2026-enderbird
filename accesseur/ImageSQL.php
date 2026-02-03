<?php
interface ImageSQL
{
    public const SQL_DETAILLER_IMAGE = "SELECT * FROM image WHERE id = :id";
	/* Admin */
	public const SQL_AJOUTER_IMAGE = "INSERT into image (nom_fichier) VALUES (:nom_fichier)";
	public const SQL_EDITER_IMAGE = "UPDATE image SET nom_fichier = :nom_fichier WHERE id = :id";
	public const SQL_EFFACER_IMAGE = "DELETE FROM image WHERE id = :id";
}
?>