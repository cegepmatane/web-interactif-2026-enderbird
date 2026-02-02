<?php
/**
 * Le Gratteux - Backend AJAX
 * Grille 4x5 = 20 cases
 *
 * Actions:
 * - GET action=initialiser : Crée une nouvelle carte en session, retourne XML
 * - POST action=gratter&position=X : Gratte la case X, retourne XML avec état
 * - GET action=reclamer : Réclame le prix (texte)
 */

session_start();

header('Cache-Control: no-cache');

$methode = $_SERVER['REQUEST_METHOD'];
$action = '';

if ($methode === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
} else if ($methode === 'GET') {
    $action = isset($_GET['action']) ? $_GET['action'] : '';
}

// Configuration de la grille
$nombreColonnes = 4;
$nombreLignes = 5;
$nombreCases = $nombreColonnes * $nombreLignes; // 20 cases

// Symboles disponibles pour les cases
$symboles = array(
    array('symbole' => '🍒', 'nom' => 'Cerise'),
    array('symbole' => '🍋', 'nom' => 'Citron'),
    array('symbole' => '🍊', 'nom' => 'Orange'),
    array('symbole' => '🍇', 'nom' => 'Raisin'),
    array('symbole' => '🍀', 'nom' => 'Trèfle'),
    array('symbole' => '⭐', 'nom' => 'Étoile'),
    array('symbole' => '💎', 'nom' => 'Diamant'),
    array('symbole' => '👑', 'nom' => 'Couronne'),
    array('symbole' => '🎰', 'nom' => 'Machine'),
    array('symbole' => '💰', 'nom' => 'Sac or')
);

// Table des gains selon le nombre de symboles identiques
$tableauGains = array(
    5 => array('gain' => 5, 'message' => 'Cinq symboles identiques !'),
    6 => array('gain' => 10, 'message' => 'Six symboles identiques !'),
    7 => array('gain' => 20, 'message' => 'Sept symboles identiques !'),
    8 => array('gain' => 50, 'message' => 'Huit symboles identiques !'),
    9 => array('gain' => 100, 'message' => 'Neuf symboles identiques !'),
    10 => array('gain' => 200, 'message' => 'Dix symboles identiques !'),
    11 => array('gain' => 500, 'message' => 'Onze symboles identiques !'),
    12 => array('gain' => 1000, 'message' => 'Douze symboles ! SUPER GAIN !'),
    13 => array('gain' => 2000, 'message' => 'Treize symboles identiques !'),
    14 => array('gain' => 5000, 'message' => 'Quatorze symboles identiques !'),
    15 => array('gain' => 10000, 'message' => 'MEGA JACKPOT ! 15+ symboles !')
);

/**
 * Génère une nouvelle carte
 */
function genererCarte($symboles, $nombreCases) {
    $carte = array();
    $chanceDeGain = rand(1, 100);

    if ($chanceDeGain <= 50) {
        // 50% de chance d'avoir un gain
        $nombreIdentiques = 5;
        if ($chanceDeGain <= 3) {
            $nombreIdentiques = rand(12, 15);
        } else if ($chanceDeGain <= 10) {
            $nombreIdentiques = rand(9, 11);
        } else if ($chanceDeGain <= 25) {
            $nombreIdentiques = rand(6, 8);
        }

        $symboleGagnant = $symboles[array_rand($symboles)];

        for ($i = 0; $i < $nombreIdentiques; $i++) {
            $carte[] = $symboleGagnant;
        }

        for ($i = $nombreIdentiques; $i < $nombreCases; $i++) {
            $carte[] = $symboles[array_rand($symboles)];
        }

        shuffle($carte);
    } else {
        // Carte perdante
        for ($i = 0; $i < $nombreCases; $i++) {
            $carte[] = $symboles[array_rand($symboles)];
        }
    }

    return $carte;
}

/**
 * Calcule l'état des gains basé sur les cases révélées
 */
