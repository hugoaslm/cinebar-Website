<?php

include '../Modèle/bdd.php';
require_once '../Modèle/filmData.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $idSalle = $_POST["salle_proj"];
    $idFilm = $_POST["film_proj"];
    $horaire = $_POST["horaire"];
    $dateProjection = $_POST["date_proj"];

    $addProjection = addProjection($connexion, $idSalle, $idFilm, $horaire, $dateProjection);

    // Redirection vers la page des films après l'ajout
    header("Location: ../films");
    exit();
}
?>
