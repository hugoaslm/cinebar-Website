<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $faq_id = $_POST["faq_id"];

    include '../Modèle/bdd.php';

    // Insérer le nouveau film du moment
    $sql_insert = "DELETE FROM faq WHERE id_FAQ = :id_faq";
    $stmt_insert = $connexion->prepare($sql_insert);
    $stmt_insert->bindParam(":id_faq", $faq_id);
    $stmt_insert->execute();

    header("Location: ../Vue/faq.php");
    exit();
}
?>
