<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer le terme de recherche
    $terme_recherche = $_POST['recherche'];
    $terme_recherche = "%" . $terme_recherche . "%";

    // Requête pour rechercher les films
    $sql_films = "SELECT * FROM films WHERE nom LIKE :terme_recherche";
    $stmt_films = $connexion->prepare($sql_films);
    $stmt_films->bindParam(':terme_recherche', $terme_recherche, PDO::PARAM_STR);
    $stmt_films->execute();

    // Requête pour rechercher les événements
    $sql_events = "SELECT * FROM events WHERE nom LIKE :terme_recherche";
    $stmt_events = $connexion->prepare($sql_events);
    $stmt_events->bindParam(':terme_recherche', $terme_recherche, PDO::PARAM_STR);
    $stmt_events->execute();
    
}
?>

