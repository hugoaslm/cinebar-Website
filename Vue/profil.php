<?php
session_start();

$estConnecte = isset($_SESSION['identifiant']);

if (!$estConnecte) {
    header("Location: accueil.php");
    exit();
}

include '../Modèle/bdd.php';
include '../Modèle/themeClair.php';
include '../Modèle/estAdmin.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/user.css">
</head>

<body>

<header>
    <nav>
        <img src="../images/logo-cinebar.png" alt="Logo Cinébar">
        <div class="pages">
            <a href="accueil.php">Accueil</a>
            <a href="cinema.php">Le Cinéma</a>
            <a href="cafet.php">La Cafétéria</a>
            <a href="films.php">Films</a>
            <a href="events.php">Évènements</a>
            <a href="billet.php">Billetterie</a>
            <a href="forum.php">Forum</a>
        </div>
        <div class="bouton-access">
            <form class="container" action="recherche.php" method="POST">
                    <input type="text" placeholder="Rechercher..." name="recherche">
                    <div class="search"></div>
            </form>
            
            <div class="bouton-pro">
                <a href="pro.php">Réservation de salles</a>
            </div>
            <?php

                // Vérifiez si l'utilisateur est connecté en vérifiant la présence de la variable de session
                $estConnecte = isset($_SESSION['identifiant']);

                // Sélectionnez le bouton de connexion en PHP
                $boutonConnexion = '<div class="bouton-co">';
                if ($estConnecte) {
                    $identif = $_SESSION['identifiant'];
                    $boutonConnexion .= '<a href="profil.php"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" 
                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - 
                    https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> '
                      . $identif . ' </a>';
                    $boutonConnexion .= '<div class="menu-deroulant">';
                    $boutonConnexion .= '<a href="../Contrôleur/deconnexion.php">Se déconnecter</a>';
                    $boutonConnexion .= '</div>';
                } else {
                    // Si non connecté, affichez le bouton de connexion normal
                    $boutonConnexion .= '<a href="connexion.php">Connexion</a>';
                }
                $boutonConnexion .= '</div>';

                // Affichez le bouton de connexion généré
                echo $boutonConnexion;
            ?>
        </div>
    </nav>
</header>

<main class="profil">

    <?php 
    $bodyClass = ($theme == 0) ? 'light-mode' : 'dark-mode';
    echo '<script>document.body.classList.add("' . $bodyClass . '");</script>';
    ?>

    <h1>Bienvenue <span class="mot_cle"><?php echo $identifiant; ?> </span> !</h1>

    <?php
    if ($estAdmin) :
    ?>
        <section class="profil-options">
            <h2>Options d'administration :</h2>
            <p>Choisissez une option :</p>
            <ul>
                <li><a class="profil-link" href="dashboard_user.php">Gestion du Compte</a></li>
                <li><a class="profil-link" href="dashboard_admin.php">Interface d'Administration</a></li>
            </ul>
        </section>
    <?php
    else:
        header("Location: dashboard_user.php");
        exit;
    endif;
    ?>

</main>

<footer>
    <section class='logo-adresse'>
        <img src="../images/logo-cinebar.png" alt="Logo Cinébar">
        <div>
            <h3>Adresse :</h3>
            Place Darcy <br>
            <a>21000 - Dijon</a>
        </div>
    </section>
    <div class="donnees">
        <a href="cookies.php">Gestion des cookies</a> -
        <a href="cgu.php">CGU</a> -
        <a href="faq.php">FAQ</a>
    </div>
</footer>

</body>

</html>


