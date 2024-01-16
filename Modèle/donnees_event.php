<?php
include 'bdd.php';

$id_E = $_GET['id_E'];

// Construire la requête SQL
$query = "SELECT ROUND(AVG(decibel), 1) AS moyenne_decibel
FROM donnees_capteur_event
WHERE events_id_E = :event_id;";

// Préparer la requête
$stmt = $connexion->prepare($query);

// Liaison des paramètres
$stmt->bindParam(':event_id', $id_E);

// Exécuter la requête
$stmt->execute();

// Récupérer les résultats
$donnees_capteur_event = $stmt->fetch(PDO::FETCH_ASSOC);

$valeurEnDB = number_format($donnees_capteur_event['moyenne_decibel'], 1);

$min = 50;
$max = 100;

// Normaliser la valeur en dB
$valeurNormalisee = ($valeurEnDB - $min) / ($max - $min);

$note = $valeurNormalisee * 5;

// Calculer la valeur pour le curseur de volume
$valeurCurseur = round($valeurNormalisee * 100); // La valeur maximale pour un input range est 100

?>
