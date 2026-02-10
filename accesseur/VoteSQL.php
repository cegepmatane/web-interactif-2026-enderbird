<?php
interface VoteSQL
{
	public const SQL_LISTE_VOTE = "
		SELECT
    		id,
    		id_album,
    		id_utilisateur,
    		note,
    		date,
    		AVG(note) OVER (PARTITION BY id_album) AS moyenne,
    		COUNT(*) OVER (PARTITION BY id_album) AS total_votes
		FROM vote
		ORDER BY id_album, date DESC
	";
	
	public const SQL_LISTE_VOTES_ALBUM = "
		SELECT
    		id,
    		id_album,
    		id_utilisateur,
    		note,
    		date,
    		AVG(note) OVER (PARTITION BY id_album) AS moyenne,
    		COUNT(*) OVER (PARTITION BY id_album) AS total_votes
		FROM vote
		WHERE id_album = :id_album;
	";

    public const SQL_DETAIL_VOTE = "
		SELECT
    		id,
    		id_album,
    		id_utilisateur,
    		note,
    		date,
    		AVG(note) OVER (PARTITION BY id_album) AS moyenne,
    		COUNT(*) OVER (PARTITION BY id_album) AS total_votes
		FROM vote
		WHERE id = :id;
	";
	
	public const SQL_AJOUTER_VOTE = "INSERT INTO vote (id_album, id_utilisateur, note, date) VALUES (:id_album, :id_utilisateur, :note, NOW())";
}
?>