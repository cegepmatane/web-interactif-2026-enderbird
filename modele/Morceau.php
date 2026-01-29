<!-- morceau...
id
id_album
nom
artiste
duree

<?php 

class Morceau
{
  public static $filtres = array(
		'id' => FILTER_VALIDATE_INT,
		'id_album' => FILTER_VALIDATE_INT,
		'nom' => FILTER_UNSAFE_RAW,
		'artiste' => FILTER_UNSAFE_RAW,
		'duree' => FILTER_VALIDATE_INT
	);

  protected $id;
	protected $id_album;
	protected $nom;
	protected $artiste;
	protected $duree;

  public function __construct($tableau)
	{
		$tableau = filter_var_array($tableau, Contrat::$filtres);

		$this->id = $tableau['id'];
		$this->id_album = $tableau['id_album'];
		$this->nom = $tableau['nom'];
		$this->artiste = $tableau['artiste'];
		$this->duree = $tableau['duree'];
	}

  public function __set($propriete, $valeur)
	{
		switch($propriete)
		{
			case 'id':
				$this->id = $valeur;
			break;
			case 'id_album':
				$this->id_album = $valeur;
			break;
			case 'nom':
				$this->nom = $valeur;
			break;
			case 'artiste':
				$this->artiste = $valeur;
			break;
			case 'duree':
				$this->duree = $valeur;
			break;
		}
	}

	public function __get($propriete)
	{
		//$variable = '$this->'.$propriete;
		//return $$variable;
		$self = get_object_vars($this); // externaliser pour optimiser
		//print_r($self);
		return $self[$propriete];
	}	
}
//$contrat = new Contrat();
//$contrat->titre = "coucou";
//echo $contrat->titre;
?>