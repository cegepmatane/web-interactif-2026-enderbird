<?php
interface VoteSQL
{
	public const SQL_LISTE_VOTE = "SELECT * FROM vote";
    public const SQL_DETAIL_VOTE = "SELECT * FROM vote WHERE id = :id";
	/* Admin */
}
?>