<?php
session_start();

include '../Modèle/estAdmin.php';

if (!$estAdmin) {
    header("Location: accueil.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/pro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Montserrat&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
    <p class="intro-text">Bienvenue sur la page d'administration du site Cinébar ! <br> Cette section vous permet de gérer les films, 
        événements et salles du cinéma. Utilisez les formulaires ci-dessous pour ajouter, modifier ou supprimer des informations. 
        Assurez-vous de saisir correctement les détails pour maintenir la précision de la base de données.</p>

        <section class="admin-section">
            <h1>Gestion des Films</h1>
            <h2>Ajout de film :</h2>
            <form action="../Contrôleur/ajouter_film.php" method="post" class="form-container">
                <label for="titre_film">Titre du Film :</label>
                <input type="text" id="titre_film" name="titre_film" required>

                <label for="desc_film">Description :</label>
                <input type="text" id="desc_film" name="desc_film" required>

                <label for="realisateur_film">Réalisateur :</label>
                <input type="text" id="realisateur_film" name="realisateur_film" required>
                
                <label for="acteurs_film">Acteurs :</label>
                <input type="text" id="acteurs_film" name="acteurs_film" required>

                <label for="date_film">Date de Sortie :</label>
                <input type="date" id="date_film" name="date_film" required>

                <label for="duree_film">Durée (en minutes) :</label>
                <input type="number" id="duree_film" name="duree_film" required>

                <label for="genre_film">Genres :</label>
                <select id="genre_film" name="genre[]" class="select2" multiple="multiple">
                </select>

                <label for="affiche_film">Chemin vers l'affiche :</label>
                <label for="affiche_film" class="file-input">
                    Choisir le fichier
                <input type="file" id="affiche_film" name="affiche_film" required>
                </label>

                <div class="ajouter">
                    <button type="submit">Ajouter un film</button>
                </div>
            </form>

            <h2>Supprimer un film :</h2>
            <form action="../Contrôleur/supprimer_film.php" method="post" class="form-container">
                <select name="film_id" id="film_id">
                    <?php

                    include '../Modèle/bdd.php';

                    $sql = "SELECT id_F, nom FROM films";
                    $resultat = $connexion->query($sql);

                    // Générer les options de la liste déroulante
                    while ($film = $resultat->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $film['id_F'] . '">' . $film['nom'] . '</option>';
                    }
                    ?>
                </select>
                <button class="sele-moment" type="submit">Supprimer</button>
            </form>

            <h2>Sélection du film du moment :</h2>
            <form action="../Contrôleur/film_moment_admin.php" method="post" class="form-container">
                <select name="film_id" id="film_id">
                    <?php

                    include '../Modèle/bdd.php';

                    $sql = "SELECT id_F, nom FROM films";
                    $resultat = $connexion->query($sql);

                    // Générer les options de la liste déroulante
                    while ($film = $resultat->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $film['id_F'] . '">' . $film['nom'] . '</option>';
                    }
                    ?>
                </select>
                <button class="sele-moment" type="submit">Sélectionner</button>
            </form>
        </section>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            var dateInput = document.getElementById('date_film');
            var today = new Date().toISOString().split('T')[0];
            dateInput.setAttribute('max', today);

            $(document).ready(function() {
                $('#genre_film').select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    placeholder: 'Sélectionnez des genres',
                    ajax: {
                        url: 'genres.json', // Chemin vers votre fichier JSON
                        dataType: 'json',
                        processResults: function(data) {
                            return {
                                results: data.map(function(genre) {
                                    return { id: genre, text: genre };
                                }),
                            };
                        },
                    },
                });
            });
        </script>

    </main>

    <footer>
        <section class='logo-adresse'>
            <img src="../images/logo-cinebar.png" alt="Logo Cinébar">
            <div>
                <h3>Adresse :</h3>
                <p>8 Prom. Coeur de Ville</p>
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
