<?php 

session_start();

include '../Modèle/bdd.php';
require '../Modèle/filmData.php';
include '../Modèle/themeClair.php';

$filmIdMoment = getFilmMomentId($connexion);

$film = getFilmDetailsById($connexion, $filmIdMoment);

include "../Modèle/film_moment_default.php"

?>

<!DOCTYPE html>
<html lang="en">


<?php include '../Modèle/style_theme.php';
?>
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Films à l'affiche">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/accueil.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-bi+2BIvPHs5peU+5wDTrAYu9fEF+j4uANCBF8bXaSv1ap4SC1vY+gJEAY6npa9vm4tft9NxLXR+rWn5eknjOXA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Montserrat&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700;800;900&family=Paytone+One&display=swap" rel="stylesheet">
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

        <section class="acc-img">
            <div class="haut-cine">
                <div class="vignette-film">
                    <h1><?= htmlspecialchars($film['nom'], ENT_QUOTES, 'UTF-8'); ?></h1>

                    <p><?= htmlspecialchars($film['genre'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-bottom: 4px;">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <?= htmlspecialchars($film['DateDeSortie'], ENT_QUOTES, 'UTF-8'); ?>,
                        
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-bottom: 3px;">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="6" x2="12" y2="12"/>
                            <line x1="12" y1="12" x2="16" y2="16"/>
                            <line x1="12" y1="12" x2="8" y2="16"/>
                        </svg>
                        <?= htmlspecialchars($film['duree'], ENT_QUOTES, 'UTF-8'); ?> minutes
                    </p>

                    <p><?= htmlspecialchars($film['description'], ENT_QUOTES, 'UTF-8'); ?></p>

                    <h2>Note du public :</h2>

                    <div class="rating">
                        <input type="radio" id="star5" name="rating" value="5">
                        <label for="star5"></label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4"></label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3"></label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2"></label>
                        <input type="radio" id="star1" name="rating" value="1">
                        <label for="star1"></label>
                    </div>

                </div>
                <img src="<?= htmlspecialchars($film['affiche_large'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($film['nom'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>
        </section>
        <section class='accueil-cine'>
            <div class="acc-cine">
                <h1>Une Expérience Unique </h1>
                <p>
                    Viver une expérience cinématographique immersive où vos émotions façonnent l'expérience. Les réactions du public sont instantanément partagées sur le site du film, créant une connexion unique entre l'histoire à l'écran et le public en salle.
                </p>
            </div>
            <div class="img-container">
                <img src="images/pexels-linda-gschwentner-11718584.jpg" alt="cinema">
            </div>
        </section>

        <section class='accueil-bar'>
            <div class="img-bar">
                <img src="images/pexels-cottonbro-studio-8261819.png" alt="bar">
            </div>
            <div class="acc-bar">
                <h1>La cafétéria</h1>
                <p>
                    Les discussions animées sur la séance précédente ajoutent une dimension sociale unique, 
                    créant un lieu où les cinéphiles se retrouvent pour partager leurs réactions et prolonger 
                    l'expérience au-delà de l'écran.
                </p>
            </div>
        </section>



        <section class="boite3">

            <?php
            if ($film !== null) {
                $affiche = $film['affiche'];
            
                // Afficher l'image du film du moment
                echo '<div class="titre-boite3">';
                echo '<h1>Le film du moment</h1>';
                echo '<img src="' . $affiche . '" alt="new_film">';
                echo '<a href="films">Aller voir</a>';
                echo '</div>';
            } else {
                echo 'Détails du film du moment non trouvés.';
            }
            ?>

            <?php
            $latestReleaseId = getLatestReleaseId($connexion);

            // Vérifier si l'ID du dernier film sorti a été récupéré avec succès
            if ($latestReleaseId !== null) {
                // Appeler la fonction pour récupérer les détails du film associé à l'ID
                $latestReleaseDetails = getFilmDetailsById($connexion, $latestReleaseId);
            
                // Vérifier si les détails du dernier film sorti ont été récupérés avec succès
                if ($latestReleaseDetails !== null) {
                    $afficheLatestRelease = $latestReleaseDetails['affiche'];
            
                    // Afficher l'image du dernier film sorti
                    echo '<div class="titre-boite3">';
                    echo '<h1>La dernière sortie</h1>';
                    echo '<img src="' . $afficheLatestRelease . '" alt="new_film">';
                    echo '<a href="films">Aller voir</a>';
                    echo '</div>';
                } else {
                    echo 'Détails de la dernière sortie non trouvés.';
                }
            } else {
                echo 'Dernière sortie non trouvée.';
            }
            ?>

        </section>
        
        
        <section class="carrousel">
            
            <?php $films = getAllFilms($connexion); ?>

            <<div class="carousel-container">
                <h1>À l'affiche au cinéma :</h1>
                <div class="arrow arrow-prev" onclick="prevSlide()">&#9664;</div>
                <div class="img-carrousel">
                    <?php
                    // Boucle à travers les films pour afficher chaque image
                    foreach ($films as $film) {
                        echo '<img src="' . $film['affiche'] . '" alt="' . $film['nom'] . '">';
                    }
                    ?>
            </div>
            <div class="arrow arrow-next" onclick="nextSlide()">&#9654;</div>
            <div class="arrow arrow-prev" onclick="prevSlide()">&#9664;</div>
                
        </section>


    </main>

    <script src="js/script.js"></script>

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
    
    <script src="Vue/js/carousel.js"></script>

</body>
</html>