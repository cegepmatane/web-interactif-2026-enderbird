<?php 

class Commentaire
{
    public static $filtres = array(
		'id' => FILTER_VALIDATE_INT,
		'id_album' => FILTER_VALIDATE_INT,
		'id_utilisateur' => FILTER_VALIDATE_INT,
		'message' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'date' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
	);

    protected $id;
	protected $id_album;
	protected $id_utilisateur;
	protected $message;
	protected $date;

    public function __construct($tableau)
	{
		$tableau = filter_var_array($tableau, Commentaire::$filtres);

		$this->id = $tableau['id'] ?? null;
		$this->id_album = $tableau['id_album'] ?? null;
		$this->id_utilisateur = $tableau['id_utilisateur'] ?? null;
		$this->message = $tableau['message'] ?? '';
		$this->date = $tableau['date'] ?? '';
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
			case 'id_utilisateur':
				$this->id_utilisateur = $valeur;
			break;
			case 'message':
				$this->message = $valeur;
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