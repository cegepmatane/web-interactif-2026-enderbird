<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

$usager = 'contracteur';
$motdepasse = 'creeperced10'; // EUUUUUHHHHH
$hote = 'localhost';
$base = 'contracteur';
$charset = 'utf8';

$dsn = "mysql:host=$hote;dbname=$base;charset=$charset";
$basededonnees = new PDO($dsn, $usager, $motdepasse);

?>