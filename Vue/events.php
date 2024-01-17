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

    .event a {
        color: white;
    }

    .vedette {
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

    .details {
        color: white;
    }

    .cast p {
        color: white;
    }

    .event a {
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
    <meta name="description" content="Evènements à l'affiche">
    <title>Evènements</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/films_events.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Montserrat&display=swap" rel="stylesheet">
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

                // Vérifiez si l'utilisateur est connecté en vérifiant la présence de la variable de session
                $estConnecte = isset($_SESSION['identifiant']);

                // Sélectionnez le bouton de connexion en PHP
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
                    // Si non connecté, affichez le bouton de connexion normal
                    $boutonConnexion .= '<a href="connexion">Connexion</a>';
                }
                $boutonConnexion .= '</div>';

                // Affichez le bouton de connexion généré
                echo $boutonConnexion;
                ?>

            </div>
        </nav>

    </header>

    <main>

        <h1 class="h1_moment">ÉVÈNEMENT DU MOMENT</h1>
        <section class='vedette-section'>
            <?php
            // Récupérer l'ID de l'événement du moment depuis la table event_moment
            $sql = "SELECT event_id_E FROM event_moment";
            $stmt = $connexion->query($sql);

            if ($stmt->rowCount() > 0) {
                $event_id = $stmt->fetch(PDO::FETCH_ASSOC)['event_id_E'];

                // Récupérer les détails de l'événement associé à l'ID
                $sql = "SELECT * FROM events WHERE id_E = :event_id";
                $stmt = $connexion->prepare($sql);
                $stmt->bindParam(":event_id", $event_id);
                $stmt->execute();

                // Vérifier s'il y a des résultats
                if ($stmt->rowCount() > 0) {
                    $event = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Afficher les détails de l'événement
                    echo '<section class="vedette-section">';
                    echo '<div class="vedette">';
                    echo '<div class="illu">';
                    echo '<img src="' . $event['affiche'] . '" alt="' . $event['nom'] . '">';
                    echo '</div>';
                    echo '<div class="details">';
                    echo '<h2>' . $event['nom'] . '</h2>';
                    echo '<p>' . $event['description'] . '</p>';
                    echo '<div>Date de l\'événement: ' . $event['date'] . '</div>';
                    echo '</div>';
                    echo '<div class="cast">';
                    echo '<p>Organisateur: ' . $event['organisateur'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</section>';
                } else {
                    echo 'Événement du moment non trouvé.';
                }
            } else {
                echo 'Événement du moment non trouvé dans event_moment.';
            }
            ?>
        </section>

        <section class="events-en-salle">
            <div class="events-title">
                <h1>ÉVÈNEMENTS À L'AFFICHE</h1>
            </div>
            <div class="events-container">

                <?php
                try {
                    // Préparer la requête SQL
                    $stmt = $connexion->prepare("SELECT * FROM events");

                    // Exécuter la requête
                    $stmt->execute();

                    // Récupérer toutes les lignes résultantes
                    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
                }
                ?>

                <?php foreach ($events as $event) : ?>
                    <div class="event">
                        <a href="event/<?= $event['id_E'] ?>" class="ev">
                            <img src="<?= $event['affiche'] ?>" alt="<?= $event['nom'] ?>">
                            <p><?= $event['organisateur'] ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>
        </section>
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
            <a href="cookies">Gestion des cookies</a> -
            <a href="cgu">CGU</a> -
            <a href="faq">FAQ</a>
        </div>
    </footer>

</body>

</html>
