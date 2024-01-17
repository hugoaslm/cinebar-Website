<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $cgu = $_POST["cgu"];

    include '../Modèle/bdd.php';

    // Préparer la requête SQL
    $sql = "UPDATE cgu SET contenu = :content";
    $stmt = $connexion->prepare($sql);

    // Binder les valeurs
    $stmt->bindParam(':content', $cgu);

    // Exécuter la requête
    $stmt->execute();

    header("Location: ../cgu");
    exit();

    // Fermer la connexion
    $connexion = null;
}
?>

