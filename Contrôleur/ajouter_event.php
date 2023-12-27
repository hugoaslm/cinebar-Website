<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["titre_event"];
    $description = $_POST["desc_event"];
    $date = $_POST["date_event"];
    $organisateur = $_POST["orga_event"];
    $affiche = "../images/" . basename($_POST["affiche_event"]);

    include '../Modèle/bdd.php';

    // Préparer la requête SQL
    $sql = "INSERT INTO events (nom, description, date, organisateur, affiche) VALUES (:nom, :description, :date, :organisateur, :affiche)";
    $stmt = $connexion->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':organisateur', $organisateur);
    $stmt->bindParam(':affiche', $affiche);

    // Exécution de la requête
    $stmt->execute();

    header("Location: ../Vue/events.php");
    exit();

    // Fermer la connexion
    $connexion = null;
}
?>

