<?php
session_start();

require_once "../Modèle/eventData.php";
include "../Modèle/bdd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["mail"];
    $event = $_POST["event"];
    $nb = $_POST["places"];
    $horaires = $_POST["horaires"];
    $date = $_POST['date'];

    reserverEvent($connexion, $nom, $prenom, $email, $event, $nb, $horaires, $date);

    header("Location: ../billet-confirm");
    exit();

    // Fermer la connexion
    $connexion = null;
}

?>