<?php

include '../Modèle/bdd.php';

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['identifiant'])) {
    $pseudo = $_SESSION['identifiant'];

    // Récupérez la valeur du thème
    $sql = "SELECT theme FROM utilisateur WHERE pseudo = :pseudo";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(":pseudo", $pseudo);
    $stmt->execute();

    $theme = $stmt->fetch(PDO::FETCH_ASSOC)['theme'];
    
} else {
    $theme = 1;
}

?>
