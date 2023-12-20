<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
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

    <main class="billet">
        <section class='form_billet'>
            <form action="traitement_billet.php" method="post" class="reserv-billet">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom">
                <label for="nom">Prénom :</label>
                <input type="text" id="prenom" name="prenom">
                <label for="mail">E-mail :</label>
                <input type="mail" id="mail" name="mail">
                <label> Évènement :</label>
                <select id="movie" name="film">
                    <option value="Oppenheimer">Oppenheimer</option>
                    <option value="Indiana Jones">Indiana Jones</option>
                    <option value="Avatar">Avatar</option>
                    <option value="Napoléon">Napoléon</option>
                </select>
                <label for="places">Nombre de places :</label>
                <input type="places" id="places" name="places">
                <label for="date">Date :</label>
                <input type="date" id="date" name="date">
                <label for="horaire">Horaire :</label>
                <select id="horaire" name="horaire">
                    <option value="13h45">13h45</option>
                    <option value="17h00">17h00</option>
                    <option value="19h30">19h30</option>
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

</body>
</html>