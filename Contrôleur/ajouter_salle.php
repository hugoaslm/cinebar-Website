<?php

include '../Modèle/bdd.php';
require_once '../Modèle/salleData.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_salle = $_POST["nom_salle"];
    $capacite_salle = $_POST["capacite_salle"];
    $equipement_salle = $_POST["equipement_salle"];
    
    // Traitement du champ "type"
    $type = isset($_POST["type_salle"]) ? $_POST["type_salle"] : [];
    
    ajouterSalle($connexion, $nom_salle, $capacite_salle, $equipement_salle, $type);

    header("Location: ../pro");
    exit();

    // Fermer la connexion
    $connexion = null;
}
?>

