<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/pro.css">
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
                <a href="cinema.html">Le Cinéma</a>
                <a href="rooftop.html">La Cafétéria</a>
                <a href="films.html">Films</a>
                <a href="events.html">Évènements</a>
                <a href="billet.html">Billetterie</a>
                <a href="forum.html">Forum</a>
            </div>
            <div class="bouton-access">
                <div class="bouton-pro">
                    <a href="pro.html">Professionnel</a>
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
        <div class="salles-title">
            <h1>NOS SALLES</h1>
        </div>
        <section class='salles'>
            <div>
                <h2>Salle 1</h2>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                <ul>
                    <li>X places</li>
                    <li>Tous types d'équipements</li>
                </ul>
                <p>
                    <a href="#form">Réserver</a>
                </p>
            </div>
            <div>
                <h2>Salle 2</h2>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                <ul>
                    <li>X places</li>
                    <li>Tous types d'équipements</li>
                </ul>
                <p>
                    <a href="#form">Réserver</a>
                </p>
            </div>
            <div>
                <h2>Salle 3</h2>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                <ul>
                    <li>X places</li>
                    <li>Tous types d'équipements</li>
                </ul>
                <p>
                    <a href="#form">Réserver</a>
                </p>
            </div>
            <div>
                <h2>Salle 4</h2>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                <ul>
                    <li>X places</li>
                    <li>Tous types d'équipements</li>
                </ul>
                <p>
                    <a href="#form">Réserver</a>
                </p>
            </div>
        </section>

        <section id="form" class='form'>
            <h1>FORMULAIRE DE RESERVATION DE SALLES</h1>
            <form action="traitement_formulaire.php" method="post" class="form-container">
                <div class="form-column">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom">
                    <label for="mail">E-mail :</label>
                    <input type="mail" id="mail" name="mail">


                    <h3>Types d'évènements :</h3>
                    <div class="type-event">
                        <div>
                            <input type="radio" id="conf" name="salle" value="conf">
                            <label for="conf">Conférence</label>
                        </div>
                    
                        <div>
                            <input type="radio" id="proj" name="salle" value="proj">
                            <label for="proj">Projection de film</label>
                        </div>
                    
                        <div>
                            <input type="radio" id="humour" name="salle" value="humour">
                            <label for="humour">Spectacle Humoristique</label>
                        </div>
                    
                        <div>
                            <input type="radio" id="theatre" name="salle" value="theatre">
                            <label for="theatre">Pièce de théâtre</label>
                        </div>
                    </div>
                    
                    <h3>Choix de la salle :</h3>
                    <div class="choix-salles">
                        <div>
                            <input type="radio" id="1" name="salle" value="1">
                            <label for="1">Salle 1</label>
                        </div>
                    
                        <div>
                            <input type="radio" id="2" name="salle" value="2">
                            <label for="2">Salle 2</label>
                        </div>
                    
                        <div>
                            <input type="radio" id="3" name="salle" value="3">
                            <label for="3">Salle 3</label>
                        </div>
                    
                        <div>
                            <input type="radio" id="4" name="salle" value="4">
                            <label for="4">Salle 4</label>
                        </div>
                    </div>  

                </div>
                <div class="form-column">
                    <label for="text">Prénom :</label>
                    <input type="text" id="prenom" name="prenom">
                    <label for="num">Numéro de téléphone :</label>
                    <input type="text" id="num" name="num">

                    <label for="date">Date de l'évènement :</label>
                    <input type="date" id="date" name="date">
                    <label for="text">Horaires :</label>
                    <input type="text" id="text" name="horaires">
                    <label for="number">Nombre d'invités :</label>
                    <input type="number" id="number" name="number">

                    <h3>Equipements nécessaires si besoin :</h3>
                    <div class="equip">
                        <div>
                            <input type="radio" id="micro" name="micro" value="micro">
                            <label for="micro">Microphone</label>
                        </div>
                    
                        <div>
                            <input type="radio" id="projo" name="projecteur" value="projecteur">
                            <label for="projecteur">Projecteur</label>
                        </div>
                    
                        <div>
                            <input type="radio" id="sono" name="sonorisation" value="sonorisation">
                            <label for="sonorisation">Sonorisation</label>
                        </div>
                    </div>
                </div>
                <div class="comm">

                    <label for="comm">Commentaires ou demandes spéciales :</label>
                    <textarea id="comm" name="comm"></textarea>
    
                    <div class="reserv">
                        <button type="submit" href="#form">Réserver</button>
                    </div>
    
                </div>
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
            <a href="cookies.html">Gestion des cookies</a> - 
            <a href="cgu.html">CGU</a> - 
            <a href="faq.html">FAQ</a>
        </div>        
    </footer>

</body>
</html>