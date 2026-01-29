<?php
interface MorceauSQL
{
	public const SQL_LISTE_MORCEAUX = "SELECT * FROM morceau";
	public const SQL_DETAIL_MORCEAU = "SELECT * FROM morceau WHERE id = :id";
	public const SQL_DETAIL_MORCEAUX = "SELECT * FROM morceau JOIN album ON album.id = morceau.id_album WHERE morceau.id_album = :id_album";
}
?>