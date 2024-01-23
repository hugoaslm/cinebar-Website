<?php

include '../Modèle/bdd.php';
require_once '../Modèle/filmData.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $film_id = $_POST["film_id"];

    $update = updateFilmMomentAdmin($connexion, $film_id);

    header("Location: ../films");
    exit();
}
?>
