<?php 
  require_once dirname(__DIR__, 1) . "/modele/Collection.php";
  require_once __DIR__ . "/CollectionSQL.php";
  require_once __DIR__ . "/BaseDeDonnees.php";
  
  class CollectionDAO extends BaseDeDonnees implements CollectionSQL
  {	
    public static function listerCollections()
    {
      $requete = BaseDeDonnees::getConnexion()->prepare(CollectionDAO::SQL_LISTE_COLLECTION);
      $requete->execute();
  
      $collections = [];
      $collectionsTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
      foreach($collectionsTableau as $collectionTableau) {
        $collections[] = new Collection($collectionTableau);
      }
      return $collections;
    }
  
    public static function listerCollectionsUtilisateur(Utilisateur $utilisateur)
    {
      $idUtilisateur = $utilisateur->id;
  
      $requete = BaseDeDonnees::getConnexion()->prepare(CollectionDAO::SQL_LISTE_COLLECTIONS_UTILISATEUR);
      $requete->bindParam(':id_utilisateur', $idUtilisateur, PDO::PARAM_INT);
      $requete->execute();
  
      $collections = [];
      $collectionsTableau = $requete->fetchAll(PDO::FETCH_ASSOC);
      foreach($collectionsTableau as $collectionTableau) {
        $collections[] = new Collection($collectionTableau);
      }
      return $collections;
    }
  
    public static function ajouterCollection(Collection $collection)
    {
      $idAlbum = $collection->id_album;
      $idUtilisateur = $collection->id_utilisateur;
  
      $demandeAjout = BaseDeDonnees::getConnexion()->prepare(CollectionDAO::SQL_AJOUTER_COLLECTION);
      $demandeAjout->bindValue(':id_album', $idAlbum, PDO::PARAM_INT);
      $demandeAjout->bindParam(':id_utilisateur', $idUtilisateur, PDO::PARAM_INT);
  
      $reussite = $demandeAjout->execute();
      return $reussite; // Réussi ou pas
    }
  
    public static function effacerCollection(Collection $collection)
    {
      $idAlbum = $collection->id_album;
      $idUtilisateur = $collection->id_utilisateur;
  
      $demandeEfface = BaseDeDonnees::getConnexion()->prepare(CollectionDAO::SQL_EFFACER_COLLECTION);
      $demandeEfface->bindValue(':id_album', $idAlbum, PDO::PARAM_INT);
      $demandeEfface->bindParam(':id_utilisateur', $idUtilisateur, PDO::PARAM_INT);
  
      $reussite = $demandeEfface->execute();
      return $reussite; // Réussi ou pas
    }
  }
?>
