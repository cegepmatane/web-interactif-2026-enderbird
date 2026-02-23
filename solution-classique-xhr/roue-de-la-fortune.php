<?php
/**
 * Roue de la Fortune - Backend AJAX
 * Méthode: GET
 * Réponse: XML
 */

header('Content-Type: application/xml; charset=UTF-8');
header('Cache-Control: no-cache');

$prix = array(
    array('nom' => '100 Points', 'emoji' => '💯', 'valeur' => 100),
    array('nom' => 'Super Bonus', 'emoji' => '🎁', 'valeur' => 500),
    array('nom' => '50 Points', 'emoji' => '🎯', 'valeur' => 50),
    array('nom' => 'Jackpot', 'emoji' => '💰', 'valeur' => 1000),
    array('nom' => '200 Points', 'emoji' => '⭐', 'valeur' => 200),
    array('nom' => 'Mini Prix', 'emoji' => '🍬', 'valeur' => 25)
);

$indexAleatoire = array_rand($prix);
$prixGagne = $prix[$indexAleatoire];

$documentXml = new DOMDocument('1.0', 'UTF-8');
$documentXml->formatOutput = true;

$racine = $documentXml->createElement('reponse');
$documentXml->appendChild($racine);

$elementPrix = $documentXml->createElement('prix');
$racine->appendChild($elementPrix);

$elementNom = $documentXml->createElement('nom', $prixGagne['nom']);
$elementPrix->appendChild($elementNom);

$elementEmoji = $documentXml->createElement('emoji', $prixGagne['emoji']);
$elementPrix->appendChild($elementEmoji);

$elementValeur = $documentXml->createElement('valeur', $prixGagne['valeur']);
$elementPrix->appendChild($elementValeur);

$elementMessage = $documentXml->createElement('message', 'Félicitations !');
$elementPrix->appendChild($elementMessage);

echo $documentXml->saveXML();
