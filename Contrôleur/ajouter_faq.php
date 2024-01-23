<?php

include '../Modèle/bdd.php';

require_once '../Modèle/faqData.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nouvelleQuestionFAQ = $_POST["question"];
    $nouvelleReponseFAQ = $_POST["reponse"];

    ajouterFAQ($connexion, $nouvelleQuestionFAQ, $nouvelleReponseFAQ);

    header("Location: ../faq");
    exit();

    // Fermer la connexion
    $connexion = null;
}
?>

