<?php

// Fonction pour mettre à jour les CGU
function mettreAJourCGU($connexion, $nouveauContenu) {

    $sql = "UPDATE cgu SET contenu = :content";
    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(':content', $nouveauContenu);

    $stmt->execute();
}

?>