function calculerEtatGains($carte, $casesGrattees, $tableauGains, $nombreCases) {
    if (count($casesGrattees) < 5) {
        return array(
            'gainPotentiel' => 0,
            'gainConfirme' => false,
            'message' => 'Continuez à gratter...',
            'symboleGagnant' => '',
            'nombreIdentiques' => 0
        );
    }

    // Compter les symboles révélés
    $compteur = array();
    foreach ($casesGrattees as $position) {
        $symbole = $carte[$position]['symbole'];
        if (!isset($compteur[$symbole])) {
            $compteur[$symbole] = 0;
        }
        $compteur[$symbole]++;
    }

    $maxIdentiques = max($compteur);
    $symboleMax = array_search($maxIdentiques, $compteur);

    // Vérifier si toutes les cases sont grattées
    $toutGratte = (count($casesGrattees) === $nombreCases);

    if ($maxIdentiques >= 5) {
        $cle = min($maxIdentiques, 15);
        $infosGain = $tableauGains[$cle];
        return array(
            'gainPotentiel' => $infosGain['gain'],
            'gainConfirme' => $toutGratte,
            'message' => $toutGratte ? $infosGain['message'] : $infosGain['message'] . ' (continuez pour confirmer)',
            'symboleGagnant' => $symboleMax,
            'nombreIdentiques' => $maxIdentiques
        );
    }

    return array(
        'gainPotentiel' => 0,
        'gainConfirme' => $toutGratte,
        'message' => $toutGratte ? 'Pas de gain cette fois !' : 'Continuez à gratter...',
        'symboleGagnant' => '',
        'nombreIdentiques' => $maxIdentiques
    );
}

/**
 * Génère le XML de réponse pour grattage
 */
function genererXmlReponseGrattage($caseGrattee, $carte, $casesGrattees, $etatGains, $identifiantCarte, $nombreCases) {
    $documentXml = new DOMDocument('1.0', 'UTF-8');
    $documentXml->formatOutput = true;

    $racine = $documentXml->createElement('reponse');
    $documentXml->appendChild($racine);

    $elementIdentifiant = $documentXml->createElement('identifiant', $identifiantCarte);
    $racine->appendChild($elementIdentifiant);

    // Case nouvellement grattée
    if ($caseGrattee !== null) {
        $elementCaseGrattee = $documentXml->createElement('case-grattee');
        $elementCaseGrattee->setAttribute('position', $caseGrattee);

        $elementSymbole = $documentXml->createElement('symbole', $carte[$caseGrattee]['symbole']);
        $elementCaseGrattee->appendChild($elementSymbole);

        $elementNom = $documentXml->createElement('nom', $carte[$caseGrattee]['nom']);
        $elementCaseGrattee->appendChild($elementNom);

        $racine->appendChild($elementCaseGrattee);
    }

    // État des gains
    $elementGains = $documentXml->createElement('etat-gains');

    $elementGainPotentiel = $documentXml->createElement('gain-potentiel', $etatGains['gainPotentiel']);
    $elementGains->appendChild($elementGainPotentiel);

    $elementGainConfirme = $documentXml->createElement('gain-confirme', $etatGains['gainConfirme'] ? 'true' : 'false');
    $elementGains->appendChild($elementGainConfirme);

    $elementMessage = $documentXml->createElement('message', $etatGains['message']);
    $elementGains->appendChild($elementMessage);

    $elementSymboleGagnant = $documentXml->createElement('symbole-gagnant', $etatGains['symboleGagnant']);
    $elementGains->appendChild($elementSymboleGagnant);

    $elementNombreIdentiques = $documentXml->createElement('nombre-identiques', $etatGains['nombreIdentiques']);
    $elementGains->appendChild($elementNombreIdentiques);

    $elementCasesGrattees = $documentXml->createElement('cases-grattees', count($casesGrattees));
    $elementGains->appendChild($elementCasesGrattees);

    $elementCasesRestantes = $documentXml->createElement('cases-restantes', $nombreCases - count($casesGrattees));
    $elementGains->appendChild($elementCasesRestantes);

    $racine->appendChild($elementGains);

    return $documentXml->saveXML();
}

// === TRAITEMENT DES ACTIONS ===

