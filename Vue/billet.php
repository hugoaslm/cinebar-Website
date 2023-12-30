<?php
session_start();

include "../Modèle/bdd.php";

// Vérifiez si l'utilisateur est connecté
$estConnecte = isset($_SESSION['identifiant']);

// Récupération de l'ID de la projection à partir de l'URL
$projection_id = isset($_GET['id_Projection']) ? $_GET['id_Projection'] : null;

// Initialisation les valeurs par défaut
$nom = '';
$prenom = '';
$email = '';
$film = '';
$places = '';
$date = '';
$horaire = '';

// Vérifiez si l'ID de la projection est défini
if ($projection_id !== null) {
    $stmt_projection = $connexion->prepare("SELECT films_salle_films_id_F, date, heure FROM projection WHERE id_Projection = :id_Projection");
    $stmt_projection->bindParam(':id_Projection', $projection_id);
    $stmt_projection->execute();
    $projection_details = $stmt_projection->fetch(PDO::FETCH_ASSOC);

    $film = $projection_details['films_salle_films_id_F'];

    $stmt_film = $connexion->prepare("SELECT nom FROM films WHERE id_F = :id_Film");
    $stmt_film->bindParam(':id_Film', $film);
    $stmt_film->execute();
    $nom_film = $stmt_film->fetchColumn();

    // Si la projection est trouvée, mettez à jour les valeurs par défaut
    if ($projection_details) {
        $date = $projection_details['date'];
        $horaire = $projection_details['heure'];
    }
}

include "../Modèle/infos_utilisateur.php";

// Si l'utilisateur est connecté, récupérez son email
if ($estConnecte) {
    $email = $resultat['mail'];
}
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/billet-events.css">
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

    <main class="billet">
        <section class='form_billet'>
            <h1>Réservation :</h1>
            <form action="../Contrôleur/traitement_billet_films.php" method="post" class="reserv-billet">
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