<?php

include '../Modèle/bdd.php';
require_once '../Modèle/eventData.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST["event_id"];

    setEventMoment($connexion, $event_id);

    header("Location: ../events");
    exit();
}

?>
