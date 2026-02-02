<?php 
	include_once __DIR__ . "/../modele/Morceau.php";
	include_once __DIR__ . "/../accesseur/AlbumSQL.php";

	class MorceauDAO implements AlbumSQL
	{				
		public static function listerMorceaux()
		{
			include __DIR__ . "/../connexion.php";

			$requete = $basededonnees->prepare(MorceauDAO::SQL_LISTE_MORCEAU);
			$requete->execute();
			//$morceaux = $requete->fetchAll(PDO::FETCH_OBJ);
			$morceauxTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($morceauxTableau as $morceauTableau) $morceaux[] = new Morceau($morceauTableau);
			return $morceaux;
		}
		
		public static function detaillerMorceau($id)
		{
			include __DIR__ . "/../connexion.php";

			$requete = $basededonnees->prepare(MorceauDAO::SQL_DETAIL_MORCEAU);
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			//$morceau = $requete->fetchAll(PDO::FETCH_OBJ)[0];
			$morceau = $requete->fetch(PDO::FETCH_ASSOC);
			return new Morceau($morceau);
		}

		public static function detaillerMorceauxAlbum($idAlbum)
		{
			include __DIR__ . "/../connexion.php";

			$requete = $basededonnees->prepare(MorceauDAO::SQL_DETAIL_MORCEAUX);
			$requete->bindParam(':id_album', $idAlbum, PDO::PARAM_INT);
			$requete->execute();
			//$morceauxTableau = $requete->fetchAll(PDO::FETCH_OBJ)[0];
			$morceauxTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach($morceauxTableau as $morceauTableau) $morceaux[] = new Morceau($morceauTableau);
			return $morceaux;
		}
	}
?>
