<?php
interface UtilisateurSQL
{
	public const SQL_LISTE_UTILISATEUR  = "SELECT id, pseudo, courriel, mot_de_passe, fichier_image FROM utilisateur";
    public const SQL_DETAIL_UTILISATEUR = "SELECT id, pseudo, courriel, mot_de_passe, fichier_image FROM utilisateur WHERE id = :id";
    public const SQL_TROUVER_COURRIEL   = "SELECT id, pseudo, courriel, mot_de_passe, fichier_image FROM utilisateur WHERE courriel = :courriel";
}
?>