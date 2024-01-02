<?php
include 'bdd.php';

//

$id_F = $_GET['id_F'];

// Requête pour récupérer les projections liées à l'ID du film
$stmt_proj = $connexion->prepare("SELECT id_Projection FROM projection WHERE films_salle_films_id_F = :id_F");
$stmt_proj->bindParam(':id_F', $id_F);
$stmt_proj->execute();
    
// Récupérer les résultats sous forme de tableau associatif
$projections = $stmt_proj->fetch(PDO::FETCH_ASSOC);

// Construire la requête SQL
$query = "SELECT ROUND(AVG(decibel), 1) AS moyenne_decibel
FROM donnees_capteur
WHERE Projection_id_Projection = :id_projection;";

// Préparer la requête
$stmt = $connexion->prepare($query);

// Liaison des paramètres
$stmt->bindParam(':id_projection', $projections['id_Projection']);

// Exécuter la requête
$stmt->execute();

// Récupérer les résultats
$donnees_capteur = $stmt->fetch(PDO::FETCH_ASSOC);

$valeurEnDB = number_format($donnees_capteur['moyenne_decibel'], 1);

$min = 50;
$max = 100;

// Normaliser la valeur en dB
$valeurNormalisee = ($valeurEnDB - $min) / ($max - $min);

$note = $valeurNormalisee * 5;

// Calculer la valeur pour le curseur de volume
$valeurCurseur = round($valeurNormalisee * 100); // La valeur maximale pour un input range est 100

?>
