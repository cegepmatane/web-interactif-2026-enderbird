<!-- album...
id
type (single/Ep/album/compilation)
nombre_morceaux
 image
nom
date_sortie
artiste (string)
 duree
 note -->

<?php 

class Album
{
    public static $filtres = array(
		'id' => FILTER_VALIDATE_INT,
		'type' => FILTER_UNSAFE_RAW,
		'nombre_morceaux' => FILTER_VALIDATE_INT,
		'image' => FILTER_UNSAFE_RAW,
		'nom' => FILTER_UNSAFE_RAW,
		'date_sortie' => FILTER_UNSAFE_RAW,
		'artiste' => FILTER_UNSAFE_RAW,
		'duree' => FILTER_VALIDATE_INT,
		'note' => FILTER_VALIDATE_INT
	);

    protected $id;
	protected $type;
	protected $nombre_morceaux;
	protected $image;
	protected $date_sortie;
	protected $artiste;
	protected $duree;
	protected $note;

    public function __construct($tableau)
	{
		$tableau = filter_var_array($tableau, Contrat::$filtres);

		$this->id = $tableau['id'];
		$this->type = $tableau['type'];
		$this->nombre_morceaux = $tableau['nombre_morceaux'];
		$this->image = $tableau['image'];
		$this->date_sortie = $tableau['date_sortie'];
		$this->artiste = $tableau['artiste'];
		$this->duree = $tableau['duree'];
		$this->note = $tableau['note'];
	}

    public function __set($propriete, $valeur)
	{
		switch($propriete)
		{
			case 'id':
				$this->id = $valeur;
			break;
			case 'type':
				$this->type = $valeur;
			break;
			case 'nombre_morceaux':
				$this->nombre_morceaux = $valeur;
			break;
			case 'image':
				$this->image = $valeur;
			break;
			case 'date_sortie':
				$this->date_sortie = $valeur;
			break;
			case 'artiste':
				$this->artiste = $valeur;
			break;
            case 'duree':
				$this->duree = $valeur;
			break;
            case 'note':
				$this->note = $valeur;
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