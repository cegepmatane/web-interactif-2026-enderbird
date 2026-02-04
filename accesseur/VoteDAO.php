<?php 
	include_once "../modele/Vote.php";
	include_once "VoteSQL.php";
	require_once "BaseDeDonnees.php";

	class VoteDAO extends BaseDeDonnees implements VoteSQL
	{	
		public static function detaillerVote($id)
		{
			$requete = BaseDeDonnees::getConnexion()->prepare(VoteDAO::SQL_DETAILLER_VOTE);
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			$vote = $requete->fetch(PDO::FETCH_ASSOC);
			return new Vote($vote);
		}

        // - - - - - ADMIN - - - - - 
		public static function ajouterVote($vote)
		{
			$baseDeDonnees = BaseDeDonnees::getConnexion();

			$demandeAjout = $baseDeDonnees->prepare(ImageDAO::SQL_AJOUTER_IMAGE);
			$demandeAjout->bindValue(':nom_fichier',$vote->nom_fichier, PDO::PARAM_STR);

			$demandeAjout->execute();

			$vote->id = $baseDeDonnees->lastInsertId(); //Donne l'id à l'élément
    		return $vote;
		}
		
		public static function editerVote($vote)
		{
			$demandeEdition = BaseDeDonnees::getConnexion()->prepare(ImageDAO::SQL_EDITER_IMAGE);
			$demandeEdition->bindValue(':id',$vote->id, PDO::PARAM_INT);
			$demandeEdition->bindValue(':nom_fichier',$vote->nom_fichier, PDO::PARAM_STR);
			
			$demandeEdition->execute();
		}
		
		public static function effacerVote($id)
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
