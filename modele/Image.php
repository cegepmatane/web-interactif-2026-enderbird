<?php 

class Image
{
    public static $filtres = array(
		'id' => FILTER_VALIDATE_INT,
		'nom_fichier' => FILTER_UNSAFE_RAW,
	);

    protected $id;
	protected $nom_fichier;

    public function __construct($tableau)
	{
		$tableau = filter_var_array($tableau, Image::$filtres);

		$this->id = $tableau['id'];
		$this->nom_fichier = $tableau['nom_fichier'];
	}

    public function __set($propriete, $valeur)
	{
		switch($propriete)
		{
			case 'id':
				$this->id = $valeur;
			break;
			case 'nom_fichier':
				$this->nom_fichier = $valeur;
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