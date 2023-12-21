<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/cookies.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Montserrat&display=swap" rel="stylesheet">
</head>


<body>


    <header>
        
        <nav>
            
            <img src="images/logo-cinebar.png" alt="Logo Cinébar" >
            <div class="pages">
                <a href="accueil.php">Accueil</a>
                <a href="cinema.php">Le Cinéma</a>
                <a href="cafet.php">La Cafétéria</a>
                <a href="films.php">Films</a>
                <a href="events.php">Évènements</a>
                <a href="billet.php">Billetterie</a>
                <a href="forum.php">Forum</a>
            </div>
            <div class="bouton-access">
                <div class="bouton-pro">
                    <a href="pro.php">Professionnel</a>
                </div>

                <?php

                session_start();

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
    
    <main class='cookies'>
            <form action="php/login.php" method="post" class="co">
                    <div class="form-text" id="sugg">
	                <p><span style="color: black;">
                        Le respect de votre vie privée est notre priorité !
                    </p><br/>
                    </span>
                    <label>
                        <input class="mui-switch mui-switch-anim" type="checkbox" name="mostPopular"> Recevoir des recommandations pour les films les plus consultés.
                    </label><br/>
                    <label>
                        <input class="mui-switch mui-switch-anim" type="checkbox" name="newReleases"> Être informé des dernières sorties de films.
                    </label><br/>
                    <label>
                        <input class="mui-switch mui-switch-anim" type="checkbox" name="exclusiveContent"> Accéder à du contenu exclusif et des offres spéciales.
                    </label><br/>
                    <label>
                        <input class="mui-switch mui-switch-anim" type="checkbox" name="personalizedSuggestions"> Recevoir des suggestions de films personnalisées en fonction de vos préférences.
                    </label><br/>
                    </div>
            </form>
    </main>


    <footer>
        <section class='logo-adresse'>
            <img src="images/logo-cinebar.png" alt="Logo Cinébar" >
            <div>
                <h3>Adresse :</h3>
                Rue ...<br>
                <a>Code postal - Ville</a>
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