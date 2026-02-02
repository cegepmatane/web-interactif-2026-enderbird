<?php 
	include_once "/../modele/Image.php";
	include_once "ImageSQL.php";

	class ImageDAO implements ImageSQL
	{	
		public static function donnerNomFichierAlbum($id)
		{
			include "Connexion.php";

			$requete = $basededonnees->prepare(ImageDAO::SQL_IMAGE_ALBUM);
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			//$image = $requete->fetchAll(PDO::FETCH_OBJ)[0];
			$image = $requete->fetch(PDO::FETCH_ASSOC);
			return new Image($image);
		}

        public static function donnerNomFichierUtilisateur($id)
		{
			include __DIR__ . "Connexion.php";

			$requete = $basededonnees->prepare(ImageDAO::SQL_IMAGE_UTILISATEUR);
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			//$image = $requete->fetchAll(PDO::FETCH_OBJ)[0];
			$image = $requete->fetch(PDO::FETCH_ASSOC);
			return new Image($image);
		}

        // - - - - - ADMIN - - - - - 
		public static function ajouterImage($album)
		{
			include __DIR__ . "Connexion.php";

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
			include __DIR__ . "Connexion.php";

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
			include __DIR__ . "Connexion.php";

			$demandeEffacement = $basededonnees->prepare(AlbumDAO::SQL_EFFACER_ALBUM);
			$demandeEffacement->bindParam(':id', $id, PDO::PARAM_INT);
			$demandeEffacement->execute();
		}

		public static function formater($texte)
		{
			$texte = htmlspecialchars($texte,ENT_COMPAT,'UTF-8');
			//$texte = htmlentities($texte,ENT_COMPAT,'ISO-8859-1');
			return $texte;
		}
	}
?>
