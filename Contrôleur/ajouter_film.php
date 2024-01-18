<?php

include '../Modèle/bdd.php';
require_once '../Modèle/filmData.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["titre_film"];
    $acteurs = $_POST["acteurs_film"];
    $description = $_POST["desc_film"];
    $DateDeSortie = $_POST["date_film"];
    $duree = $_POST["duree_film"];
    $realisateur = $_POST["realisateur_film"];
    $affiche = "images/" . basename($_POST["affiche_film"]);

    // Traitement du champ "Genres"
    $genres = isset($_POST["genre_film"]) ? $_POST["genre_film"] : [];
    $genre_str = implode(", ", $genres);

    $addFilmSuccess = addFilm($connexion, $nom, $acteurs, $description, $DateDeSortie, $duree, $realisateur, $affiche, $genres);

    header("Location: ../films");
    exit();

    // Fermer la connexion
    $connexion = null;
}

?>
