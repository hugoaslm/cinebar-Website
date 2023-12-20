<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/profil.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <nav>
            <img src="images/logo-cinebar.png" alt="Logo Cinébar">
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
        <form action="modifier_compte.php" method="post">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="langue">Préférence de Langue :</label>
            <select id="langue" name="langue" required>
                <option value="francais">Français</option>
                <option value="anglais">Anglais</option>
            </select>

            <label for="theme">Thème :</label>
            <div id="themeToggle" class="toggle-theme">
                <button type="button" onclick="toggleTheme()">Sombre</button>
            </div>

            <button type="submit">Modifier Compte</button>
        </form>

        <script>
            // Script JavaScript pour basculer entre les thèmes
            function toggleTheme() {
                var themeToggle = document.getElementById("themeToggle");
                var themeButton = themeToggle.querySelector("button");

                if (document.body.classList.contains("theme-sombre")) {
                    // Passer au thème clair
                    document.body.classList.remove("theme-sombre");
                    themeButton.textContent = "Sombre";
                } else {
                    // Passer au thème sombre
                    document.body.classList.add("theme-sombre");
                    themeButton.textContent = "Clair";
                }
            }
        </script>
    </main>

    <footer>
        <section class='logo-adresse'>
            <img src="images/logo-cinebar.png" alt="Logo Cinébar">
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
