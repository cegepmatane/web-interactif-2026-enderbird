<?php
interface UtilisateurSQL
{
	public const SQL_LISTE_UTILISATEUR = "SELECT id, pseudo, email, mot_de_passe, fichier_image FROM utilisateur";
    public const SQL_DETAIL_UTILISATEUR = "SELECT id, pseudo, email, mot_de_passe, fichier_image FROM utilisateur WHERE id = :id";
}
?>