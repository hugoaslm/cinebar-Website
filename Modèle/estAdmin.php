<?php

include '../Modèle/bdd.php';

// Vérifier le statut administrateur de l'utilisateur en interrogeant la base de données
$estAdmin = false; // Initialisez à false par défaut

if (isset($_SESSION['identifiant'])) {
    $identifiant = $_SESSION['identifiant'];

    // Interroger la base de données pour obtenir la valeur de l'attribut admin
    $query = "SELECT admin FROM utilisateur WHERE pseudo = :identifiant";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
    $stmt->execute();

    // Récupérer le résultat
    $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier la valeur de l'attribut admin
    if ($resultat && $resultat['admin'] == 1) {
        $estAdmin = true;
        $role = 'Administrateur';
    } else {
        $role = 'Utilisateur';
    }
}
?>