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

function getAllFAQ($db) {

    $sql = "SELECT * FROM faq";
    $stmt = $db->query($sql);

    if ($stmt) {

        $faqs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $faqs;
    }
}

function FAQOptions($connexion) {

    $stmt = $connexion->prepare("SELECT id_FAQ, question FROM faq");
    
    $stmt->execute();

    $faq = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $faq;

}

?>
