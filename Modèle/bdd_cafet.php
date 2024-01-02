<?php
// Inclure le fichier de connexion à la base de données
include '../Modèle/bdd.php';


// Requête pour récupérer les projections liées à l'ID du film
$stmt_cafet = $connexion->prepare("SELECT * FROM salle WHERE nom_salle = 'cafet'");
$stmt_cafet->execute();

// Récupérer les résultats sous forme de tableau associatif
$cafet = $stmt_cafet->fetch(PDO::FETCH_ASSOC);

?>
