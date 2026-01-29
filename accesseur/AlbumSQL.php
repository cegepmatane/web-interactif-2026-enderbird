<?php
interface AlbumSQL
{
	public const SQL_LISTE_ALBUM = "SELECT * FROM album";
	public const SQL_DETAIL_ALBUM = "SELECT * FROM album WHERE id = :id";
}
?>