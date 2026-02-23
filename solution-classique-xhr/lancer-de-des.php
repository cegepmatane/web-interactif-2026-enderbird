<?php
/**
 * Lancer de dés - Backend AJAX
 * Méthode: GET
 * Réponse: Texte simple (nombre entre 1 et 6)
 */

header('Content-Type: text/plain; charset=UTF-8');
header('Cache-Control: no-cache');

$valeurDe = rand(1, 6);

echo $valeurDe;
