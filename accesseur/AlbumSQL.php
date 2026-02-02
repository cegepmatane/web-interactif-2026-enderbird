<?php
interface AlbumSQL
{
	// - - - Album - - - 
	public const SQL_LISTE_ALBUM = "SELECT * FROM album";
	public const SQL_DETAIL_ALBUM = "SELECT * FROM album WHERE id = :id";
	public const SQL_DUREE_ALBUM = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(morceau.duree))) as duree FROM album JOIN morceau ON album.id = morceau.id_album WHERE album.id = :id";
	/* Admin */
	public const SQL_AJOUTER_ALBUM = "INSERT into album(titre, client, description, technologie, debut) VALUES(:titre, :client, :description, :technologie, :debut)";
	public const SQL_EDITER_ALBUM = "UPDATE album SET titre = :titre, client = :client, client=:description, technologie=:technologie, debut=:debut WHERE id = :id";
	public const SQL_EFFACER_ALBUM = "DELETE FROM album WHERE id = :id";

	// - - - Morceau - - - 
	public const SQL_LISTE_MORCEAU = "SELECT * FROM morceau ORDER BY ordre";
	public const SQL_DETAIL_MORCEAU = "SELECT * FROM morceau WHERE id = :id ORDER BY ordre";
	public const SQL_DETAIL_MORCEAUX = "SELECT * FROM morceau JOIN album ON album.id = morceau.id_album WHERE morceau.id_album = :id_album ORDER BY morceau.ordre";
	/* Admin */

	// - - - Image - - - 
    public const SQL_IMAGE_ALBUM = "SELECT id FROM image JOIN album ON image.id = album.id_image WHERE album.id = :id";
    public const SQL_IMAGE_UTILISATEUR = "SELECT id FROM image JOIN utilisateur ON image.id = utilisateur.id_image WHERE utilisateur.id = :id";
	/* Admin */
	public const SQL_AJOUTER_IMAGE = "INSERT into image(nom_fichier) VALUES(:nom_fichier)";
	public const SQL_EDITER_IMAGE = "UPDATE image SET nom_fichier = :nom_fichier WHERE id = :id";
	public const SQL_EFFACER_IMAGE = "DELETE FROM image WHERE id = :id";
	
	// - - - Utilisateur - - - 
	public const SQL_LISTE_UTILISATEUR = "SELECT * FROM utilistateur";
    public const SQL_DETAIL_UTILISATEUR = "SELECT * FROM utilistateur WHERE id = :id";
	/* Admin */

	// - - - Vote - - - 
	public const SQL_LISTE_VOTE = "SELECT * FROM vote";
    public const SQL_DETAIL_VOTE = "SELECT * FROM vote WHERE id = :id";
	/* Admin */

	// - - - Commentaire - - - 
    public const SQL_LISTE_COMMENTAIRE = "SELECT * FROM commentaire";
    public const SQL_DETAIL_COMMENTAIRE = "SELECT * FROM commentaire JOIN utilisateur ON commentaire.id_utilisateur = utilisateur.id WHERE id_utilisateur = :id";
    public const SQL_DETAIL_COMMENTAIRES = "SELECT * FROM commentaire JOIN album ON commentaire.id_album = album.id WHERE id_album = :id";
	/* Admin */
}
?>