<?php

session_start();

include '../Modèle/bdd.php';
include '../Modèle/themeClair.php';

// Récupérez l'ID du film depuis l'URL
$film_id = isset($_GET['id_F']) ? $_GET['id_F'] : null;

// Vérifiez si l'ID du film est défini
if ($film_id !== null) {
    // Échappez l'ID pour éviter les attaques par injection SQL
    $film_id = $connexion->quote($film_id);

    // Récupérez les détails du film de la base de données
    $result = $connexion->query("SELECT * FROM films WHERE id_F = $film_id");
    $row = $result->fetch(PDO::FETCH_ASSOC);
} else {
        echo "ID du film non spécifié.";
        exit;
}

include '../Modèle/style_theme.php' ?>

<?php

 if ($theme==0) {?>
<style>
    .container-films {
    color: black;
    }

    body {
        color: black;
    }

    .note h1, .reservation h1 {
        color: black;
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

    .container-films {
    color: white;
    }

    body {
        color: white;
    }

    .note h1, .reservation h1 {
        color: white;
    }
</style>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/details.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Montserrat&display=swap" rel="stylesheet">
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

        <section>
            <div class="container-films">
                <img src="<?= htmlspecialchars($row['affiche'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($row['nom'], ENT_QUOTES, 'UTF-8'); ?>" width="200" height="300">
                <div class="info">
                    <h1><?= htmlspecialchars($row['nom'], ENT_QUOTES, 'UTF-8'); ?></h1>

                    <p><?= htmlspecialchars($row['genre'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-bottom: 4px;">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <?= htmlspecialchars($row['DateDeSortie'], ENT_QUOTES, 'UTF-8'); ?>,
                        
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-bottom: 3px;">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="6" x2="12" y2="12"/>
                            <line x1="12" y1="12" x2="16" y2="16"/>
                            <line x1="12" y1="12" x2="8" y2="16"/>
                        </svg>
                        <?= htmlspecialchars($row['duree'], ENT_QUOTES, 'UTF-8'); ?> minutes
                    </p>
                    <p><?= htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                
                    <div class="real"><h3>De :</h3> <?= htmlspecialchars($row['realisateur'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="act"><h3>Avec :</h3> <?= htmlspecialchars($row['acteurs'], ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
            </div>
        </section>

        <section class="note">
            <h1>Note du public :</h1>

            <?php

            // Inclusion de la fonction PHP qui génère le curseur de volume
            include '../Modèle/donnees_film.php';
            include '../Modèle/récupérer_projection.php';

            ?>

            <div class="note-cursor">
                <h2><?php echo $note; ?>/5</h2>
                <span class="valeur-volume"><?php echo $donnees_capteur['moyenne_decibel']; ?> dB</span>
                <input type="range" min="0" max="100" value="<?php echo $donnees_capteur['moyenne_decibel']; ?>" class="curseur-volume" disabled>
            </div>

        </section>

        <section class="reservation">
            <?php

            // Vérifier si l'ID du film est spécifié
            if (isset($_GET['id_F'])) {
                $film_id = isset($_GET['id_F']) ? $_GET['id_F'] : null;

                // Vérifier s'il y a des projections
            
                echo '<h1>Reservation :</h1>';
                echo '<div class="projections">';

                foreach ($projections as $projection) {
                    $projection_id = $projection['id_Projection'];
                    $horaire = $projection['heure'];
                    $date = new DateTime($projection['date']);
                
                    // Définir les noms des jours et des mois en français
                    $jours = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
                    $mois = [null, 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
                
                    // Formatage de la date en français
                    $formatted_date = $jours[$date->format('w')] . ' ' . $date->format('j') . ' ' . $mois[$date->format('n')] . ' ' . $date->format('Y');
                
                    echo '<div class="proj">';
                    if ($estConnecte) {
                    echo "<a href='billet.php?id_Projection=$projection_id'><h3>$formatted_date :</h3><br><br><h2>$horaire</h2></a>";
                    } else {
                        echo "<a href='connexion.php'><h3>$formatted_date :</h3><br><br><h2>$horaire</h2></a>";
                    }
                    echo '</div>';
                }
            }
            ?>
        </section>
        
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