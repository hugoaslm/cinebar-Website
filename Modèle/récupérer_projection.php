<?php

include '../Modèle/bdd.php';

if (isset($_GET['id_F'])) {
    $id_F = $_GET['id_F'];

    $stmt = $connexion->prepare("SELECT * FROM projection WHERE films_salle_films_id_F = :id_F");
    $stmt->bindParam(':id_F', $id_F);
    $stmt->execute();
    
    $projections = $stmt->fetchAll(PDO::FETCH_ASSOC);

} else {
    echo "Erreur : ID du film non spécifié.";
}
?>