if ($action === 'initialiser') {
    header('Content-Type: application/xml; charset=UTF-8');

    // Générer une nouvelle carte
    $carte = genererCarte($symboles, $nombreCases);

    $identifiantCarte = uniqid('carte_');
    $_SESSION['carte_actuelle'] = $carte;
    $_SESSION['identifiant_carte'] = $identifiantCarte;
    $_SESSION['cases_grattees'] = array();

    // Retourner confirmation XML
    $documentXml = new DOMDocument('1.0', 'UTF-8');
    $documentXml->formatOutput = true;

    $racine = $documentXml->createElement('reponse');
    $documentXml->appendChild($racine);

    $elementIdentifiant = $documentXml->createElement('identifiant', $identifiantCarte);
    $racine->appendChild($elementIdentifiant);

    $elementColonnes = $documentXml->createElement('colonnes', $nombreColonnes);
    $racine->appendChild($elementColonnes);

    $elementLignes = $documentXml->createElement('lignes', $nombreLignes);
    $racine->appendChild($elementLignes);

    $elementMessage = $documentXml->createElement('message', 'Gratteux prêt ! Grattez les cases pour découvrir vos symboles.');
    $racine->appendChild($elementMessage);

    echo $documentXml->saveXML();

} else if ($action === 'gratter') {
    header('Content-Type: application/xml; charset=UTF-8');

    $position = isset($_POST['position']) ? intval($_POST['position']) : -1;

    // Vérifier que la carte existe, sinon en créer une
    if (!isset($_SESSION['carte_actuelle'])) {
        $carte = genererCarte($symboles, $nombreCases);
        $identifiantCarte = uniqid('carte_');
        $_SESSION['carte_actuelle'] = $carte;
        $_SESSION['identifiant_carte'] = $identifiantCarte;
        $_SESSION['cases_grattees'] = array();
    }

    // Vérifier la position
    if ($position < 0 || $position >= $nombreCases) {
        $documentXml = new DOMDocument('1.0', 'UTF-8');
        $racine = $documentXml->createElement('erreur');
        $racine->appendChild($documentXml->createElement('message', 'Position invalide.'));
        $documentXml->appendChild($racine);
        echo $documentXml->saveXML();
        exit;
    }

    // Vérifier si déjà grattée
    if (in_array($position, $_SESSION['cases_grattees'])) {
        // Retourner simplement l'état actuel sans erreur
        $carte = $_SESSION['carte_actuelle'];
        $casesGrattees = $_SESSION['cases_grattees'];
        $identifiantCarte = $_SESSION['identifiant_carte'];
        $etatGains = calculerEtatGains($carte, $casesGrattees, $tableauGains, $nombreCases);
        echo genererXmlReponseGrattage(null, $carte, $casesGrattees, $etatGains, $identifiantCarte, $nombreCases);
        exit;
    }

    // Gratter la case
    $_SESSION['cases_grattees'][] = $position;

    $carte = $_SESSION['carte_actuelle'];
    $casesGrattees = $_SESSION['cases_grattees'];
    $identifiantCarte = $_SESSION['identifiant_carte'];

    // Calculer l'état des gains
    $etatGains = calculerEtatGains($carte, $casesGrattees, $tableauGains, $nombreCases);

    // Générer la réponse XML
    echo genererXmlReponseGrattage($position, $carte, $casesGrattees, $etatGains, $identifiantCarte, $nombreCases);

} else if ($action === 'reclamer') {
    header('Content-Type: text/plain; charset=UTF-8');

    if (!isset($_SESSION['carte_actuelle'])) {
        echo "Erreur: Aucune carte active.";
        exit;
    }

    $carte = $_SESSION['carte_actuelle'];
    $casesGrattees = $_SESSION['cases_grattees'];
    $etatGains = calculerEtatGains($carte, $casesGrattees, $tableauGains, $nombreCases);

    if ($etatGains['gainPotentiel'] > 0) {
        // Nettoyer la session
        unset($_SESSION['carte_actuelle']);
        unset($_SESSION['identifiant_carte']);
        unset($_SESSION['cases_grattees']);

        echo "Félicitations ! Vous avez gagné " . $etatGains['gainPotentiel'] . "€ avec " . $etatGains['nombreIdentiques'] . " " . $etatGains['symboleGagnant'] . " !";
    } else {
        unset($_SESSION['carte_actuelle']);
        unset($_SESSION['identifiant_carte']);
        unset($_SESSION['cases_grattees']);

        echo "Pas de gain cette fois. Rechargez la page pour un nouveau gratteux !";
    }

} else if ($action === 'nouveau') {
    header('Content-Type: application/xml; charset=UTF-8');

    // Nettoyer et créer une nouvelle carte
    $carte = genererCarte($symboles, $nombreCases);
    $identifiantCarte = uniqid('carte_');
    $_SESSION['carte_actuelle'] = $carte;
    $_SESSION['identifiant_carte'] = $identifiantCarte;
    $_SESSION['cases_grattees'] = array();

    $documentXml = new DOMDocument('1.0', 'UTF-8');
    $documentXml->formatOutput = true;

    $racine = $documentXml->createElement('reponse');
    $documentXml->appendChild($racine);

    $elementIdentifiant = $documentXml->createElement('identifiant', $identifiantCarte);
    $racine->appendChild($elementIdentifiant);

    $elementMessage = $documentXml->createElement('message', 'Nouveau gratteux prêt !');
    $racine->appendChild($elementMessage);

    echo $documentXml->saveXML();

} else {
    header('Content-Type: text/plain; charset=UTF-8');
    echo "Action non reconnue. Actions disponibles: initialiser, gratter, reclamer, nouveau";
}
