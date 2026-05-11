<?php 

class Vote
{
    public static $filtres = array(
		'id_album' => FILTER_VALIDATE_INT,
		'id_utilisateur' => FILTER_VALIDATE_INT,
		'note' => FILTER_VALIDATE_INT,
		'date' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'moyenne' => FILTER_VALIDATE_FLOAT,
		'total_votes' => FILTER_VALIDATE_INT
	);

	protected $id_album;
	protected $id_utilisateur;
	protected $note;
	protected $date;
	protected $moyenne;
	protected $total_votes;

    public function __construct($tableau)
	{
		$tableau = filter_var_array($tableau, Vote::$filtres);

		$this->id_album = $tableau['id_album'] ?? null;
		$this->id_utilisateur = $tableau['id_utilisateur'] ?? null;
		$this->note = $tableau['note'] ?? null;
		$this->date = $tableau['date'] ?? '';
		$this->moyenne = isset($tableau['moyenne']) ? round($tableau['moyenne'], 1) : null;
		$this->total_votes = $tableau['total_votes'] ?? null;
	}

    public function __set($propriete, $valeur)
	{
		switch($propriete)
		{
			case 'id_album':
				$this->id_album = $valeur;
			break;
			case 'id_utilisateur':
				$this->id_utilisateur = $valeur;
			break;
			case 'note':
				$this->note = $valeur;
			break;
			case 'date':
				$this->date = $valeur;
			break;
			case 'moyenne':
				$this->moyenne = round($valeur, 1);
			break;
			case 'total_votes':
				$this->total_votes = $valeur;
			break;
		}
	}

	public function __get($propriete)
	{
    	return property_exists($this, $propriete) ? $this->$propriete : null;
	}
}
?>