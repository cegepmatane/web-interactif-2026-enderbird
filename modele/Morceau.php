<?php 

class Morceau
{
	public static $filtres = array(
		'id' => FILTER_VALIDATE_INT,
		'id_album' => FILTER_VALIDATE_INT,
		'ordre' => FILTER_VALIDATE_INT,
		'titre' => FILTER_UNSAFE_RAW,
		'artiste' => FILTER_UNSAFE_RAW,
		'duree' => FILTER_UNSAFE_RAW
	);

	protected $id;
	protected $id_album;
	protected $ordre;
	protected $titre;
	protected $artiste;
	protected $duree;

	public function __construct($tableau)
	{
		$tableau = filter_var_array($tableau, Morceau::$filtres);

		$this->id = $tableau['id'];
		$this->id_album = $tableau['id_album'];
		$this->ordre = $tableau['ordre'];
		$this->titre = $tableau['titre'];
		$this->artiste = $tableau['artiste'];
		$this->duree = preg_replace('/^00:/', '', $tableau['duree']); //POUR LE FORMAT
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
			case 'ordre':
				$this->ordre = $valeur;
			break;
			case 'titre':
				$this->titre = $valeur;
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
?>