<?php

include '../Modèle/bdd.php';
require_once '../Modèle/eventData.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST["titre_event"];
    $description = $_POST["desc_event"];
    $date = $_POST["date_event"];
    $organisateur = $_POST["orga_event"];
    $affiche = "images/" . basename($_POST["affiche_event"]);
    $salle = $_POST["salle_event"];
    $horaires = $_POST['hor_event'];

    $id_event = addEvent($connexion, $nom, $description, $date, $organisateur, $affiche, $salle, $horaires);

    header("Location: ../events");
    exit();

    $connexion = null;
}
?>

