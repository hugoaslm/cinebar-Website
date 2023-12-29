<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $salle_id = $_POST["salle_id"];

    include '../Modèle/bdd.php';

    // Insérer le nouveau film du moment
    $sql_insert = "DELETE FROM salle WHERE id_Salle = :salle_id";
    $stmt_insert = $connexion->prepare($sql_insert);
    $stmt_insert->bindParam(":salle_id", $salle_id);
    $stmt_insert->execute();

    header("Location: ../Vue/pro.php");
    exit();
}
?>
