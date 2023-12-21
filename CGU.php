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
        <div class="cgu">
            <p><span style="color: black;">
                Bienvenue sur Cinébar, votre destination cinéma en ligne ! En accédant et en utilisant ce site, vous acceptez les conditions générales d'utilisation suivantes :
            </p><br/>
            </span>
            <p><span style="color: black;">
                1. **Droits d'exploitation :** Cinébar se réserve tous les droits d'exploitation du contenu présent sur ce site, y compris, mais sans s'y limiter, les textes, les images, les vidéos et les fonctionnalités interactives.
            </p><br/>
            </span>
            <p><span style="color: black;">
                2. **Utilisation du site :** Vous vous engagez à utiliser ce site conformément aux lois applicables et aux présentes conditions. Toute utilisation abusive, frauduleuse ou contraire aux CGU pourra entraîner la résiliation de votre compte.
            </p><br/>
            </span>
            <p><span style="color: black;">
                3. **Protection des données :** Cinébar s'engage à protéger vos données personnelles conformément à sa politique de confidentialité. En utilisant ce site, vous consentez à la collecte, au traitement et à l'utilisation de vos données conformément à cette politique.
            </p><br/>
            </span>
            <p><span style="color: black;">
                4. **Cookies :** Nous utilisons des cookies pour améliorer votre expérience sur Cinébar. En acceptant notre utilisation des cookies, vous consentez à notre politique en matière de cookies. Vous pouvez ajuster vos préférences à tout moment.
            </p><br/>
            </span>
            <p><span style="color: black;">
                5. **Responsabilités :** Cinébar ne peut être tenu responsable des dommages directs ou indirects résultant de l'utilisation de ce site. Nous vous encourageons à utiliser nos services de manière responsable.
            </p><br/>
            </span>
            <p><span style="color: black;">
                Ces conditions générales d'utilisation sont sujettes à modification. Nous vous encourageons à les consulter régulièrement pour rester informé des mises à jour.
            </p><br/>
            </span>
        </div>
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