<?php

session_start();

include '../Modèle/bdd.php';
require_once '../Modèle/userData.php';

if (!isset($_SESSION['identifiant'])) {
    header("Location: ../accueil");
    exit();
}

$deleteSelf = deleteSelfUser($connexion, $_SESSION['identifiant']);

unset($_SESSION['identifiant']);
session_destroy();

header("Location: ../accueil");
exit();
?>