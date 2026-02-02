<?php 
	include_once "../modele/Morceau.php";
	include_once "MorceauSQL.php";

	class MorceauDAO implements MorceauSQL
	{				
		public static function listerMorceaux()
		{
			include "Connexion.php";

			$requete = $basededonnees->prepare(MorceauDAO::SQL_LISTE_MORCEAU);
			$requete->execute();
			//$morceaux = $requete->fetchAll(PDO::FETCH_OBJ);
			$morceauxTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($morceauxTableau as $morceauTableau) $morceaux[] = new Morceau($morceauTableau);
			return $morceaux;
		}
		
		public static function detaillerMorceau($id)
		{
			include "Connexion.php";

			$requete = $basededonnees->prepare(MorceauDAO::SQL_DETAIL_MORCEAU);
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			//$morceau = $requete->fetchAll(PDO::FETCH_OBJ)[0];
			$morceau = $requete->fetch(PDO::FETCH_ASSOC);
			return new Morceau($morceau);
		}

		public static function detaillerMorceauxAlbum($idAlbum)
		{
			include "Connexion.php";

			$requete = $basededonnees->prepare(MorceauDAO::SQL_DETAIL_MORCEAUX);
			$requete->bindParam(':id_album', $idAlbum, PDO::PARAM_INT);
			$requete->execute();
			//$morceauxTableau = $requete->fetchAll(PDO::FETCH_OBJ)[0];
			$morceauxTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($morceauxTableau as $morceauTableau) $morceaux[] = new Morceau($morceauTableau);
			return $morceaux;
		}

		public static function formater($texte)
		{
			$texte = htmlspecialchars($texte,ENT_COMPAT,'UTF-8');
			//$texte = htmlentities($texte,ENT_COMPAT,'ISO-8859-1');
			return $texte;
		}
	}

?>
