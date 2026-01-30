<?php
interface MorceauSQL
{
	public const SQL_LISTE_MORCEAU = "SELECT * FROM morceau ORDER BY ordre";
	public const SQL_DETAIL_MORCEAU = "SELECT * FROM morceau WHERE id = :id ORDER BY ordre";
	public const SQL_DETAIL_MORCEAUX = "SELECT * FROM morceau JOIN album ON album.id = morceau.id_album WHERE morceau.id_album = :id_album ORDER BY morceau.ordre";
}
?>