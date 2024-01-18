<?php

# Gestion redirection
session_start();

$estConnecte = isset($_SESSION['identifiant']);

if (!$estConnecte) {
    header("Location: ../accueil");
    exit();
}

include "../Modèle/bdd.php";

require_once "../Modèle/userData.php";

$email = isset($_POST['mail']) ? $_POST['mail'] : null;
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : null;

$themeToggle = isset($_POST['themeToggle']) ? 1 : 0;

$identifiant = $_SESSION['identifiant'];

$result = modifierProfil($connexion, $identifiant, $email, $pseudo, $themeToggle);

if ($result) {
    if ($pseudo !== '') {
        $_SESSION['identifiant'] = $pseudo;
    }

    header("Location: ../accueil");
    exit();
} else {
    echo "Erreur lors de la mise à jour.";
}
?>
