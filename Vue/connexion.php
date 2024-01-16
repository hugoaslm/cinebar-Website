<?php

// Démarrer la session
session_start();

include '../Modèle/style_theme.php' ?>

<?php

 if ($theme==0) {?>
<style>
    body {
        color: black;
    }
</style>
<?php } ?>

<?php if ($theme==1) {?>
<style>

    body {
    background-color: white;
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
    <meta name="description" content="Connexion">
    <title>Connexion</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/connexion.css">
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
                    $boutonConnexion .= '<a href="profil.php">' . $identif . ' <i class="fas fa-user"></i></a>';
                } else {
                    // Si non connecté, affichez le bouton de connexion normal
                    $boutonConnexion .= '<a href="connexion.php">Connexion <i class="fas fa-user"></i></a>';
                }
                $boutonConnexion .= '</div>';

                // Affichez le bouton de connexion généré
                echo $boutonConnexion;
                ?>
                
            </div>
        </nav>
        
    </header>

    <main class='connexion'>
        <img src="../images/oppenheimer_large.jpg" alt="films_large" class="back_image">
        <form action="../Modèle/co_process.php" method="post" class="co">
            <div class="form-text" id="sugg">
                <p>
                    <label for="identifiant">E-mail ou pseudonyme :</label>
                    <input type="text" id="identifiant" name="identifiant">
                </p>
                <p>
                    <label for="mdp">Mot de passe :</label>
                    <input type="password" id="mdp" name="mdp">
                </p>
            </div>
            <div class="co-bouton">
                <button name="send" type="submit">Se connecter</button>
				<p>Vous n'avez pas de compte ? <a href="inscription.php">S'inscrire</a></p>
            </div>
        </form>
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