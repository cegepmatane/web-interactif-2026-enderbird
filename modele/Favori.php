<?php 

class Favori
{
    public static $filtres = array(
		'id_morceau' => FILTER_VALIDATE_INT,
		'id_utilisateur' => FILTER_VALIDATE_INT,
		'date' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
	);

	protected $id_morceau;
	protected $id_utilisateur;
	protected $date;

    public function __construct($tableau)
	{
		$tableau = filter_var_array($tableau, Favori::$filtres);

		$this->id_morceau = $tableau['id_morceau'] ?? null;
		$this->id_utilisateur = $tableau['id_utilisateur'] ?? null;
		$this->date = $tableau['date'] ?? '';
	}

    public function __set($propriete, $valeur)
	{
		switch($propriete)
		{
			case 'id_morceau':
				$this->id_morceau = $valeur;
			break;
			case 'id_utilisateur':
				$this->id_utilisateur = $valeur;
			break;
			case 'date':
				$this->date = $valeur;
			break;
		}
	}

	public function __get($propriete)
	{
    	return property_exists($this, $propriete) ? $this->$propriete : null;
	}
}
?>