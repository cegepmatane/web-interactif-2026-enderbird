<?php 

class Album
{
    public static $filtres = array(
		'id' => FILTER_VALIDATE_INT,
		'nom' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'artiste' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'type' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'date_sortie' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'fichier_image' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'duree' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
	);

    protected $id;
	protected $nom;
	protected $artiste;
	protected $type;
	protected $date_sortie;
	protected $fichier_image;
	protected $duree;

    public function __construct($tableau)
	{
		$tableau = filter_var_array($tableau, Album::$filtres);

		$this->id = $tableau['id'] ?? null;
		$this->nom = $tableau['nom'] ?? '';
		$this->artiste = $tableau['artiste'] ?? '';
		$this->type = $tableau['type'] ?? '';
		$this->date_sortie = $tableau['date_sortie'] ?? '';
		$this->fichier_image = $tableau['fichier_image'] ?? 'defaut.png';
		$this->duree = isset($tableau['duree']) ? preg_replace('/^00:/', '', $tableau['duree']) : '0:00';
	}

    public function __set($propriete, $valeur)
	{
		switch($propriete)
		{
			case 'id':
				$this->id = $valeur;
			break;
			case 'nom':
				$this->nom = $valeur;
			break;
			case 'artiste':
				$this->artiste = $valeur;
			break;
			case 'type':
				$this->type = $valeur;
			break;
			case 'date_sortie':
				$this->date_sortie = $valeur;
			break;
			case 'fichier_image':
				$this->fichier_image = $valeur;
			break;
			case 'duree':
				$this->duree = preg_replace('/^00:/', '', $valeur);
			break;
		}
	}

	public function __get($propriete)
	{
    	return property_exists($this, $propriete) ? $this->$propriete : null;
	}
}
?>