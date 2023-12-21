<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/user.css">
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
                    $identifiant = $_SESSION['identifiant'];
                    $boutonConnexion .= '<a href="profil.php">' . $identifiant . ' <i class="fas fa-user"></i></a>';
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
    <h1>Modifier le profil de <span class="mot_cle"><?php echo $identifiant; ?></span> : </h1>
        <form action="modifier_compte.php" method="post">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

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
                <span id="themeText">clair</span>
            </div>


            <button type="submit">Sauvegarder les modifications</button>
        </form>

        <div class="bouton-deco">
        <a href="logout.php">Se déconnecter</a>
        </div>

        <script>
            // Ajoutez cette fonction pour changer le texte en fonction de l'état du toggle
            function toggleTheme() {
                var themeToggle = document.getElementById("themeToggle");
                var themeText = document.getElementById("themeText");

                if (themeToggle.checked) {
                    // Thème sombre
                    document.body.classList.add("theme-sombre");
                    themeText.textContent = "sombre";
                } else {
                    // Thème clair
                    document.body.classList.remove("theme-sombre");
                    themeText.textContent = "clair";
                }
            }
        </script>
    </main>

    <footer>
        <section class='logo-adresse'>
            <img src="images/logo-cinebar.png" alt="Logo Cinébar">
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
