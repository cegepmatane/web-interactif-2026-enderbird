<?php
interface VoteSQL
{
	public const SQL_LISTER_VOTES_ALBUM = "SELECT AVG(note) AS moyenne, COUNT(*) AS total_votes FROM vote WHERE id_album = :id_album";

    public const SQL_DETAILLER_VOTE = "SELECT id, id_album, id_utilisateur, note, date, AVG(note) AS moyenne, COUNT(*) AS total_votes FROM vote WHERE id = :id";
	
	public const SQL_AJOUTER_VOTE = "INSERT INTO vote (id_album, id_utilisateur, note, date) VALUES (:id_album, :id_utilisateur, :note, NOW())";
}
?>