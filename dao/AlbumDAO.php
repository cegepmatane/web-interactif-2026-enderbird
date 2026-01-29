<?php 
	include_once __DIR__ . "/../modele/Album.php";
	include_once __DIR__ . "/../accesseur/AlbumSQL.php";

	class AlbumDAO implements AlbumSQL
	{				
		public static function listerAlbums()
		{
			include __DIR__ . "/../connexion.php";

			$requete = $basededonnees->prepare(AlbumSQL::SQL_LISTE_ALBUM);
			$requete->execute();
			//$albums = $requete->fetchAll(PDO::FETCH_OBJ);
			$albumsTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($albumsTableau as $albumTableau) $albums[] = new Album($albumTableau);
			return $albums;
		}
		
		public static function detaillerAlbum($id)
		{
			include __DIR__ . "/../connexion.php";

			$requete = $basededonnees->prepare(AlbumSQL::SQL_DETAIL_ALBUM);
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
