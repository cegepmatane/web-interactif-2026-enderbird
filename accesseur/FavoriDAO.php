<?php 
	require_once dirname(__DIR__, 1) . "/modele/Favori.php";
	require_once __DIR__ . "/FavoriSQL.php";
	require_once __DIR__ . "/BaseDeDonnees.php";

	class FavoriDAO extends BaseDeDonnees implements FavoriSQL
	{	
		public static function listerFavoris()
		{
			$requete = BaseDeDonnees::getConnexion()->prepare(FavoriDAO::SQL_LISTE_FAVORI);
			$requete->execute();

			$favoris = [];
			$favorisTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($favorisTableau as $favoriTableau) {
				$favoris[] = new Favori($favoriTableau);
			}
			return $favoris;
		}

		public static function listerFavorisUtilisateur(Utilisateur $utilisateur)
		{
			$idUtilisateur = $utilisateur->id;

			$requete = BaseDeDonnees::getConnexion()->prepare(FavoriDAO::SQL_LISTE_FAVORIS_UTILISATEUR);
			$requete->bindParam(':id_utilisateur', $idUtilisateur, PDO::PARAM_INT);
			$requete->execute();

			$favoris = [];
			$favorisTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($favorisTableau as $favoriTableau) {
				$favoris[] = new Favori($favoriTableau);
			}
			return $favoris;
		}

		public static function ajouterFavori(Favori $favori)
		{
			$idMorceau = $favori->id_morceau;
			$idUtilisateur = $favori->id_utilisateur;

			$demandeAjout = BaseDeDonnees::getConnexion()->prepare(FavoriDAO::SQL_AJOUTER_FAVORI);
			$demandeAjout->bindValue(':id_morceau', $idMorceau, PDO::PARAM_INT);
			$demandeAjout->bindParam(':id_utilisateur', $idUtilisateur, PDO::PARAM_INT);

			$reussite = $demandeAjout->execute();
    		return $reussite; // Réussi ou pas
		}

		public static function effacerFavori(Favori $favori)
		{
			$idMorceau = $favori->id_morceau;
			$idUtilisateur = $favori->id_utilisateur;

			$demandeEfface = BaseDeDonnees::getConnexion()->prepare(FavoriDAO::SQL_EFFACER_FAVORI);
			$demandeEfface->bindValue(':id_morceau', $idMorceau, PDO::PARAM_INT);
			$demandeEfface->bindParam(':id_utilisateur', $idUtilisateur, PDO::PARAM_INT);

			$reussite = $demandeEfface->execute();
    		return $reussite; // Réussi ou pas
		}
	}
?>
