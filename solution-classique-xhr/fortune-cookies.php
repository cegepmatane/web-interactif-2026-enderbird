<?php
/**
 * Biscuits de Fortune - Backend AJAX
 * Méthode: POST
 * Données reçues: numero_biscuit
 * Réponse: Texte (emoji|fortune|numéros chanceux)
 * Action: Enregistre la fortune dans un fichier markdown
 */

header('Content-Type: text/plain; charset=UTF-8');
header('Cache-Control: no-cache');

$fortunes = array(
    1 => array('texte' => 'Une grande aventure vous attend très bientôt !', 'emoji' => '🌟'),
    2 => array('texte' => 'Votre créativité va illuminer le monde !', 'emoji' => '🎨'),
    3 => array('texte' => 'Un sourire peut changer une journée entière !', 'emoji' => '😊'),
    4 => array('texte' => 'La patience est la clé du succès !', 'emoji' => '🔑'),
    5 => array('texte' => 'Vos rêves sont à portée de main !', 'emoji' => '✨'),
    6 => array('texte' => "L'amitié est le plus grand trésor !", 'emoji' => '💎'),
    7 => array('texte' => "Aujourd'hui est votre jour de chance !", 'emoji' => '🍀'),
    8 => array('texte' => 'Le bonheur se cache dans les petites choses !', 'emoji' => '🌈'),
    9 => array('texte' => 'Votre gentillesse sera récompensée !', 'emoji' => '💝'),
    10 => array('texte' => 'Une surprise agréable arrive bientôt !', 'emoji' => '🎁'),
    11 => array('texte' => 'Votre courage vous mènera loin !', 'emoji' => '🦁'),
    12 => array('texte' => 'La chance sourit aux audacieux !', 'emoji' => '🎲'),
    13 => array('texte' => "Votre intelligence brillera aujourd'hui !", 'emoji' => '🧠'),
    14 => array('texte' => 'Un nouveau talent va se révéler !', 'emoji' => '🎭'),
    15 => array('texte' => 'Votre énergie positive est contagieuse !', 'emoji' => '⚡'),
    16 => array('texte' => 'Les étoiles sont alignées en votre faveur !', 'emoji' => '⭐'),
    17 => array('texte' => 'Votre persévérance sera couronnée de succès !', 'emoji' => '👑'),
    18 => array('texte' => 'Un moment magique vous attend !', 'emoji' => '🪄'),
    19 => array('texte' => 'Votre cœur généreux attire le bonheur !', 'emoji' => '❤️'),
    20 => array('texte' => "L'univers conspire pour votre réussite !", 'emoji' => '🌌'),
    21 => array('texte' => 'Votre intuition ne vous trompera pas !', 'emoji' => '🔮'),
    22 => array('texte' => 'Une rencontre spéciale changera tout !', 'emoji' => '💫'),
    23 => array('texte' => 'Votre optimisme est votre super-pouvoir !', 'emoji' => '🦸'),
    24 => array('texte' => 'Les meilleures choses arrivent à ceux qui croient !', 'emoji' => '🌺'),
    25 => array('texte' => "Aujourd'hui marque un nouveau départ !", 'emoji' => '🚀')
);

$numeroBiscuit = isset($_POST['numero_biscuit']) ? intval($_POST['numero_biscuit']) : 0;

if ($numeroBiscuit < 1 || $numeroBiscuit > 25) {
    echo "erreur|Numéro de biscuit invalide|0";
    exit;
}

$fortune = $fortunes[$numeroBiscuit];

// Générer les numéros chanceux
$numerosChanceux = array();
for ($i = 0; $i < 6; $i++) {
    $numero = rand(1, 49);
    while (in_array($numero, $numerosChanceux)) {
        $numero = rand(1, 49);
    }
    $numerosChanceux[] = $numero;
}
sort($numerosChanceux);

// Enregistrer dans le fichier markdown
$cheminFichier = __DIR__ . '/tableau-sagesse.md';
$dateHeure = date('Y-m-d H:i:s');

$entreeMarkdown = "\n## " . $fortune['emoji'] . " Biscuit #" . $numeroBiscuit . "\n";
$entreeMarkdown .= "**Date:** " . $dateHeure . "\n\n";
$entreeMarkdown .= "> " . $fortune['texte'] . "\n\n";
$entreeMarkdown .= "**Numéros chanceux:** " . implode(', ', $numerosChanceux) . "\n\n";
$entreeMarkdown .= "---\n";

// Créer le fichier avec en-tête si inexistant
if (!file_exists($cheminFichier)) {
    $enTete = "# 📜 Tableau de la Sagesse\n\n";
    $enTete .= "Collection des fortunes découvertes dans les biscuits magiques.\n\n";
    $enTete .= "---\n";
    file_put_contents($cheminFichier, $enTete);
}

file_put_contents($cheminFichier, $entreeMarkdown, FILE_APPEND);

// Retourner la réponse
$reponse = $fortune['emoji'] . '|' . $fortune['texte'] . '|' . implode(',', $numerosChanceux);
echo $reponse;
