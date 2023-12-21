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
                    <a href="pro.php">Réservation de salles</a>
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
        <h1>ÉVÈNEMENT DU MOMENT</h1>
        <section class='vedette-section'>
            <div class="vedette">
                <div class="illu">
                    <img src="images/darcy-full.jpg" alt="Darcy">
                </div>

                <div class="details">
                    <h2>Titre de l'événement</h2>
                    <h4>Type d'événement</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip ex ea commodo consequat.</p>
                    <div>Date de l'événement: 01 janvier 2023</div>
                    <div>Durée: 2h30min</div>
                </div>

                <div class="cast">
                    <p>Organisateur: Nom de l'organisateur</p>
                    <p>Participants: Participant 1, Participant 2, Participant 3</p>
                </div>
            </div>
        </section>

        <section class="events-en-salle">
            <div class="events-title">
                <h1>ÉVÈNEMENTS À L'AFFICHE</h1>
            </div>
            <div class="events-1">
                <div class="event">
                    <a href="desc.php?id_E=1" class="ev">
                        <img src="images/opera.jpg" alt="Spectacle">
                        <p>Spectacle</p>
                    </a>
                </div>
                <div class="event">
                    <a href="desc.php?id_E=2" class="ev">
                        <img src="images/opera.jpg" alt="Conférence">
                        <p>Conférence</p>
                    </a>
                </div>
                <div class="event">
                    <a href="desc.php?id_E=3" class="ev">
                        <img src="images/opera.jpg" alt="Théâtre">
                        <p>Théâtre</p>
                    </a>
                </div>
            </div>
            <div class="events-2">
                <div class="event">
                    <a href="desc.php?id_E=4" class="ev">
                        <img src="images/opera.jpg" alt="Exposition">
                        <p>Exposition</p>
                    </a>
                </div>
                <div class="event">
                    <a href="desc.php?id_E=5" class="ev">
                        <img src="images/opera.jpg" alt="Stand-up">
                        <p>Stand-up</p>
                    </a>
                </div>
                <div class="event">
                    <a href="desc.php?id_E=6" class="ev">
                        <img src="images/opera.jpg" alt="Workshop">
                        <p>Workshop</p>
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