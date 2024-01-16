<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $question = $_POST["question"];
    $reponse = $_POST["reponse"];

    include '../Modèle/bdd.php';

    // Préparer la requête SQL
    $sql = "INSERT INTO faq (question, reponse) VALUES (:quest, :resp)";
    $stmt = $connexion->prepare($sql);

    // Binder les valeurs
    $stmt->bindParam(':resp', $reponse);
    $stmt->bindParam(':quest', $question);

    // Exécuter la requête
    $stmt->execute();

    header("Location: ../Vue/faq.php");
    exit();

    // Fermer la connexion
    $connexion = null;
}
?>

