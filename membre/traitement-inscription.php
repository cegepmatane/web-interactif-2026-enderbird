<?php
include "../traitement-fichier.php";

include "../configuration.php";
require CHEMIN_ACCESSEUR . "MembreDAO.php";

// traitement inscription-information.php
// php filter

if (isset($_POST['transmis'])) {
    if (empty($_POST['pseudonyme']) || ! preg_match('/^[A-Za-z0-9]+([A-Za-z0-9]*|[._-]?[A-Za-z0-9]+)*$/', $_POST['pseudonyme'])) {
        $_SESSION['erreur-information'] = "Veuillez renseigner votre pseudonyme correctement";
        header('Location: inscription-information.php');

    } else if (! empty(MembreDAO::trouverMembre(['pseudonyme' => $_POST['pseudonyme']]))) {
        $_SESSION['erreur-information'] = "Veuillez choisir un autre pseudonyme";
        header('Location: inscription-information.php');

    } else if (empty($_POST['motdepasse1']) || empty($_POST['motdepasse1']) != empty($_POST['motdepasse2'])) {
        $_SESSION['erreur-information'] = "Veuillez renseigner votre mot de passe correctement";
        header('Location: inscription-information.php');

    } else if (! preg_match('/^(?=.*\d)\S{8,16}$/', $_POST['motdepasse1'])) { // Le regit est plus simple pour autorisé "admin123"
        $_SESSION['erreur-information'] = "Votre mot de passe doit contenir au moins 8 caractères avec majuscule, chiffre et caractère spécial";
        header('Location: inscription-information.php');

    } else {
        $image = ajouterAvatar(); // Vérification du post des images

        $filtreMembre = [
            'pseudonyme'  => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'motdepasse1' => FILTER_SANITIZE_ENCODED,
            'motdepasse2' => FILTER_SANITIZE_ENCODED,
        ];

        $informations = filter_input_array(INPUT_POST, $filtreMembre);

        $_SESSION['membre']['pseudonyme'] = $informations['pseudonyme'];
        $_SESSION['membre']['motdepasse'] = password_hash($informations['motdepasse1'], PASSWORD_DEFAULT);
        $_SESSION['membre']['avatar']     = $image;

        $reussiteInscription = MembreDAO::ajouterMembre($_SESSION['membre']);

        if ($reussiteInscription) {
            header('Location: ../membre.php');
        }
    }
}
