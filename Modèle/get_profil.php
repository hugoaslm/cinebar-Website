<?php

include "bdd.php";

// Interroger la base de données pour obtenir la liste de tous les utilisateurs
$query = $connexion->prepare("SELECT * FROM utilisateur WHERE id_Utilisateur = :id_user");
$query->bindParam(':id_user', $userId);
$query->execute();

$utilisateurs = $query->fetch(PDO::FETCH_ASSOC);

?>
