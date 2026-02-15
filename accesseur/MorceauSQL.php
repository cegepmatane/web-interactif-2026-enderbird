<?php
interface MorceauSQL
{
	public const SQL_LISTE_MORCEAU = "SELECT id, id_album, ordre, titre, artiste, duree FROM morceau ORDER BY ordre";
	public const SQL_DETAIL_MORCEAU = "SELECT id, id_album, ordre, titre, artiste, duree FROM morceau WHERE id = :id ORDER BY ordre";
	public const SQL_DETAIL_MORCEAUX = "SELECT morceau.id, morceau.id_album, morceau.ordre, morceau.titre, morceau.artiste, morceau.duree FROM morceau JOIN album ON album.id = morceau.id_album WHERE morceau.id_album = :id_album ORDER BY morceau.ordre";
	public const SQL_DETAIL_MORCEAUX_FAVORIS = "SELECT morceau.id, morceau.id_album, morceau.ordre, morceau.titre, morceau.artiste, morceau.duree FROM morceau JOIN favori ON favori.id_morceau = morceau.id WHERE favori.id_utilisateur = :id_utilisateur ORDER BY favori.date DESC";
}
?>