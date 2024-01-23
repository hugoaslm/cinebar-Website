<?php

session_start();

include '../Modèle/bdd.php';
include '../Modèle/themeClair.php';
require '../Modèle/eventData.php';

$estConnecte = isset($_SESSION['identifiant']);

$event_id = isset($_GET['id_E']) ? $_GET['id_E'] : null;

$event_details = getEventDetailsById($connexion, $event_id);

// Initialisation des valeurs par défaut
$nom = '';
$prenom = '';
$email = '';
$places = '';

// Recupérer les infos utilisateurs

require "../Modèle/userData.php";

// Si l'utilisateur est connecté, récupérer son email
if ($estConnecte) {
    $infoUtilisateur = info_userConnected($connexion);

    $email = $infoUtilisateur['mail'];
}

include '../Modèle/style_theme.php' ?>

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

                // Vérifier si l'utilisateur est connecté en vérifiant la présence de la variable de session
                $estConnecte = isset($_SESSION['identifiant']);

                // Sélectionner le bouton de connexion en PHP
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
                    // Si non connecté, afficher le bouton de connexion normal
                    $boutonConnexion .= '<a href="../connexion">Connexion</a>';
                }
                $boutonConnexion .= '</div>';

                // Afficher le bouton de connexion généré
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

                $capteurData = getAverageDecibelAndNote($connexion, $event_id);

            ?>

            <div class="note-cursor">
                <h2><?php echo $capteurData["note"]; ?>/5</h2>
                <span class="valeur-volume"><?php echo $capteurData["valeurEnDB"]; ?> dB</span>
                <input type="range" min="0" max="100" value="<?php echo $capteurData["valeurCurseur"]; ?>" class="curseur-volume" disabled>
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
                        <option value="<?php echo $event_details['nom']; ?>"><?php echo $event_details['nom']; ?></option>
                    </select>
                    <label for="places">Nombre de places :</label>
                    <input type="places" id="places" name="places" value="<?php echo $places; ?>">
                    <label for="date">Date :</label>
                    <input type="date" id="date" name="date" value="<?php echo $event_details['date']; ?>" readonly>
                    <label for="horaire">Horaire :</label>
                    <select id="horaire" name="horaires" readonly>
                        <option value="<?php echo $event_details['horaires']; ?>"><?php echo $event_details['horaires']; ?></option>
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
                echo "<div style='text-align: center;'>Veuiller vous connecter ou vous inscrire si vous n'aver pas de compte</div>";
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
            
        <a href="../cgu">CGU</a> -
        <a href="../faq">FAQ</a>
        </div>  
    </footer>

</body>
</html>