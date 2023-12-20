<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/accueil.css">
    <link rel="stylesheet" href="style/style.css">
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
                <a href="rooftop.php">La Cafétéria</a>
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
        <div class="haut-cine">
            <img src="images/darcy.jpg" alt="Cinéma Darcy" >
        </div>
        <section class='accueil-cine'>
            <div class="acc-cine">
                <h1>Une Expérience Unique </h1>
                <p>
                    Vivez une expérience cinématographique immersive où vos émotions façonnent l'expérience. Les réactions du public sont instantanément partagées sur le site du film, créant une connexion unique entre l'histoire à l'écran et le public en salle.
                </p>
            </div>
            <div class="img-container">
                <img src="images/pexels-linda-gschwentner-11718584.jpg" alt="cinema">
            </div>
        </section>


        <section class='accueil-bar'>
            <div class="img-bar">
                <img src="images/pexels-cottonbro-studio-8261819.png" alt="bar">
            </div>
            <div class="acc-bar">
                <h1>La cafétéria</h1>
                <p>
                    Les discussions animées sur la séance précédente ajoutent une dimension sociale unique, créant un lieu où les cinéphiles se retrouvent pour partager leurs réactions et prolonger l'expérience au-delà de l'écran
                </p>
            </div>
        </section>



        <section class="boite3">
            <div class="titre-boite3">
                <h1>Le film du moment</h1>
                <img src="images/wonka.jpg" alt="wonka">
                <button class="bouton-voir">Aller voir</button>
            </div>
            
            <div class="titre-boite3">
                <h1>À Venir</h1>
                <img src="images/aquaman.jpg" alt="aquaman">
                <button class="bouton-voir">Aller voir</button>
            </div>
        
            <div class="titre-boite3">
                <h1>Film Français</h1>
                <img src="images/L-affiche-des-Trois-Mousquetaires-Milady-1706429.jpg" alt="3mousquetaires">
                <button class="bouton-voir">Aller voir</button>
            </div>
        </section>
        
        
        <section class="carrousel">
            
            <div class="carousel-container">
                <h1> À l'affiche au cinéma</h1>
                <div class="arrow arrow-prev" onclick="prevSlide()">&#9664;</div>
                <div class="img-carrousel">
                    
                    <img src="images/avatar.jpg" alt="avatar">
                    <img src="images/oppenheimer.jpg" alt="oppenheimer">
                    <img src="images/napoleon.jpg" alt="napoleon">
                    <img src="images/mario.jpg" alt="mario">
                    <img src="images/hunger-games.jpg" alt="hunger-games">
                    <img src="images/L-affiche-des-Trois-Mousquetaires-Milady-1706429.jpg" alt="3mosquetaires">
                    <img src="images/5607521.jpg-r_1920_1080-f_jpg-q_x-xxyxx.jpg" alt="wish">
                    <img src="images/migration.jpg" alt="migration">
                    <img src="images/wonka.jpg" alt="wonka">
                    <img src="images/follow_daed.jpg" alt="followdead">
                    <img src="images/soudain_seuls.jpg" alt="soudainseuls">
                    <img src="images/Batiment5.jpg" alt="bat5">
                </div>
                <div class="arrow arrow-next" onclick="nextSlide()">&#9654;</div>
                <div class="arrow arrow-prev" onclick="prevSlide()">&#9664;</div>
                
            </div>
        </section>


    </main>

    
    <footer>
        <section class='logo-adresse'>
            <img src="images/logo-cinebar.png" alt="Logo Cinébar" >
            <div>
                <h3>Adresse :</h3>
                Place Darcy <br>
                <a>21000 - Dijon</a>
            </div>
        </section>
        <div class="donnees">
            <a href="cookies.php">Gestion des cookies</a> - 
            <a href="cgu.php">CGU</a> - 
            <a href="faq.php">FAQ</a>
        </div>        
    </footer>
    
    <button id="backToTopBtn">&#9650;</button>
    <script src="script.js"></script>

</body>
</html>