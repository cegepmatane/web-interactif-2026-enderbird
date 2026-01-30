<?php
interface AlbumSQL
{
	public const SQL_LISTE_ALBUM = "SELECT * FROM album";
	public const SQL_DETAIL_ALBUM = "SELECT * FROM album WHERE id = :id";
	public const SQL_DUREE_ALBUM = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(morceau.duree))) as duree FROM album JOIN morceau ON album.id = morceau.id_album WHERE album.id = :id";
}
?>