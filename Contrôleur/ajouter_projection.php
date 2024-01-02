<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $idSalle = $_POST["salle_proj"];
    $idFilm = $_POST["film_proj"];
    $horaire = $_POST["horaire"];
    $dateProjection = $_POST["date_proj"];

    include '../Modèle/bdd.php';

    // Préparer la requête SQL
    $sql = "INSERT INTO projection (films_salle_salle_id_Salle, films_salle_films_id_F, heure, date) VALUES (:idSalle, :idFilm, :horaire, :dateProjection)";
    $stmt = $connexion->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':idSalle', $idSalle);
    $stmt->bindParam(':idFilm', $idFilm);
    $stmt->bindParam(':horaire', $horaire);
    $stmt->bindParam(':dateProjection', $dateProjection);

    // Exécution de la requête
    $stmt->execute();

    // Redirection vers la page des films après l'ajout
    header("Location: ../Vue/films.php");
    exit();
}
?>
