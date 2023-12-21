<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_salle = $_POST["nom_salle"];
    $capacite_salle = $_POST["capacite_salle"];
    $equipement_salle = $_POST["equipement_salle"];

    // Ajouter la salle à la base de données
    $serveur = 'localhost'; 
    $utilisateur_db = 'root'; 
    $mot_de_passe_db = 'bddisep19'; 
    $nom_base_de_donnees = 'cinebar'; 

    try {
        // Créer une connexion PDO
        $conn = new PDO("mysql:host=$serveur;dbname=$nom_base_de_donnees", $utilisateur_db, $mot_de_passe_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Définir le mode d'erreur PDO à exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête SQL
        $sql = "INSERT INTO salle (nom_salle, capacite_salle, equipement_salle) VALUES (:nom_salle, :capacite_salle, :equipement_salle)";
        $stmt = $conn->prepare($sql);

        // Binder les valeurs
        $stmt->bindParam(':nom_salle', $nom_salle);
        $stmt->bindParam(':capacite_salle', $capacite_salle);
        $stmt->bindParam(':equipement_salle', $equipement_salle);

        // Exécuter la requête
        $stmt->execute();

        header("Location: pro.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de la salle : " . $e->getMessage();
    }

    // Fermer la connexion
    $conn = null;
}
?>

