<?php 
	require_once get_template_directory() . "/modele/Morceau.php";
	require_once get_template_directory() . "/accesseur/MorceauSQL.php";
	require_once get_template_directory() . "/accesseur/BaseDeDonnees.php";

	class MorceauDAO extends BaseDeDonnees implements MorceauSQL
	{				
		public static function listerMorceaux()
		{
			$requete = BaseDeDonnees::getConnexion()->prepare(MorceauDAO::SQL_LISTE_MORCEAU);
			$requete->execute();
			
			$morceauxTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($morceauxTableau as $morceauTableau) {
				$morceaux[] = new Morceau($morceauTableau);
			}
			return $morceaux;
		}
		
		public static function detaillerMorceau(Morceau $morceau)
		{
			$idMorceau = $morceau->id;
			
			$requete = BaseDeDonnees::getConnexion()->prepare(MorceauDAO::SQL_DETAIL_MORCEAU);
			$requete->bindParam(':id', $idMorceau, PDO::PARAM_INT);
			$requete->execute();
			$morceau = $requete->fetch(PDO::FETCH_ASSOC);

		    if (!$morceau) return null;

			return new Morceau($morceau);
		}

		public static function detaillerMorceauxAlbum(Album $album)
		{
			$idAlbum = $album->id;

			$requete = BaseDeDonnees::getConnexion()->prepare(MorceauDAO::SQL_DETAIL_MORCEAUX);
			$requete->bindParam(':id_album', $idAlbum, PDO::PARAM_INT);
			$requete->execute();

			$morceaux = [];
			$morceauxTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($morceauxTableau as $morceauTableau) {
				$morceaux[] = new Morceau($morceauTableau);
			}

			return $morceaux;
		}

		public static function detaillerMorceauxFavoris(Utilisateur $utilisateur)
		{
			$idUtilisateur = $utilisateur->id;

			$requete = BaseDeDonnees::getConnexion()->prepare(MorceauDAO::SQL_DETAIL_MORCEAUX_FAVORIS);
			$requete->bindParam(':id_utilisateur', $idUtilisateur, PDO::PARAM_INT);
			$requete->execute();

			$morceaux = [];
			$morceauxTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($morceauxTableau as $morceauTableau) {
				$morceaux[] = new Morceau($morceauTableau);
			}

		    if (!$morceaux) return null;

			return $morceaux;
		}
	}

?>
