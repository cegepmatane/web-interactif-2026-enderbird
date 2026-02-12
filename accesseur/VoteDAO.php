<?php 
	require_once "modele/Vote.php";
	require_once "VoteSQL.php";
	require_once "BaseDeDonnees.php";

	class VoteDAO extends BaseDeDonnees implements VoteSQL
	{	
		public static function listerVotes()
		{
			$requete = BaseDeDonnees::getConnexion()->prepare(VoteDAO::SQL_LISTE_VOTE);
			$requete->execute();

			$votes = [];
			$votesTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($votesTableau as $voteTableau) {
				$votes[] = new Vote($voteTableau);
			}
			return $votes;
		}

		public static function listerVotesAlbum(Album $album)
		{
			$idAlbum = $album->id;

			$requete = BaseDeDonnees::getConnexion()->prepare(VoteDAO::SQL_LISTE_VOTES_ALBUM);
			$requete->bindParam(':id_album', $idAlbum, PDO::PARAM_INT);
			$requete->execute();

			$votes = [];
			$votesTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($votesTableau as $voteTableau) {
				$votes[] = new Vote($voteTableau);
			}
			return $votes;
		}

		public static function listerVotesUtilisateur(Utilisateur $utilisateur)
		{
			$idUtilisateur = $utilisateur->id;

			$requete = BaseDeDonnees::getConnexion()->prepare(VoteDAO::SQL_LISTE_VOTES_UTILISATEUR);
			$requete->bindParam(':id_utilisateur', $idUtilisateur, PDO::PARAM_INT);
			$requete->execute();

			$votes = [];
			$votesTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($votesTableau as $voteTableau) {
				$votes[] = new Vote($voteTableau);
			}
			return $votes;
		}

		public static function detaillerVote(Vote $vote)
		{
			$idVote = $vote->id;

			$requete = BaseDeDonnees::getConnexion()->prepare(VoteDAO::SQL_DETAIL_VOTE);
			$requete->bindParam(':id', $idVote, PDO::PARAM_INT);
			$requete->execute();
			$vote = $requete->fetch(PDO::FETCH_ASSOC);

		    if (!$vote) return null;
			
			return new Vote($vote);
		}

		public static function ajouterVote(Vote $vote)
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
	}
?>
