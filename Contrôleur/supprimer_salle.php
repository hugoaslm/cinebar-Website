<?php

include '../Modèle/bdd.php';
require_once '../Modèle/salleData.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $salle_id = $_POST["salle_id"];

    supprimerSalle($connexion, $salle_id);

    header("Location: ../pro");
    exit();
}
?>
