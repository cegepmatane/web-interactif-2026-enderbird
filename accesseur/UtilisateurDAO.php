<?php 
  require_once dirname(__DIR__, 1) . "/modele/Utilisateur.php";
  require_once __DIR__ . "/UtilisateurSQL.php";
  require_once __DIR__ . "/BaseDeDonnees.php";
  
  class UtilisateurDAO extends BaseDeDonnees implements UtilisateurSQL
  {	
  	public static function listerUtilisateurs()
  	{
  	  $requete = BaseDeDonnees::getConnexion()->prepare(UtilisateurDAO::SQL_LISTE_UTILISATEUR);
  	  $requete->execute();
  
  	  $utilisateurs = [];
  	  $utilisateursTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
  	  foreach($utilisateursTableau as $utilisateurTableau) {
  	  	$utilisateurs[] = new Utilisateur($utilisateurTableau);
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

	public static function trouverCourriel(Utilisateur $utilisateur)
	{
	  $courrielUtilisateur = $utilisateur->courriel;

	  $requete = BaseDeDonnees::getConnexion()->prepare(UtilisateurDAO::SQL_TROUVER_COURRIEL);
  	  $requete->bindParam(':courriel', $courrielUtilisateur, PDO::PARAM_STR);
  	  $requete->execute();
  	  $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
  
  	  if (!$utilisateur) return null;
  	  
  	  return new Utilisateur($utilisateur);
	}
  }
?>
