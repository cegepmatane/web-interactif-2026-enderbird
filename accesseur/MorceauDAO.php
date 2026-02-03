<?php 
	include_once "../modele/Morceau.php";
	include_once "MorceauSQL.php";
	require_once "BaseDeDonnees.php";

	class MorceauDAO extends BaseDeDonnees implements MorceauSQL
	{				
		public static function listerMorceaux()
		{
			$requete = BaseDeDonnees::getConnexion()->prepare(MorceauDAO::SQL_LISTE_MORCEAU);
			$requete->execute();
			$morceauxTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($morceauxTableau as $morceauTableau) $morceaux[] = new Morceau($morceauTableau);
			return $morceaux;
		}
		
		public static function detaillerMorceau($id)
		{
			$requete = BaseDeDonnees::getConnexion()->prepare(MorceauDAO::SQL_DETAIL_MORCEAU);
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			$morceau = $requete->fetch(PDO::FETCH_ASSOC);
			return new Morceau($morceau);
		}

		public static function detaillerMorceauxAlbum($idAlbum)
		{
			$requete = BaseDeDonnees::getConnexion()->prepare(MorceauDAO::SQL_DETAIL_MORCEAUX);
			$requete->bindParam(':id_album', $idAlbum, PDO::PARAM_INT);
			$requete->execute();
			$morceauxTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($morceauxTableau as $morceauTableau) $morceaux[] = new Morceau($morceauTableau);
			return $morceaux;
		}

		public static function formater($texte)
		{
			$texte = htmlspecialchars($texte,ENT_QUOTES,'UTF-8');
			return $texte;
		}
	}

?>
