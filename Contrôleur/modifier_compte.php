<?php
session_start();

// Vérifiez si l'utilisateur est connecté en vérifiant la présence de la variable de session
$estConnecte = isset($_SESSION['identifiant']);

if (!$estConnecte) {
    header("Location: ../Vue/accueil.php");
    exit();
}

// Incluez le fichier de connexion à la base de données
include "../Modèle/bdd.php";

// Vérifiez si les champs email et pseudo existent dans $_POST
$email = isset($_POST['mail']) ? $_POST['mail'] : null;
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : null;

// Vérifiez si le champ themeToggle existe dans $_POST
$themeToggle = isset($_POST['themeToggle']) ? 1 : 0; // Convertissez la valeur en un entier 0 ou 1

// Récupérez les informations de l'utilisateur
$identifiant = $_SESSION['identifiant'];

// Construisez la requête en fonction des champs non null
$query = "UPDATE utilisateur SET theme = :themeToggle";
if ($email !== '') {
    $query .= ", mail = :email";
}
if ($pseudo !== '') {
    $query .= ", pseudo = :pseudo";
}
$query .= " WHERE pseudo = :identifiant";

$stmt = $connexion->prepare($query);

// Liez les paramètres conditionnels
if ($email !== '') {
    $stmt->bindParam(':email', $email);
}
if ($pseudo !== '') {
    $stmt->bindParam(':pseudo', $pseudo);
}
$stmt->bindParam(':themeToggle', $themeToggle);
$stmt->bindParam(':identifiant', $identifiant);

$result = $stmt->execute();

// Vérifiez si la mise à jour a réussi
if ($result) {
    // Mettez à jour la variable de session si le pseudo a été modifié
    if ($pseudo !== '') {
        $_SESSION['identifiant'] = $pseudo;
    }

    header("Location: ../Vue/accueil.php");
    exit();
} else {
    echo "Erreur lors de la mise à jour.";
}
?>
