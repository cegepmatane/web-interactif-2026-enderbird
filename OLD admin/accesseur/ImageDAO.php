<?php 
	include_once "modele/Image.php";
	include_once "ImageSQL.php";
	require_once "BaseDeDonnees.php";

	class ImageDAO extends BaseDeDonnees implements ImageSQL
	{	
		public static function detaillerImage($id)
		{
			$requete = BaseDeDonnees::getConnexion()->prepare(ImageDAO::SQL_DETAILLER_IMAGE);
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			$image = $requete->fetch(PDO::FETCH_ASSOC);
			return new Image($image);
		}

        // - - - - - ADMIN - - - - - 
		public static function ajouterImage($image)
		{
			$baseDeDonnees = BaseDeDonnees::getConnexion();

			$demandeAjout = $baseDeDonnees->prepare(ImageDAO::SQL_AJOUTER_IMAGE);
			$demandeAjout->bindValue(':nom_fichier',$image->nom_fichier, PDO::PARAM_STR);

			$demandeAjout->execute();

			$image->id = $baseDeDonnees->lastInsertId(); //Donne l'id à l'élément
    		return $image;
		}
		
		public static function editerImage($image)
		{
			$demandeEdition = BaseDeDonnees::getConnexion()->prepare(ImageDAO::SQL_EDITER_IMAGE);
			$demandeEdition->bindValue(':id',$image->id, PDO::PARAM_INT);
			$demandeEdition->bindValue(':nom_fichier',$image->nom_fichier, PDO::PARAM_STR);
			
			$demandeEdition->execute();
		}
		
		public static function effacerImage($id)
		{
			$demandeEffacement = BaseDeDonnees::getConnexion()->prepare(ImageDAO::SQL_EFFACER_IMAGE);
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
