<?php 

class Album
{
    public static $filtres = array(
		'id' => FILTER_VALIDATE_INT,
		'id_image' => FILTER_VALIDATE_INT,
		'type' => FILTER_UNSAFE_RAW,
		'nom' => FILTER_UNSAFE_RAW,
		'date_sortie' => FILTER_UNSAFE_RAW,
		'artiste' => FILTER_UNSAFE_RAW
	);

    protected $id;
	protected $id_image;
	protected $type;
	protected $nom;
	protected $date_sortie;
	protected $artiste;

    public function __construct($tableau)
	{
		$tableau = filter_var_array($tableau, Album::$filtres);

		$this->id = $tableau['id'];
		$this->id_image = $tableau['id_image'];
		$this->type = $tableau['type'];
		$this->nom = $tableau['nom'];
		$this->date_sortie = $tableau['date_sortie'];
		$this->artiste = $tableau['artiste'];
	}

    public function __set($propriete, $valeur)
	{
		switch($propriete)
		{
			case 'id':
				$this->id = $valeur;
			break;
			case 'id_image':
				$this->id_image = $valeur;
			break;
			case 'type':
				$this->type = $valeur;
			break;
			case 'nom':
				$this->nom = $valeur;
			break;
			case 'date_sortie':
				$this->date_sortie = $valeur;
			break;
			case 'artiste':
				$this->artiste = $valeur;
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