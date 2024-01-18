<?php
session_start();

$estConnecte = isset($_SESSION['identifiant']);

if (!$estConnecte) {
    header("Location: accueil");
    exit();
}

include '../Modèle/bdd.php';
include '../Modèle/themeClair.php';
include '../Modèle/estAdmin.php';

include '../Modèle/style_theme.php' ?>

<?php

 if ($theme==0) {?>
<style>
    body {
        color: black;
    }

    .profil-options {
        border: solid 1px black;
    }
</style>
<?php } ?>

<?php if ($theme==1) {?>
<style>

    body {
    background-color: #1E1E1E;
    color: white;
    }

    footer, header {
    background-color: rgb(17, 17, 17);
    }

    .profil-options {
        border: solid 1px white;
    }
</style>
<?php } ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Films à l'affiche">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/user.css">
</head>

<body>

<header>
    <nav>
        <img src="images/logo-cinebar.png" alt="Logo Cinébar">
        <div class="pages">
            <a href="accueil">Accueil</a>
            <a href="cinema">Le Cinéma</a>
            <a href="cafet">La Cafétéria</a>
            <a href="films">Films</a>
            <a href="events">Évènements</a>
            <a href="forum">Forum</a>
        </div>
        <div class="bouton-access">
            <form class="container" action="recherche" method="POST">
                    <input type="text" placeholder="Rechercher..." name="recherche">
                    <div class="search"></div>
            </form>
            
            <div class="bouton-pro">
                <a href="pro">Réservation de salles</a>
            </div>
            <?php

                // Vérifier si l'utilisateur est connecté en vérifiant la présence de la variable de session
                $estConnecte = isset($_SESSION['identifiant']);

                // Sélectionner le bouton de connexion en PHP
                $boutonConnexion = '<div class="bouton-co">';
                if ($estConnecte) {
                    $identif = $_SESSION['identifiant'];
                    $boutonConnexion .= '<a href="profil"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" 
                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - 
                    https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> '
                      . $identif . ' </a>';
                    $boutonConnexion .= '<div class="menu-deroulant">';
                    $boutonConnexion .= '<a href="Contrôleur/deconnexion.php">Se déconnecter</a>';
                    $boutonConnexion .= '</div>';
                } else {
                    // Si non connecté, afficher le bouton de connexion normal
                    $boutonConnexion .= '<a href="connexion">Connexion</a>';
                }
                $boutonConnexion .= '</div>';

                // Afficher le bouton de connexion généré
                echo $boutonConnexion;
            ?>
        </div>
    </nav>
</header>

<main class="profil">

    <h1>Bienvenue <span class="mot_cle"><?php echo $identifiant; ?> </span> !</h1>

    <?php
    if ($estAdmin) :
    ?>
        <section class="profil-options">
            <h2>Options d'administration :</h2>
            <p>Choisisser une option :</p>
            <ul class="list">
                <li><a class="profil-link" href="dashboard_user">Gestion du Compte</a></li>
                <li><a class="profil-link" href="dashboard_admin">Interface d'Administration</a></li>
            </ul>
        </section>
    <?php
    else:
        header("Location: dashboard_user");
        exit;
    endif;
    ?>

</main>

<footer>
    <section class='logo-adresse'>
        <img src="images/logo-cinebar.png" alt="Logo Cinébar">
        <div>
            <h3>Adresse :</h3>
            Place Darcy <br>
            <a>21000 - Dijon</a>
        </div>
    </section>
    <div class="donnees">
        <a href="cookies">Gestion des cookies</a> -
        <a href="cgu">CGU</a> -
        <a href="faq">FAQ</a>
    </div>
</footer>

</body>

</html>


