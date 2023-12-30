<?php
// Inclure le fichier de connexion à la base de données
include '../Modèle/bdd.php';

// Vérifier si l'ID du film est présent dans l'URL
if (isset($_GET['id_F'])) {
    $id_F = $_GET['id_F'];

    // Requête pour récupérer les projections liées à l'ID du film
    $stmt = $connexion->prepare("SELECT * FROM projection WHERE films_salle_films_id_F = :id_F");
    $stmt->bindParam(':id_F', $id_F);
    $stmt->execute();
    
    // Récupérer les résultats sous forme de tableau associatif
    $projections = $stmt->fetchAll(PDO::FETCH_ASSOC);

} else {
    // Gérer le cas où l'ID du film n'est pas présent dans l'URL
    echo "Erreur : ID du film non spécifié.";
}
?>
