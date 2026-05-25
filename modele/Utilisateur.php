<?php 

class Utilisateur
{
    public static $filtres = array(
		'id' => FILTER_VALIDATE_INT,
		'pseudo' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'courriel' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'mot_de_passe' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'fichier_image' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
	);

    protected $id;
	protected $pseudo;
	protected $courriel;
	protected $mot_de_passe;
	protected $fichier_image;

    public function __construct($tableau)
	{
		$tableau = filter_var_array($tableau, Utilisateur::$filtres);

		$this->id = $tableau['id'] ?? null;
		$this->pseudo = $tableau['pseudo'] ?? '';
		$this->courriel = $tableau['courriel'] ?? '';
		$this->mot_de_passe = $tableau['mot_de_passe'] ?? '';
		$this->fichier_image = !empty($tableau['fichier_image']) ? $tableau['fichier_image'] : 'defaut.jpg';
	}

    public function __set($propriete, $valeur)
	{
		switch($propriete)
		{
			case 'id':
				$this->id = $valeur;
			break;
			case 'pseudo':
				$this->pseudo = $valeur;
			break;
			case 'courriel':
				$this->courriel = $valeur;
			break;
			case 'mot_de_passe':
				$this->mot_de_passe = $valeur;
			break;
			case 'fichier_image':
				$this->fichier_image = $valeur;
			break;
		}
	}

	public function __get($propriete)
	{
    	return property_exists($this, $propriete) ? $this->$propriete : null;
	}
}
?>