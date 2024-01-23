<?php

include '../Modèle/bdd.php';
require_once '../Modèle/filmData.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $proj_id = $_POST["id_proj"];

    $deleteProjection = deleteProjection($connexion, $proj_id);

    header("Location: ../films");
    exit();
}
?>
