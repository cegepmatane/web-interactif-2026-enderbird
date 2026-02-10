<?php 
	include_once "modele/Vote.php";
	include_once "VoteSQL.php";
	require_once "BaseDeDonnees.php";

	class VoteDAO extends BaseDeDonnees implements VoteSQL
	{	
		public static function listerVotesAlbum(Album $album)
		{
			$idAlbum = $album->id;

			$requete = BaseDeDonnees::getConnexion()->prepare(VoteDAO::SQL_LISTER_VOTES_ALBUM);
			$requete->bindParam(':id_album', $idAlbum, PDO::PARAM_INT);
			$requete->execute();

			$votesTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($votesTableau as $voteTableau) {
				$votes[] = new Vote($voteTableau);
			}
			return $votes;
		}
		
		public static function detaillerVote(Vote $vote)
		{
			$idVote = $vote->id;

			$requete = BaseDeDonnees::getConnexion()->prepare(VoteDAO::SQL_DETAILLER_VOTE);
			$requete->bindParam(':id', $idVote, PDO::PARAM_INT);
			$requete->execute();
			$vote = $requete->fetch(PDO::FETCH_ASSOC);

		    if (!$vote) return null;

			return new Vote($vote);
		}

		public static function ajouterVote($vote)
		{
			$idAlbum = $vote->id_album;
			$idUtilisateur = $vote->id_utilisateur;
			$note = $vote->note;

			$demandeAjout = BaseDeDonnees::getConnexion()->prepare(VoteDAO::SQL_AJOUTER_VOTE);
			$demandeAjout->bindValue(':id_album', $idAlbum, PDO::PARAM_INT);
			$demandeAjout->bindParam(':id_utilisateur', $idUtilisateur, PDO::PARAM_INT);
			$demandeAjout->bindParam(':note', $note, PDO::PARAM_INT);

			$reussite = $demandeAjout->execute();
    		return $reussite; // Réussi ou pas
		}
		
		// public static function editerVote($vote)
		// {
		// 	$demandeEdition = BaseDeDonnees::getConnexion()->prepare(ImageDAO::SQL_EDITER_IMAGE);
		// 	$demandeEdition->bindValue(':id',$vote->id, PDO::PARAM_INT);
		// 	$demandeEdition->bindValue(':nom_fichier',$vote->nom_fichier, PDO::PARAM_STR);
			
		// 	$demandeEdition->execute();
		// }
		// public static function effacerVote($id)
		// {
		// 	$demandeEffacement = BaseDeDonnees::getConnexion()->prepare(ImageDAO::SQL_EFFACER_IMAGE);
		// 	$demandeEffacement->bindParam(':id', $id, PDO::PARAM_INT);
		// 	$demandeEffacement->execute();
		// }

		public static function formater($texte)
		{
			$texte = htmlspecialchars($texte,ENT_QUOTES,'UTF-8');
			return $texte;
		}
	}
?>
