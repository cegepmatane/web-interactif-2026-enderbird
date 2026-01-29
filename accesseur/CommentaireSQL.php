<?php
interface CommentaireSQL
{
    public const SQL_LISTE_COMMENTAIRE = "SELECT * FROM commentaire";
    public const SQL_DETAIL_COMMENTAIRE = "SELECT * FROM commentaire JOIN utilisateur ON commentaire.id_utilisateur = utilisateur.id WHERE id_utilisateur = :id";
    public const SQL_DETAIL_COMMENTAIRES = "SELECT * FROM commentaire JOIN album ON commentaire.id_album = album.id WHERE id_album = :id";
}
?>