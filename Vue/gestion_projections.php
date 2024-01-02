<?php
session_start();

include '../Modèle/estAdmin.php';

if (!$estAdmin) {
    header("Location: accueil.php");
    exit();
}

include '../Modèle/style_theme.php' ?>

<?php

 if ($theme==0) {?>
<style>
    body {
        color: black;
    }
</style>
<?php } ?>

<?php if ($theme==1) {?>
<style>

    body {
    background-color: #1E1E1E;
    color: white;
    }

    footer, header {
    background-color: rgb(17, 17, 17);
    }
</style>
<?php } ?>

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
            <h1>Gestion des projections</h1>
            <h2>Ajout de séances :</h2>
            <form action="../Contrôleur/ajouter_projection.php" method="post" class="form-container">
                <label for="salle_proj">Salle :</label>
                <select name="salle_proj" id="salle_proj">
                    <?php

                    include '../Modèle/bdd.php';

                    $sql_salle = "SELECT id_Salle, nom_salle FROM salle";
                    $resultat_salle = $connexion->query($sql_salle);

                    // Générer les options de la liste déroulante
                    while ($salle = $resultat_salle->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $salle['id_Salle'] . '">' . $salle['nom_salle'] . '</option>';
                    }
                    ?>
                </select>

                <label for="film_proj">Film :</label>
                <select name="film_proj" id="film_proj">
                    <?php

                    include '../Modèle/bdd.php';

                    $sql_film = "SELECT id_F, nom FROM films";
                    $resultat_film = $connexion->query($sql_film);

                    // Générer les options de la liste déroulante
                    while ($film = $resultat_film->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $film['id_F'] . '">' . $film['nom'] . '</option>';
                    }
                    ?>
                </select>

                <label for="horaire">Horaire de la séance :</label>
                <input type="text" id="horaire" name="horaire" required>

                <label for="date_proj">Date de la séance :</label>
                <input type="date" id="date_proj" name="date_proj" required>

                <div class="ajouter">
                    <button type="submit">Ajouter la projection</button>
                </div>
            </form>

            <h2>Supprimer une projection :</h2>
            <form action="../Contrôleur/supprimer_projection.php" method="post" class="form-container">
                <select name="id_proj" id="id_proj">
                    <?php

                    include '../Modèle/bdd.php';

                    $sql = "SELECT * FROM projection";
                    $resultat = $connexion->query($sql);

                    // Générer les options de la liste déroulante
                    while ($proj = $resultat->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $proj['id_Projection'] . '">Salle : ' . $proj['films_salle_salle_id_Salle'] . ' le ' . $proj['date'] . ' à ' . $proj['heure'] . '</option>';
                    }
                    ?>
                </select>
                <button class="sele-moment" type="submit">Supprimer</button>
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
