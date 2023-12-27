<?php
session_start();

// Détruire toutes les données de session
session_destroy();

// Rediriger vers la page de connexion
header("Location: ../Vue/accueil.php");
exit();
?>
