<?php
interface UtilisateurSQL
{
    public const SQL_LISTE_UTILISATEUR = "SELECT * FROM utilistateur";
    public const SQL_DETAIL_UTILISATEUR = "SELECT * FROM utilistateur WHERE id = :id";
}
?>