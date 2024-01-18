<?php

// Fonction pour mettre à jour les CGU
function mettreAJourCGU($connexion, $nouveauContenu) {

    $sql = "UPDATE cgu SET contenu = :content";
    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(':content', $nouveauContenu);

    $stmt->execute();
}

function getCGU($connexion) {

    $sql = "SELECT * FROM cgu ORDER BY date DESC LIMIT 1";
    $stmt = $connexion->query($sql);

    if ($stmt) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}

?>