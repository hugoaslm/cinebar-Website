<?php
session_start();

include "../Modèle/bdd.php";
require "../Modèle/userData.php";
require "../Modèle/filmData.php";

// Vérifier si l'utilisateur est connecté
$estConnecte = isset($_SESSION['identifiant']);

include '../Modèle/style_theme.php' ?>

<?php

 if ($theme==0) {?>
<style>
    .form_billet h1 {
        color: black;
    }

    .reserv-billet label {
        color: white;
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
</style>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Films à l'affiche">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/billet-events.css">
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

    <main class="billet">
        <?php
        // Récupération de l'ID de la projection à partir de l'URL
        $projection_id = isset($_GET['id_Projection']) ? $_GET['id_Projection'] : null;

        $defaultValues = getReservationChamps($connexion, $projection_id);

        $nom = '';
        $prenom = $defaultValues['prenom'];
        $email = $defaultValues['email'];
        $nom_film = $defaultValues['nom'];
        $places = $defaultValues['places'];
        $date = $defaultValues['date'];
        $horaire = $defaultValues['horaire'];

        // Si l'utilisateur est connecté, récupérer son email
        if ($estConnecte) {
            $infoUtilisateur = info_userConnected($connexion);

            $email = $infoUtilisateur['mail'];
        }
        ?>

        <section class='form_billet'>
            <h1>Réservation :</h1>
            <form action="Contrôleur/traitement_billet_films.php" method="post" class="reserv-billet">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>" >
                <label for="nom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>">
                <label for="mail">E-mail :</label>
                <input type="mail" id="mail" name="mail" value="<?php echo $email; ?>" readonly>
                <label> Évènement :</label>
                <select id="movie" name="film" readonly>
                    <option value="<?php echo $nom_film; ?>"><?php echo $nom_film; ?></option>
                </select>
                <label for="places">Nombre de places :</label>
                <input type="places" id="places" name="places" value="<?php echo $places; ?>">
                <label for="date">Date :</label>
                <input type="date" id="date" name="date" value="<?php echo $date; ?>" readonly>
                <label for="horaire">Horaire :</label>
                <select id="horaire" name="horaire" readonly>
                    <option value="<?php echo $horaire; ?>"><?php echo $horaire; ?></option>
                </select>
                <p>
                    <button name="send" type="submit">Réserver</button>
                </p>
                <p>
                    <button type="reset">Annuler</button>
                </p>
            </form>
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