<?php
session_start();

// Incluez le fichier de connexion à la base de données
include "../Modèle/bdd.php";

$id_user = $_GET['id'];

// Vérifiez si les champs email et pseudo existent dans $_POST
$email = isset($_POST['mail']) ? $_POST['mail'] : null;
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : null;
$admin = isset($_POST['role']) ? $_POST['role'] : null;

// Vérifiez si le champ themeToggle existe dans $_POST
$themeToggle = isset($_POST['themeToggle']) ? 1 : 0; // Convertissez la valeur en un entier 0 ou 1

// Construisez la requête en fonction des champs non null
$query = "UPDATE utilisateur SET theme = :themeToggle";
if ($email !== '') {
    $query .= ", mail = :email";
}
if ($pseudo !== '') {
    $query .= ", pseudo = :pseudo";
}
if ($pseudo !== '') {
    $query .= ", admin = :admin";
}
$query .= " WHERE id_Utilisateur = :user_id";

$stmt = $connexion->prepare($query);

// Liez les paramètres conditionnels
if ($email !== '') {
    $stmt->bindParam(':email', $email);
}
if ($pseudo !== '') {
    $stmt->bindParam(':pseudo', $pseudo);
}
if ($admin !== '') {
    $stmt->bindParam(':admin', $admin);
}
$stmt->bindParam(':themeToggle', $themeToggle);
$stmt->bindParam(':user_id', $id_user);

$result = $stmt->execute();

// Vérifiez si la mise à jour a réussi
if ($result) {
    header("Location: ../Vue/accueil.php");
    exit();
} else {
    echo "Erreur lors de la mise à jour.";
}
?>
