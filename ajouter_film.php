<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["titre_film"];
    $genre = $_POST["genre_film"];
    $acteurs = $_POST["acteurs_film"];
    $description = $_POST["desc_film"];
    $DateDeSortie = $_POST["date_film"];
    $duree = $_POST["duree_film"];
    $realisateur = $_POST["realisateur_film"];
    $affiche = $_POST["affiche_film"];

    // Ajouter le film à la base de données
    $serveur = 'localhost'; 
    $utilisateur_db = 'root'; 
    $mot_de_passe_db = 'bddisep19'; 
    $nom_base_de_donnees = 'cinebar'; 

    try {
        // Créer une connexion PDO
        $conn = new PDO("mysql:host=$serveur;dbname=$nom_base_de_donnees", $utilisateur_db, $mot_de_passe_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête SQL
        $sql = "INSERT INTO films (nom, genre, acteurs, description, DateDeSortie, duree, realisateur, affiche) VALUES (:nom, :genre, :acteurs, :description, :DateDeSortie, :duree, :realisateur, :affiche)";
        $stmt = $conn->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':acteurs', $acteurs);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':DateDeSortie', $DateDeSortie);
        $stmt->bindParam(':duree', $duree);
        $stmt->bindParam(':realisateur', $realisateur);
        $stmt->bindParam(':affiche', $affiche);

        // Exécution de la requête
        $stmt->execute();

        header("Location: films.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }

    // Fermer la connexion
    $conn = null;
}
?>

