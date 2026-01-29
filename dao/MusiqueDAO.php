<?php 

	include_once "modele/Musique.php";
	include_once "accesseur/MusiqueSQL.php";

	class Accesseur
	{
		public static $basededonnees = null;

		public static function initialiser()
		{
			$usager = 'contracteur';
			$motdepasse = 'creeperced10';
			$hote = 'localhost';
			$base = 'contracteur';
			$dsn = 'mysql:dbname='.$base.';host=' . $hote;
			MusiqueDAO::$basededonnees = new PDO($dsn, $usager, $motdepasse);
			MusiqueDAO::$basededonnees->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		
	}
	
	class MusiqueDAO extends Accesseur implements MusiqueSQL
	{				
		public static function listerMusiques()
		{
			
			MusiqueDAO::initialiser();

			$demandeMusiques = MusiqueDAO::$basededonnees->prepare(MusiqueDAO::SQL_LISTE_CONTRATS);
			$demandeMusiques->execute();
			//$musiques = $demandeMusiques->fetchAll(PDO::FETCH_OBJ);
			$musiquesTableau = $demandeMusiques->fetchAll(PDO::FETCH_ASSOC);
			foreach($musiquesTableau as $musiqueTableau) $musiques[] = new Musique($musiqueTableau);
			return $musiques;
		}
		
		public static function detaillerMusique($id)
		{
			MusiqueDAO::initialiser();

			$demandeMusique = MusiqueDAO::$basededonnees->prepare(MusiqueDAO::SQL_DETAIL_CONTRAT);
			$demandeMusique->bindParam(':id', $id, PDO::PARAM_INT);
			$demandeMusique->execute();
			//$musique = $demandeMusique->fetchAll(PDO::FETCH_OBJ)[0];
			$musique = $demandeMusique->fetch(PDO::FETCH_ASSOC);
			return new Musique($musique);
		}
	}

function formater($texte)
{
	//$texte = html_entity_decode($texte,ENT_COMPAT,'UTF-8');
	//$texte = htmlentities($texte,ENT_COMPAT,'ISO-8859-1');
	return $texte;
}
?>
