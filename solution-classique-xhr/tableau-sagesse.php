<?php
/**
 * Tableau de la Sagesse - Backend AJAX
 * Méthode: GET
 * Réponse: Contenu du fichier markdown ou message si vide
 */

header('Content-Type: text/plain; charset=UTF-8');
header('Cache-Control: no-cache');

$cheminFichier = __DIR__ . '/tableau-sagesse.md';

if (file_exists($cheminFichier)) {
    echo file_get_contents($cheminFichier);
} else {
    echo "# 📜 Tableau de la Sagesse\n\nAucune fortune n'a encore été découverte.\n\nRetournez aux biscuits de fortune pour commencer votre collection !";
}
