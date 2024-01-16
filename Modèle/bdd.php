<?php

// Informations de connexion à la base de données
$serveur = 'localhost';
$utilisateur_db = 'root';
$mot_de_passe_db = 'bddisep19';
$nom_base_de_donnees = 'cinebar';

// Une requête préparée permet d'exécuter la même requête plusieurs fois et protège des injections SQL.

// Deux étapes : la préparation et l'exécution
// Lors de la préparation, un template de requête est envoyé au serveur de base de données. 
// Le serveur initialise les ressources internes du serveur pour une utilisation ultérieure.
// Pendant l'exécution, le client lie les valeurs des paramètres et les envoie au serveur.

// La requête ne doit être analysée (ou préparée) qu'une seule fois, mais peut être exécutée plusieurs fois.

// Les variables liées sont envoyées au serveur séparément de la requête.
// Les paramètres liés n'ont pas besoin d'être échappés sachant qu'ils ne sont jamais placés dans la chaîne de requête directement.

// Connexion à la base de données
try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$nom_base_de_donnees", $utilisateur_db, $mot_de_passe_db);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}
?>


