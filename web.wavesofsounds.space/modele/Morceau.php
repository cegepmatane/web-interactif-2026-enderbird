<?php 

class Morceau
{
	public static $filtres = array(
		'id' => FILTER_VALIDATE_INT,
		'id_album' => FILTER_VALIDATE_INT,
		'ordre' => FILTER_VALIDATE_INT,
		'titre' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'artiste' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'duree' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
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

		$this->id = $tableau['id'] ?? null;
		$this->id_album = $tableau['id_album'] ?? null;
		$this->ordre = $tableau['ordre'] ?? null;
		$this->titre = $tableau['titre'] ?? '';
		$this->artiste = $tableau['artiste'] ?? '';
		$this->duree = isset($tableau['duree']) ? preg_replace('/^00:/', '', $tableau['duree']) : '0:00';
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