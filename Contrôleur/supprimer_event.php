<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $event_id = $_POST["event_id"];

    include '../Modèle/bdd.php';

    // Insérer le nouveau film du moment
    $sql_insert = "DELETE FROM events WHERE id_E = :event_id";
    $stmt_insert = $connexion->prepare($sql_insert);
    $stmt_insert->bindParam(":event_id", $event_id);
    $stmt_insert->execute();

    header("Location: ../events");
    exit();
}
?>
