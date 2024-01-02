<?php

session_start();

include '../Modèle/bdd.php';

include '../Modèle/style_theme.php' ?>

<?php

 if ($theme==0) {?>
<style>
    body {
        color: black;
    }

    main a {
        color: white;
    }
</style>
<?php } ?>

<?php if ($theme==1) {?>
<style>

    body {
    background-color: #1E1E1E;
    }

    footer, header {
    background-color: rgb(17, 17, 17);
    }

    main a {
        color: white;
    }

    main h1 {
        color: white;
    }
</style>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/films_events.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        
        <nav>
            
            <img src="../images/logo-cinebar.png" alt="Logo Cinébar" >
            <div class="pages">
                <a href="accueil.php">Accueil</a>
                <a href="cinema.php">Le Cinéma</a>
                <a href="cafet.php">La Cafétéria</a>
                <a href="films.php">Films</a>
                <a href="events.php">Évènements</a>
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

    <main>
        
        <?php

        include "../Contrôleur/traitement_recherche.php";

        echo '<h1>Résultat de votre recherche :</h1>';
        echo '<div class="films-container">';

        // Afficher les résultats des films
        while ($row = $stmt_films->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="film">';
            echo '<a href="details.php?id_F=' . $row['id_F'] . '">';
            echo '<img src="' . $row['affiche'] . '" alt="' . $row['nom'] . '">';
            echo '<p class="film-info">';
            echo '<span>' . $row['nom'] . '</span><br>';
            echo '<span class="small-text">' . $row['genre'] . '</span>';
            echo '</p>';
            echo '</a>';
            echo '</div>';
        }

        echo '</div>';

        echo '<div class="events-container">';

        // Afficher les résultats des événements
        while ($row = $stmt_events->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="event">';
            echo '<a href="desc.php?id_E=' . $row['id_E'] . '" class="ev">';
            echo '<img src="' . $row['affiche'] . '" alt="' . $row['nom'] . '">';
            echo '<p>' . $row['organisateur'] . '</p>';
            echo '</a>';
            echo '</div>';
        }
        
        echo '</div>';

        ?>
    </main>

    <footer>
        <section class='logo-adresse'>
            <img src="../images/logo-cinebar.png" alt="Logo Cinébar" >
            <div>
                <h3>Adresse :</h3>
                <p>8 Prom. Coeur de Ville</p>
                <a>92130- Issy-les-Moulineaux</a>
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