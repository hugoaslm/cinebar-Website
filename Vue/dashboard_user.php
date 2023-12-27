<?php
session_start();

$estConnecte = isset($_SESSION['identifiant']);

if (!$estConnecte) {
    header("Location: accueil.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/user.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <nav>
            <img src="../images/logo-cinebar.png" alt="Logo Cinébar">
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

    <main>
    <h1>Modifier le profil de <span class="mot_cle"><?php echo $identif; ?></span> : </h1>
        <form action="modifier_compte.php" method="post" class="compte">
            <label for="mail">E-mail :</label>
            <input type="mail" id="mail" name="mail" required>

            <label for="pseudo">Pseudo :</label>
            <input type="text" id="pseudo" name="pseudo" required>

            <div class="lang">
                <label for="langue">Préférence de Langue :</label>
                <select id="langue" name="langue" required>
                    <option value="francais">Français</option>
                    <option value="anglais">Anglais</option>
                </select>
            </div>

            <div class="theme-container">
                <span class="theme-label">Thème:</span>
                <label class="switch">
                    <input type="checkbox" id="themeToggle" onchange="toggleTheme()">
                    <span class="slider round"></span>
                </label>
                <span id="themeText">sombre</span>
            </div>


            <button type="submit">Sauvegarder les modifications</button>
        </form>

        <script>
            // Ajoutez cette fonction pour changer le texte en fonction de l'état du toggle
            function toggleTheme() {
                var themeToggle = document.getElementById("themeToggle");
                var themeText = document.getElementById("themeText");

                if (themeToggle.checked) {
                    // Thème sombre
                    document.body.classList.add("theme-clair");
                    themeText.textContent = "clair";
                } else {
                    // Thème clair
                    document.body.classList.remove("theme-sombre");
                    themeText.textContent = "sombre";
                }
            }
        </script>
    </main>

    <footer>
        <section class='logo-adresse'>
            <img src="../images/logo-cinebar.png" alt="Logo Cinébar">
            <div>
                <h3>Adresse :</h3>
                8 Prom. Coeur de Ville<br>
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
