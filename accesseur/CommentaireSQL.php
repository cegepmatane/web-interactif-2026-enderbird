<?php
interface CommentaireSQL
{
    public const SQL_LISTE_COMMENTAIRE = "
        SELECT 
            id, 
            id_album, 
            id_utilisateur, 
            message, 
            date 
        FROM commentaire
    ";

    public const SQL_LISTE_COMMENTAIRES_ALBUM = "
        SELECT
            id, 
            id_album, 
            id_utilisateur, 
            message, 
            date 
        FROM commentaire
        WHERE id_album = :id_album
        ORDER BY date DESC
    ";

    public const SQL_DETAIL_COMMENTAIRE = "
        SELECT 
            id, 
            id_album, 
            id_utilisateur, 
            message, 
            date 
        FROM commentaire
        WHERE id = :id
    ";

    public const SQL_AJOUTER_COMMENTAIRE = "INSERT INTO commentaire (id_album, id_utilisateur, message, date) VALUES (:id_album, :id_utilisateur, :message, NOW())";
}
?>






