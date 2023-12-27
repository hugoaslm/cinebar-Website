<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["titre_film"];
    $genre = $_POST["genre_film"];
    $acteurs = $_POST["acteurs_film"];
    $description = $_POST["desc_film"];
    $DateDeSortie = $_POST["date_film"];
    $duree = $_POST["duree_film"];
    $realisateur = $_POST["realisateur_film"];
    $affiche = "../images/" . basename($_POST["affiche_film"]);

    include '../Modèle/bdd.php';

    // Préparer la requête SQL
    $sql = "INSERT INTO films (nom, genre, acteurs, description, DateDeSortie, duree, realisateur, affiche) VALUES (:nom, :genre, :acteurs, :description, :DateDeSortie, :duree, :realisateur, :affiche)";
    $stmt = $connexion->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':acteurs', $acteurs);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':DateDeSortie', $DateDeSortie);
    $stmt->bindParam(':duree', $duree);
    $stmt->bindParam(':realisateur', $realisateur);
    $stmt->bindParam(':affiche', $affiche);

    // Exécution de la requête
    $stmt->execute();

    header("Location: ../Vue/films.php");
    exit();

    // Fermer la connexion
    $connexion = null;
}
?>

