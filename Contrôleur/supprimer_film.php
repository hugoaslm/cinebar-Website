<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $film_id = $_POST["film_id"];

    include '../Modèle/bdd.php';

    // Insérer le nouveau film du moment
    $sql_insert = "DELETE FROM films WHERE id_F = :film_id";
    $stmt_insert = $connexion->prepare($sql_insert);
    $stmt_insert->bindParam(":film_id", $film_id);
    $stmt_insert->execute();

    header("Location: ../films");
    exit();
}
?>
