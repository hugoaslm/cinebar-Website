<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $event_id = $_POST["event_id"];

    include '../Modèle/bdd.php';

    // Supprimer l'ancien évènement du moment s'il existe
    $sql_delete = "DELETE FROM event_moment";
    $connexion->exec($sql_delete);

    // Insérer le nouvel évènement du moment
    $sql_insert = "INSERT INTO event_moment (event_id_E) VALUES (:event_id)";
    $stmt_insert = $connexion->prepare($sql_insert);
    $stmt_insert->bindParam(":event_id", $event_id);
    $stmt_insert->execute();

    header("Location: ../Vue/events.php");
    exit();
}
?>
