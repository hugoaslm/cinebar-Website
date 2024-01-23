<?php

session_start();

include '../Modèle/bdd.php';
include '../Modèle/themeClair.php';

require '../Modèle/filmData.php';

include '../Modèle/style_theme.php' ?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Films à l'affiche">
    <title>Films</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/films_events.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        
        <nav>
            
            <img src="images/logo-cinebar.png" alt="Logo Cinébar" >
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

        <?php

        $filmIdMoment = getFilmMomentId($connexion);

        $filmDetails = getFilmDetailsById($connexion, $filmIdMoment);

        if (!empty($filmDetails)) {

            echo '<h1 class="h1_moment">FILM DU MOMENT</h1>';
            echo '<section class="vedette">';
            echo '<div class="film-vedette">';
            echo '<div class="illu">';
            echo '<img src="' . $filmDetails['affiche_large'] . '" alt="' . $filmDetails['nom'] . '">';
            echo '</div>';
            echo '<div class="details">';
            echo '<h2>' . $filmDetails['nom'] . '</h2>';
            echo '<h4>' . $filmDetails['genre'] . '</h4>';
            echo '<p>' . $filmDetails['description'] . '</p>';
            echo '<div>Date de sortie: ' . $filmDetails['DateDeSortie'] . '</div>';
            echo '<div>Durée: ' . $filmDetails['duree'] . ' minutes</div>';
            echo '</div>';
            echo '<div class="cast">';
            echo '<p>Réalisateur: ' . $filmDetails['realisateur'] . '</p>';
            echo '<p>Acteurs: ' . $filmDetails['acteurs'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</section>';
        } else {
            echo 'Film du moment non trouvé.';
        }
        ?>


        <section class="films-en-salle">
            <div class="films-title">
                <h1>FILM EN SALLES</h1>
            </div>
            <div class="films-container">

                <?php
                $films = getAllFilms($connexion);
                ?>

                <?php
                $counter = 0; // Initialiser le compteur

                foreach ($films as $film) :
                    if ($counter < 12) { // Limiter à 12 résultats
                ?>
                        <div class="film">
                            <a href="film/<?= $film['id_F'] ?>">
                                <img src="<?= $film['affiche'] ?>" alt="<?= $film['nom'] ?>">
                                <p class="film-info">
                                    <span><?= $film['nom'] ?></span><br>
                                    <span class="small-text"><?= $film['genre'] ?></span>
                                </p>
                            </a>
                        </div>
                <?php
                    }
                    $counter++; // Incrémenter le compteur
                endforeach;
                ?>

            </div>
        </section>
    </main>

    <footer>
        <section class='logo-adresse'>
            <img src="images/logo-cinebar.png" alt="Logo Cinébar" >
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