<?php

function getSalleData($db, $nomSalle) {

    $stmt_salle = $db->prepare("SELECT * FROM salle WHERE nom_salle = :nom_salle");
    $stmt_salle->bindParam(':nom_salle', $nomSalle);
    $stmt_salle->execute();

    $salleData = $stmt_salle->fetch(PDO::FETCH_ASSOC);

    return $salleData;
}

function ajouterSalle($db, $nomSalle, $capaciteSalle, $equipementSalle, $typeSalle) {

    $typeStr = implode(", ", $typeSalle);

    $sql = "INSERT INTO salle (nom_salle, capacite_salle, equipement_salle, type) VALUES (:nom_salle, :capacite_salle, :equipement_salle, :type)";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':nom_salle', $nomSalle);
    $stmt->bindParam(':capacite_salle', $capaciteSalle);
    $stmt->bindParam(':equipement_salle', $equipementSalle);
    $stmt->bindParam(':type', $typeStr);

    $stmt->execute();
}

function supprimerSalle($connexion, $salleId) {

    $sql = "DELETE FROM salle WHERE id_Salle = :salle_id";
    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(':salle_id', $salleId);

    $stmt->execute();
}

function getSallesExceptCafet($connexion) {

    $stmt = $connexion->prepare("SELECT * FROM salle WHERE nom_salle != 'cafet'");
        
    $stmt->execute();

    $salles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $salles;
}

function getSalles($connexion) {
    
    $stmt = $connexion->prepare("SELECT id_Salle, nom_salle FROM salle");
    
    $stmt->execute();

    $salles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $salles;
}

?>