<?php

include '../Modèle/bdd.php';

require_once '../Modèle/faqData.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $faqId = $_POST["faq_id"];

    // Appeler la fonction pour supprimer la question-réponse de la FAQ
    supprimerFAQ($connexion, $faqId);

    header("Location: ../faq");
    exit();
}
?>
