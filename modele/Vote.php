<?php 

class Vote
{
    public static $filtres = array(
		'id' => FILTER_VALIDATE_INT,
		'id_album' => FILTER_VALIDATE_INT,
		'id_utilisateur' => FILTER_VALIDATE_INT,
		'note' => FILTER_VALIDATE_INT,
		'date' => FILTER_UNSAFE_RAW,
	);

    protected $id;
	protected $id_album;
	protected $id_utilisateur;
	protected $note;
	protected $date;

    public function __construct($tableau)
	{
		$tableau = filter_var_array($tableau, Image::$filtres);

		$this->id = $tableau['id'];
		$this->id_album = $tableau['id_album'];
		$this->id_utilisateur = $tableau['id_utilisateur'];
		$this->note = $tableau['note'];
		$this->date = $tableau['date'];
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
			case 'note':
				$this->note = $valeur;
			break;
			case 'date':
				$this->date = $valeur;
			break;
		}
	}

	public function __get($propriete)
	{
		$self = get_object_vars($this);
		return $self[$propriete];
	}
}
?>