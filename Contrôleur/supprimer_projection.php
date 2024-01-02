<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $proj_id = $_POST["id_proj"];

    include '../Modèle/bdd.php';

    // Insérer le nouveau film du moment
    $sql_delete = "DELETE FROM projection WHERE id_Projection = :proj_id";
    $stmt_delete = $connexion->prepare($sql_delete);
    $stmt_delete->bindParam(":proj_id", $proj_id);
    $stmt_delete->execute();

    header("Location: ../Vue/films.php");
    exit();
}
?>
