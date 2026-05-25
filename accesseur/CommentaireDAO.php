<?php 
	require_once dirname(__DIR__, 1) . "/modele/Commentaire.php";
	require_once __DIR__ . "/CommentaireSQL.php";
	require_once __DIR__ . "/BaseDeDonnees.php";

	class CommentaireDAO extends BaseDeDonnees implements CommentaireSQL
	{	
		public static function listerCommentaires()
		{
			$requete = BaseDeDonnees::getConnexion()->prepare(CommentaireDAO::SQL_LISTE_COMMENTAIRE);
			$requete->execute();

			$commentaires = [];
			$commentairesTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($commentairesTableau as $commentaireTableau) {
				$commentaires[] = new Commentaire($commentaireTableau);
			}
			return $commentaires;
		}

		public static function listerCommentairesAlbum(Album $album)
		{
			$idAlbum = $album->id;

			$requete = BaseDeDonnees::getConnexion()->prepare(CommentaireDAO::SQL_LISTE_COMMENTAIRES_ALBUM);
			$requete->bindParam(':id_album', $idAlbum, PDO::PARAM_INT);
			$requete->execute();

			$commentaires = [];
			$commentairesTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($commentairesTableau as $commentaireTableau) {
				$commentaires[] = new Commentaire($commentaireTableau);
			}
			return $commentaires;
		}

		public static function detaillerCommentaire(Commentaire $commentaire)
		{
			$idCommentaire = $commentaire->id;

			$requete = BaseDeDonnees::getConnexion()->prepare(CommentaireDAO::SQL_DETAIL_COMMENTAIRE);
			$requete->bindParam(':id', $idCommentaire, PDO::PARAM_INT);
			$requete->execute();
			$commentaire = $requete->fetch(PDO::FETCH_ASSOC);

		    if (!$commentaire) return null;

			return new Commentaire($commentaire);
		}

		public static function ajouterCommentaire(Commentaire $commentaire)
		{
			$idAlbum = $commentaire->id_album;
			$idUtilisateur = $commentaire->id_utilisateur;
			$message = $commentaire->message;

			$demandeAjout = BaseDeDonnees::getConnexion()->prepare(CommentaireDAO::SQL_AJOUTER_COMMENTAIRE);
			$demandeAjout->bindValue(':id_album', $idAlbum, PDO::PARAM_INT);
			$demandeAjout->bindParam(':id_utilisateur', $idUtilisateur, PDO::PARAM_INT);
			$demandeAjout->bindParam(':message', $message, PDO::PARAM_STR);

			$reussite = $demandeAjout->execute();
    		return $reussite; // Réussi ou pas
		}
	}
?>
