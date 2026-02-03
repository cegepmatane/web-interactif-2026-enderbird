<?php 
	include_once "../modele/Album.php";
	include_once "AlbumSQL.php";
	require_once "BaseDeDonnees.php";

	class AlbumDAO extends BaseDeDonnees implements AlbumSQL
	{				
		public static function listerAlbums()
		{
			$requete = BaseDeDonnees::getConnexion()->prepare(AlbumDAO::SQL_LISTE_ALBUM);
			$requete->execute();
			$albumsTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($albumsTableau as $albumTableau) $albums[] = new Album($albumTableau);
			return $albums;
		}
		
		public static function detaillerAlbum($id)
		{
			$requete = BaseDeDonnees::getConnexion()->prepare(AlbumDAO::SQL_DETAIL_ALBUM);
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			$album = $requete->fetch(PDO::FETCH_ASSOC);
			return new Album($album);
		}

		public static function getDureeAlbum($id)
		{
			$requete = BaseDeDonnees::getConnexion()->prepare(AlbumDAO::SQL_DUREE_ALBUM);
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			$resultat = $requete->fetch(PDO::FETCH_ASSOC);

			$duree = preg_replace('/^00:/', '', $resultat['duree']); // Pour plus beau
			return $duree; // string TIME
		}

		// - - - - - ADMIN - - - - - 
		public static function ajouterAlbum($album)
		{
			$demandeAjout = BaseDeDonnees::getConnexion()->prepare(AlbumDAO::SQL_AJOUTER_ALBUM);
			$demandeAjout->bindValue(':id_image',$album->id_image, PDO::PARAM_INT);
			$demandeAjout->bindValue(':type',$album->type, PDO::PARAM_STR);
			$demandeAjout->bindValue(':nom',$album->nom, PDO::PARAM_STR);
			$demandeAjout->bindValue(':date_sortie',$album->date_sortie, PDO::PARAM_STR);
			$demandeAjout->bindValue(':artiste',$album->artiste, PDO::PARAM_STR);

			$demandeAjout->execute();			
		}
		
		public static function editerAlbum($album)
		{
			//print_r($album);
			$demandeEdition = BaseDeDonnees::getConnexion()->prepare(AlbumDAO::SQL_EDITER_ALBUM);
			$demandeEdition->bindValue(':id',$album->id, PDO::PARAM_STR);
			$demandeEdition->bindValue(':id_image',$album->id_image, PDO::PARAM_INT);
			$demandeEdition->bindValue(':type',$album->type, PDO::PARAM_STR);
			$demandeEdition->bindValue(':nom',$album->nom, PDO::PARAM_STR);
			$demandeEdition->bindValue(':date_sortie',$album->date_sortie, PDO::PARAM_STR);
			$demandeEdition->bindValue(':artiste',$album->artiste, PDO::PARAM_STR);
			
			$demandeEdition->execute();
		}
		
		public static function effacerAlbum($id)
		{
			$demandeEffacement = BaseDeDonnees::getConnexion()->prepare(AlbumDAO::SQL_EFFACER_ALBUM);
			$demandeEffacement->bindParam(':id', $id, PDO::PARAM_INT);
			$demandeEffacement->execute();
		}

		public static function formater($texte)
		{
			$texte = htmlspecialchars($texte,ENT_QUOTES,'UTF-8');
			return $texte;
		}
	}
?>
