<?php 
	require_once "modele/Album.php";
	require_once "AlbumSQL.php";
	require_once "BaseDeDonnees.php";

	class AlbumDAO extends BaseDeDonnees implements AlbumSQL
	{				
		public static function listerAlbums()
		{
			$requete = BaseDeDonnees::getConnexion()->prepare(AlbumDAO::SQL_LISTE_ALBUM);
			$requete->execute();

			$albumsTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($albumsTableau as $albumTableau) {
				$albums[] = new Album($albumTableau);
			}

			return $albums;
		}
		
		public static function detaillerAlbum(Album $album)
		{
			$idAlbum = $album->id;

		    $requete = BaseDeDonnees::getConnexion()->prepare(AlbumDAO::SQL_DETAIL_ALBUM);
		    $requete->bindParam(':id', $idAlbum, PDO::PARAM_INT);
		    $requete->execute();
		    $album = $requete->fetch(PDO::FETCH_ASSOC);

		    if (!$album) return null;

		    return new Album($album);
		}

		public static function rechercherAlbumMorceau($recherche)
		{
    		$requete = BaseDeDonnees::getConnexion()->prepare(AlbumDAO::SQL_RECHERCHER_ALBUM_MORCEAU);
    		$requete->execute([':recherche' => "%$recherche%"]);

			return $requete->fetchAll(PDO::FETCH_ASSOC);
		}
	}
?>
