<?php

// Construire la requête SQL
$query = "SELECT decibel
FROM donnees_capteur_cafet
WHERE Capteur_id_Capteur = (
    SELECT id_Capteur FROM capteur WHERE Salle_id_Salle = 
(SELECT id_Salle FROM salle WHERE nom_salle = 'cafet')
)
ORDER BY date DESC
LIMIT 1;";

// Préparer la requête
$stmt = $connexion->prepare($query);

// Exécuter la requête
$stmt->execute();

// Récupérer les résultats
$donnees_capteur_cafet = $stmt->fetch(PDO::FETCH_ASSOC);

$valeurEnDB = number_format($donnees_capteur_cafet['decibel'], 1);

$min = 50;
$max = 100;

// Normaliser la valeur en dB
$valeurNormalisee = ($valeurEnDB - $min) / ($max - $min);

$note = $valeurNormalisee * 5;

// Calculer la valeur pour le curseur de volume
$valeurCurseur = round($valeurNormalisee * 100); // La valeur maximale pour un input range est 100

?>
