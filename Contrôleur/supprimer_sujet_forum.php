<?php

include '../Modèle/bdd.php';

require_once '../Modèle/forumData.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $sujetId = $_POST["sujet_id"];
    
    supprimerForum($connexion, $sujetId);

    header("Location: ../forum");
    exit();
}
?>
