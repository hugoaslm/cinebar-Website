<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_salle = $_POST["nom_salle"];
    $capacite_salle = $_POST["capacite_salle"];
    $equipement_salle = $_POST["equipement_salle"];
    
    // Traitement du champ "type"
    $type = isset($_POST["type_salle"]) ? $_POST["type_salle"] : [];
    $type_str = implode(", ", $type);

    include '../Modèle/bdd.php';

    // Préparer la requête SQL
    $sql = "INSERT INTO salle (nom_salle, capacite_salle, equipement_salle, type) VALUES (:nom_salle, :capacite_salle, :equipement_salle, :type)";
    $stmt = $connexion->prepare($sql);

    // Binder les valeurs
    $stmt->bindParam(':nom_salle', $nom_salle);
    $stmt->bindParam(':capacite_salle', $capacite_salle);
    $stmt->bindParam(':equipement_salle', $equipement_salle);
    $stmt->bindParam(':type', $type_str);

    // Exécuter la requête
    $stmt->execute();

    header("Location: ../Vue/pro.php");
    exit();

    // Fermer la connexion
    $connexion = null;
}
?>

