<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $film_id = $_POST["film_id"];

    include '../Modèle/bdd.php';

    // Insérer le nouveau film du moment
    $sql_insert = "UPDATE film_moment SET film_id_F = :film_id, selection_manuelle = 1";
    $stmt_insert = $connexion->prepare($sql_insert);
    $stmt_insert->bindParam(":film_id", $film_id);
    $stmt_insert->execute();

    header("Location: ../films");
    exit();
}
?>
