<?php 
	include_once __DIR__ . "/../modele/Image.php";
	include_once __DIR__ . "/../accesseur/AlbumSQL.php";

	class ImageDAO implements AlbumSQL
	{	
		public static function donnerNomFichierAlbum($id)
		{
			include __DIR__ . "/../connexion.php";

			$requete = $basededonnees->prepare(ImageDAO::SQL_DETAIL_MORCEAU);
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			//$morceau = $requete->fetchAll(PDO::FETCH_OBJ)[0];
			$morceau = $requete->fetch(PDO::FETCH_ASSOC);
			return new Morceau($morceau);
		}

        public static function donnerNomFichierUtilisateur($id)
		{
			include __DIR__ . "/../connexion.php";

			$requete = $basededonnees->prepare(ImageDAO::SQL_DETAIL_MORCEAU);
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			//$morceau = $requete->fetchAll(PDO::FETCH_OBJ)[0];
			$nomFichier = $requete->fetch(PDO::FETCH_ASSOC);
			return new Image($nomFichier);
		}

        // - - - - - ADMIN - - - - - 
		public static function ajouterImage($album)
		{
			include __DIR__ . "/../connexion.php";

			$demandeAjout = $basededonnees->prepare(AlbumDAO::SQL_AJOUTER_ALBUM);
			$demandeAjout->bindValue(':id_image',$album->id_image, PDO::PARAM_INT);
			$demandeAjout->bindValue(':type',$album->type, PDO::PARAM_STR);
			$demandeAjout->bindValue(':nom',$album->nom, PDO::PARAM_STR);
			$demandeAjout->bindValue(':date_sortie',$album->date_sortie, PDO::PARAM_STR);
			$demandeAjout->bindValue(':artiste',$album->artiste, PDO::PARAM_STR);

			$demandeAjout->execute();			
		}
		
		public static function editerImage($album)
		{
			//print_r($album);
			include __DIR__ . "/../connexion.php";

			$demandeEdition = $basededonnees->prepare(AlbumDAO::SQL_EDITER_ALBUM);
			// $demandeEdition->bindValue(':id',$album->id, PDO::PARAM_STR);
			$demandeEdition->bindValue(':id_image',$album->id_image, PDO::PARAM_INT);
			$demandeEdition->bindValue(':type',$album->type, PDO::PARAM_STR);
			$demandeEdition->bindValue(':nom',$album->nom, PDO::PARAM_STR);
			$demandeEdition->bindValue(':date_sortie',$album->date_sortie, PDO::PARAM_STR);
			$demandeEdition->bindValue(':artiste',$album->artiste, PDO::PARAM_STR);
			
			$demandeEdition->execute();
			//print_r($demandeEdition->errorInfo());
		}
		
		public static function effacerImage($id)
		{
			include __DIR__ . "/../connexion.php";

			$demandeEffacement = $basededonnees->prepare(AlbumDAO::SQL_EFFACER_ALBUM);
			$demandeEffacement->bindParam(':id', $id, PDO::PARAM_INT);
			$demandeEffacement->execute();
		}
	}
?>
