<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $film_id = $_POST["film_id"];

    $serveur = 'localhost';
    $utilisateur_db = 'root';
    $mot_de_passe_db = 'bddisep19';
    $nom_base_de_donnees = 'cinebar';

    try {
        $conn = new PDO("mysql:host=$serveur;dbname=$nom_base_de_donnees", $utilisateur_db, $mot_de_passe_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Supprimer l'ancien film du moment s'il existe
        $sql_delete = "DELETE FROM film_moment";
        $conn->exec($sql_delete);

        // Insérer le nouveau film du moment
        $sql_insert = "INSERT INTO film_moment (film_id_F) VALUES (:film_id)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bindParam(":film_id", $film_id);
        $stmt_insert->execute();

        header("Location: films.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}
?>
