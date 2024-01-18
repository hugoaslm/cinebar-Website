<?php

session_start();

include '../Modèle/bdd.php';
include '../Modèle/themeClair.php';

include '../Modèle/style_theme.php' ?>

<?php

 if ($theme==0) {?>
<style>
    .details h2, h4, .details p {
    color: white;
    }

    .film-info {
        color: white;
    }

    .film-vedette {
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

    .details h2, h4, .details p {
    color: white;
    }

    .film-info {
        color: white;
    }

    .film-vedette {
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

        // Récupérer l'ID du film sélectionné depuis la table film_moment
        $sql = "SELECT film_id_F FROM film_moment";
        $stmt = $connexion->query($sql);

        if ($stmt->rowCount() > 0) {
            $film_id = $stmt->fetch(PDO::FETCH_ASSOC)['film_id_F'];

            // Récupérer les détails du film associé à l'ID
            $sql = "SELECT * FROM films WHERE id_F = :film_id";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(":film_id", $film_id);
            $stmt->execute();

            // Vérifier s'il y a des résultats
            if ($stmt->rowCount() > 0) {
                $film = $stmt->fetch(PDO::FETCH_ASSOC);

                // Afficher les détails du film
                echo '<h1 class="h1_moment">FILM DU MOMENT</h1>';
                echo '<section class="vedette">';
                echo '<div class="film-vedette">';
                echo '<div class="illu">';
                echo '<img src="' . $film['affiche_large'] . '" alt="' . $film['nom'] . '">';
                echo '</div>';
                echo '<div class="details">';
                echo '<h2>' . $film['nom'] . '</h2>';
                echo '<h4>' . $film['genre'] . '</h4>';
                echo '<p>' . $film['description'] . '</p>';
                echo '<div>Date de sortie: ' . $film['DateDeSortie'] . '</div>';
                echo '<div>Durée: ' . $film['duree'] . ' minutes</div>';
                echo '</div>';
                echo '<div class="cast">';
                echo '<p>Réalisateur: ' . $film['realisateur'] . '</p>';
                echo '<p>Acteurs: ' . $film['acteurs'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</section>';
            } else {
                echo 'Film du moment non trouvé.';
            }
        } else {
            echo 'Film du moment non trouvé dans film_moment.';
        }
        ?>


        <section class="films-en-salle">
            <div class="films-title">
                <h1>FILM EN SALLES</h1>
            </div>
            <div class="films-container">

                <?php
                try {
                    // Préparer la requête SQL
                    $stmt = $connexion->prepare("SELECT * FROM films");
                    
                    // Exécuter la requête
                    $stmt->execute();
                
                    // Récupérer toutes les lignes résultantes
                    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
                }
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
            <a href="cookies">Gestion des cookies</a> - 
            <a href="cgu">CGU</a> - 
            <a href="faq">FAQ</a>
        </div>
    </footer>

</body>
</html>