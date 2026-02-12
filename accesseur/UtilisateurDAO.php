<?php 
	require_once "modele/Utilisateur.php";
	require_once "UtilisateurSQL.php";
	require_once "BaseDeDonnees.php";

	class UtilisateurDAO extends BaseDeDonnees implements UtilisateurSQL
	{	
		public static function listerUtilisateurs()
		{
			$requete = BaseDeDonnees::getConnexion()->prepare(UtilisateurDAO::SQL_LISTE_UTILISATEUR);
			$requete->execute();

			$utilisateurs = [];
			$utilisateursTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($utilisateursTableau as $utilisateurTableau) {
				$votes[] = new Vote($utilisateurTableau);
			}
			return $utilisateurs;
		}

		public static function detaillerUtilisateur(Utilisateur $utilisateur)
		{
			$idUtilisateur = $utilisateur->id;

			$requete = BaseDeDonnees::getConnexion()->prepare(UtilisateurDAO::SQL_DETAIL_UTILISATEUR);
			$requete->bindParam(':id', $idUtilisateur, PDO::PARAM_INT);
			$requete->execute();
			$utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

		    if (!$utilisateur) return null;
			
			return new Utilisateur($utilisateur);
		}
	}
?>
