<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $film_id = $_POST["film_id"];

    include '../Modèle/bdd.php';

    // Supprimer l'ancien film du moment s'il existe
    $sql_delete = "DELETE FROM film_moment";
    $connexion->exec($sql_delete);

    // Insérer le nouveau film du moment
    $sql_insert = "INSERT INTO film_moment (film_id_F) VALUES (:film_id)";
    $stmt_insert = $connexion->prepare($sql_insert);
    $stmt_insert->bindParam(":film_id", $film_id);
    $stmt_insert->execute();

    header("Location: ../Vue/films.php");
    exit();
}
?>
