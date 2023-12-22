<?php

// Informations de connexion à la base de données
$serveur = 'localhost';
$utilisateur_db = 'root';
$mot_de_passe_db = 'bddisep19';
$nom_base_de_donnees = 'cinebar';

// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=$serveur;dbname=$nom_base_de_donnees", $utilisateur_db, $mot_de_passe_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}
?>
