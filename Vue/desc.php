<?php

session_start();

include '../Modèle/bdd.php';
include '../Modèle/themeClair.php';

// Vérifiez si l'utilisateur est connecté
$estConnecte = isset($_SESSION['identifiant']);

$event_id = isset($_GET['id_E']) ? $_GET['id_E'] : null;

// Initialisation les valeurs par défaut
$nom = '';
$prenom = '';
$email = '';
$event = '';
$places = '';
$date = '';
$horaires = '';

// Vérifiez si l'ID de l'event est défini
if ($event_id !== null) {
    $stmt_event = $connexion->prepare("SELECT * FROM events WHERE id_E = :event_id");
    $stmt_event->bindParam(':event_id', $event_id);
    $stmt_event->execute();
    $event_details = $stmt_event->fetch(PDO::FETCH_ASSOC);

    // Si l'event est trouvé, mettez à jour les valeurs par défaut
    if ($event_details) {
        $date = $event_details['date'];
        $horaires = $event_details['horaires'];
        $event = $event_details['nom'];
    }
}

include "../Modèle/infos_utilisateur.php";

// Si l'utilisateur est connecté, récupérez son email
if ($estConnecte) {
    $email = $resultat['mail'];
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

    .reserv-billet select,
    .reserv-billet input {
    border: solid 2px black;
    }
</style>
<?php } ?>

<?php if ($theme==1) {?>
<style>
    .reserv-billet select,
    .reserv-billet input {
    border: none;
    }

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Evènements à l'affiche">
    <title>Evènements</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/desc.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>

    <header>
    <nav>
            <img src="../images/logo-cinebar.png" alt="Logo Cinébar">
            <div class="pages">
                <a href="../accueil">Accueil</a>
                <a href="../cinema">Le Cinéma</a>
                <a href="../cafet">La Cafétéria</a>
                <a href="../films">Films</a>
                <a href="../events">Évènements</a>
                <a href="../forum">Forum</a>
            </div>
            <div class="bouton-access">
                <form class="container" action="../recherche" method="POST">
                    <input type="text" placeholder="Rechercher..." name="recherche">
                    <div class="search"></div>
                </form>

                <div class="bouton-pro">
                    <a href="../pro">Réservation de salles</a>
                </div>

                <?php

                // Vérifiez si l'utilisateur est connecté en vérifiant la présence de la variable de session
                $estConnecte = isset($_SESSION['identifiant']);

                // Sélectionnez le bouton de connexion en PHP
                $boutonConnexion = '<div class="bouton-co">';
                if ($estConnecte) {
                    $identif = $_SESSION['identifiant'];
                    $boutonConnexion .= '<a href="../profil"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" 
                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - 
                    https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> '
                      . $identif . ' </a>';
                    $boutonConnexion .= '<div class="menu-deroulant">';
                    $boutonConnexion .= '<a href="../Contrôleur/deconnexion.php">Se déconnecter</a>';
                    $boutonConnexion .= '</div>';
                } else {
                    // Si non connecté, affichez le bouton de connexion normal
                    $boutonConnexion .= '<a href="../connexion">Connexion</a>';
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
                <img src="../<?= htmlspecialchars($event_details['affiche'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($event_details['nom'], ENT_QUOTES, 'UTF-8'); ?>" width="200" height="300">
                <div class="info">
                    <h1><?= htmlspecialchars($event_details['nom'], ENT_QUOTES, 'UTF-8'); ?></h1>
                    <div class="real"><h3>De :</h3> <?= htmlspecialchars($event_details['organisateur'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <p><?= htmlspecialchars($event_details['description'], ENT_QUOTES, 'UTF-8'); ?></p>

                </div>
            </div>
        </section>

        <section class="note">
            <h1>Note du public :</h1>

            <?php

            // Inclusion de la fonction PHP qui génère le curseur de volume
            include '../Modèle/donnees_event.php';

            ?>

            <div class="note-cursor">
                <h2><?php echo $note; ?>/5</h2>
                <span class="valeur-volume"><?php echo $valeurEnDB; ?> dB</span>
                <input type="range" min="0" max="100" value="<?php echo $valeurCurseur; ?>" class="curseur-volume" disabled>
            </div>

        </section>

            <section class='form_billet'>
                <h1>Réservation :</h1>

                <?php
                    if ($estConnecte) {
                ?>

                <form action="../Contrôleur/traitement_billet_events.php" method="post" class="reserv-billet">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>" >
                    <label for="nom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>">
                    <label for="mail">E-mail :</label>
                    <input type="mail" id="mail" name="mail" value="<?php echo $email; ?>" readonly>
                    <label> Évènement :</label>
                    <select id="movie" name="event" readonly>
                        <option value="<?php echo $event; ?>"><?php echo $event; ?></option>
                    </select>
                    <label for="places">Nombre de places :</label>
                    <input type="places" id="places" name="places" value="<?php echo $places; ?>">
                    <label for="date">Date :</label>
                    <input type="date" id="date" name="date" value="<?php echo $date; ?>" readonly>
                    <label for="horaire">Horaire :</label>
                    <select id="horaire" name="horaires" readonly>
                        <option value="<?php echo $horaires; ?>"><?php echo $horaires; ?></option>
                    </select>
                    <p>
                        <button name="send" type="submit">Réserver</button>
                    </p>
                    <p>
                        <button type="reset">Annuler</button>
                    </p>
                </form>
            </section>
        <?php
            }
            else {
                echo "<div style='text-align: center;'>Veuillez vous connecter ou vous inscrire si vous n'avez pas de compte</div>";
            }
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
            <a href="cookies">Gestion des cookies</a> - 
            <a href="cgu">CGU</a> - 
            <a href="faq">FAQ</a>
        </div>  
    </footer>

</body>
</html>