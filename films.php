<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
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

    <main>
        <h1>FILM DU MOMENT</h1>
        <section class='vedette'>
            <div class="film-vedette">
                <div class="illu">
                  <img src="images/spiderman.jpg" alt="Spider-Man: Across the Spider-Verse">
                </div>
            
                <div class="details">
                  <h2>Titre du film</h2>
                  <h4>Genre</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore 
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                    aliquip ex ea commodo consequat.</p>
                  <div>Date de sortie: 01 janvier 2023</div>
                  <div>Durée: 2h30min</div>
                </div>

                <div class="cast">
                    <p>Réalisateur: Nom du réalisateur</p>
                    <p>Acteurs: Acteur 1, Acteur 2, Acteur 3</p>
                </div>
            </div>
        </section>

        <section class="films-en-salle">
            <div class="films-title">
                <h1>FILM EN SALLES</h1>
            </div>
            <div class="film-1">
                <div class="film">
                    <a href="details.php?id_FE=1">
                        <img src="images/avatar.jpg" alt="Avatar">
                        <p>Avatar</p>
                    </a>
                </div>
                <div class="film">
                    <a href="details.php?id_FE=2">
                        <img src="images/gt.jpg" alt="Gran Turismo">
                        <p>Gran Turismo</p>
                    </a>
                </div>
                <div class="film">
                    <a href="details.php?id_FE=3">
                        <img src="images/hunger-games.jpg" alt="Hunger Games">
                        <p>Hunger Games</p>
                    </a>
                </div>
                <div class="film">
                    <a href="details.php?id_FE=4">
                        <img src="images/indiana.jpg" alt="Indiana Jones">
                        <p>Indiana Jones</p>
                    </a>
                </div>
            </div>
            <div class="film-2">
                <div class="film">
                    <a href="details.php?id_FE=5">
                        <img src="images/mario.jpg" alt="Super Mario Bros">
                        <p>Super Mario Bros</p>
                    </a>
                </div>
                <div class="film">
                    <a href="details.php?id_FE=6">
                        <img src="images/napoleon.jpg" alt="Napoléon">
                        <p>Napoléon</p>
                    </a>
                </div>
                <div class="film">
                    <a href="details.php?id_FE=7">
                        <img src="images/oppenheimer.jpg" alt="Oppenheimer">
                        <p>Oppenheimer</p>
                    </a>
                </div>
                <div class="film">
                    <a href="details.php?id_FE=8">
                        <img src="images/mission-impo.jpg" alt="Mission-Impossible">
                        <p>Mission-Impossible</p>
                    </a>
                </div>
            </div>
        </section>
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