<?php

function ajouterFAQ($connexion, $nouvelleQuestion, $nouvelleReponse) {

    $sql = "INSERT INTO faq (question, reponse) VALUES (:quest, :resp)";
    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(':resp', $nouvelleReponse);
    $stmt->bindParam(':quest', $nouvelleQuestion);

    $stmt->execute();
}

function supprimerFAQ($connexion, $faqId) {

    $sql = "DELETE FROM faq WHERE id_FAQ = :id_faq";
    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(":id_faq", $faqId);

    $stmt->execute();
}

?>
