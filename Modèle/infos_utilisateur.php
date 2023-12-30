<?php

include "bdd.php";

if (isset($_SESSION['identifiant'])) {
    $identifiant = $_SESSION['identifiant'];

    // Interroger la base de données pour obtenir la valeur de l'attribut admin
    $query = "SELECT * FROM utilisateur WHERE pseudo = :identifiant";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
    $stmt->execute();

    // Récupérer le résultat
    $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>