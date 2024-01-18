<?php
session_start();

include "../Modèle/bdd.php";

require_once "../Modèle/userData.php";

$idUtilisateur = $_GET['id'];

$email = isset($_POST['mail']) ? $_POST['mail'] : null;
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : null;
$admin = isset($_POST['role']) ? $_POST['role'] : null;

$themeToggle = isset($_POST['themeToggle']) ? 1 : 0;

$result = modifierCompteUser($connexion, $idUtilisateur, $email, $pseudo, $admin, $themeToggle);

if ($result) {
    header("Location: ../gestion_users");
    exit();
} else {
    echo "Erreur lors de la mise à jour.";
}
?>
