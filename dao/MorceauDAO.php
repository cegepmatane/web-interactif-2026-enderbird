<?php 

	include_once "modele/Album.php";
	include_once "accesseur/AlbumSQL.php";

	class Accesseur
	{
		public static $basededonnees = null;

		public static function initialiser()
		{
			$usager = 'contracteur';
			$motdepasse = 'creeperced10';
			$hote = 'localhost';
			$base = 'contracteur';
			$dsn = 'mysql:dbname='.$base.';host=' . $hote;
			AlbumDAO::$basededonnees = new PDO($dsn, $usager, $motdepasse);
			AlbumDAO::$basededonnees->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	}
	
	class AlbumDAO extends Accesseur implements AlbumSQL
	{				
		public static function listerAlbums()
		{
			AlbumDAO::initialiser();

			$requete = AlbumDAO::$basededonnees->prepare(AlbumDAO::SQL_LISTE_ALBUM);
			$requete->execute();
			//$albums = $requete->fetchAll(PDO::FETCH_OBJ);
			$albumsTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($albumsTableau as $albumTableau) $albums[] = new Album($albumTableau);
			return $albums;
		}
		
		public static function detaillerMusique($id)
		{
			AlbumDAO::initialiser();

			$requete = AlbumDAO::$basededonnees->prepare(AlbumDAO::SQL_DETAIL_ALBUM);
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			//$album = $requete->fetchAll(PDO::FETCH_OBJ)[0];
			$album = $requete->fetch(PDO::FETCH_ASSOC);
			return new Album($album);
		}
	}

// function formater($texte)
// {
// 	//$texte = html_entity_decode($texte,ENT_COMPAT,'UTF-8');
// 	//$texte = htmlentities($texte,ENT_COMPAT,'ISO-8859-1');
// 	return $texte;
// }
?>
