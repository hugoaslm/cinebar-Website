<?php

include '../Modèle/bdd.php';

require_once '../Modèle/cguData.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Récupérer les données du formulaire
    $nouveauContenuCGU = $_POST["cgu"];

    mettreAJourCGU($connexion, $nouveauContenuCGU);

    header("Location: ../cgu");
    exit();

    // Fermer la connexion
    $connexion = null;
}
?>

