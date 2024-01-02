<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["titre_event"];
    $description = $_POST["desc_event"];
    $date = $_POST["date_event"];
    $organisateur = $_POST["orga_event"];
    $affiche = "../images/" . basename($_POST["affiche_event"]);
    $salle = $_POST["salle_event"];

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

    // Récupérer l'ID auto-incrémenté de l'événement inséré
    $id_event = $connexion->lastInsertId();

    // Préparer la requête SQL
    $sql_salle_event = "INSERT INTO events_salle (Event_id_E, Salle_id_Salle) VALUES (:id_event, :id_salle)";
    $stmt_salle_event = $connexion->prepare($sql_salle_event);

    // Liaison des paramètres
    $stmt_salle_event->bindParam(':id_event', $id_event);
    $stmt_salle_event->bindParam(':id_salle', $salle);

    // Exécution de la requête
    $stmt_salle_event->execute();

    header("Location: ../Vue/events.php");
    exit();

    // Fermer la connexion
    $connexion = null;
}
?>

