<?php
interface ImageSQL
{
    public const SQL_IMAGE_ALBUM = "SELECT id FROM image JOIN album ON image.id = album.id_image WHERE album.id = :id";
    public const SQL_IMAGE_UTILISATEUR = "SELECT id FROM image JOIN utilisateur ON image.id = utilisateur.id_image WHERE utilisateur.id = :id";
	/* Admin */
	public const SQL_AJOUTER_IMAGE = "INSERT into image(nom_fichier) VALUES(:nom_fichier)";
	public const SQL_EDITER_IMAGE = "UPDATE image SET nom_fichier = :nom_fichier WHERE id = :id";
	public const SQL_EFFACER_IMAGE = "DELETE FROM image WHERE id = :id";
}
?>