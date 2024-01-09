<?php

include 'bdd.php';

$query = "SELECT decibel FROM donnees_capteur ORDER BY date DESC LIMIT 1";
$statement = $connexion->query($query);

// Récupération du résultat
$result = $statement->fetch(PDO::FETCH_ASSOC);

$valeurEnDB = $result['decibel'];

$min = 50;
$max = 100;

// Normaliser la valeur en dB
$valeurNormalisee = ($valeurEnDB - $min) / ($max - $min);

$note = $valeurNormalisee * 5;

// Calculer la valeur pour le curseur de volume
$valeurCurseur = round($valeurNormalisee * 100); // La valeur maximale pour un input range est 100

?>