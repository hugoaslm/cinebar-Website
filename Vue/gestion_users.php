<?php
session_start();

include '../Modèle/estAdmin.php';

if (!$estAdmin) {
    header("Location: accueil");
    exit();
}

include '../Modèle/bdd.php';

include '../Modèle/style_theme.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Films à l'affiche">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/pro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Montserrat&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

    <main>
        <p class="intro-text">Bienvenue sur la page d'administration du site Cinébar ! <br> Cette section vous permet de gérer les films,
            événements et salles du cinéma. Utiliser les formulaires ci-dessous pour ajouter, modifier ou supprimer des informations.
            Assurer-vous de saisir correctement les détails pour maintenir la précision de la base de données.</p>

        <section class="admin-section">
            <h1>Gestion des utilisateurs</h1>

            <?php require '../Modèle/userData.php'; 

            $utilisateurs = getAllUtilisateurs($connexion)

            ?>

            <table id="table-utilisateurs">
                <thead>
                    <tr>
                        <th>ID Utilisateur</th>
                        <th>Pseudo</th>
                        <th>Rôle</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($utilisateurs as $utilisateur) {
                        echo '<tr>';
                        echo '<td>' . $utilisateur['id_Utilisateur'] . '</td>';
                        echo '<td>' . $utilisateur['pseudo'] . '</td>';
                        echo '<td id="role-' . $utilisateur['id_Utilisateur'] . '">' . $utilisateur['admin'] . '</td>';
                        echo '<td><a href="utilisateur/' . $utilisateur['id_Utilisateur'] . '">Modifier</a>  <a href="#" onclick="confirmerSuppression(' . $utilisateur['id_Utilisateur'] . ');">Supprimer</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <script>
            function confirmerSuppression(id) {
                var confirmation = confirm("Êtes-vous sûr de vouloir supprimer ce compte ?");
                if (confirmation) {
                    window.location.href = "Contrôleur/supprimer_compte.php?id=" + id;
                }
            }
        </script>

        
    </main>

    <footer>
        <section class='logo-adresse'>
            <img src="images/logo-cinebar.png" alt="Logo Cinébar">
            <div>
                <h3>Adresse :</h3>
                <p>8 Prom. Coeur de Ville</p>
                <a>92130- Issy-les-Moulineaux</a>
            </div>
        </section>
        <div class="donnees">
            
            <a href="cgu">CGU</a> -
            <a href="faq">FAQ</a>
        </div>
    </footer>
</body>

</html>
