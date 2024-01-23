<?php

session_start();

require "../Modèle/filmData.php";
require "../Modèle/userData.php";
include "../Modèle/bdd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["mail"];
    $film = $_POST["film"];
    $nb = $_POST["places"];
    $horaire = $_POST["horaire"];
    $date = $_POST['date'];

    $reservationSuccess = reserverFilm($connexion, $nom, $prenom, $email, $film, $nb, $horaire, $date);

    header("Location: ../billet-confirm");
    exit();

    // Fermer la connexion
    $connexion = null;
}
?>
