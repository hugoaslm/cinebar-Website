<?php

include "bdd.php";

// Interroger la base de données pour obtenir la liste de tous les utilisateurs
$query = "SELECT * FROM utilisateur";
$stmt = $connexion->query($query);
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
