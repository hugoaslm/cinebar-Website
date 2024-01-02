<?php
session_start();

include '../Modèle/estAdmin.php';

if (!$estAdmin) {
    header("Location: accueil.php");
    exit();
}

include '../Modèle/style_theme.php' ?>

<?php
if ($theme == 0) { ?>
    <style>
        body {
            color: black;
        }
    </style>
<?php } ?>

<?php if ($theme == 1) { ?>
    <style>
        body {
            background-color: #1E1E1E;
            color: white;
        }

        footer,
        header {
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
            <h1>Gestion des Salles</h1>
            <form action="../Contrôleur/ajouter_salle.php" method="post" class="form-container">
                <label for="nom_salle">Nom de la Salle :</label>
                <input type="text" id="nom_salle" name="nom_salle" required>

                <label for="capacite_salle">Capacité de la Salle :</label>
                <input type="number" id="capacite_salle" name="capacite_salle" required>

                <label for="equipement_salle">Équipements de la Salle :</label>
                <input type="text" id="equipement_salle" name="equipement_salle" required>

                <label for="type_salle">Peut accueillir :</label>
                <select id="type_salle" name="type_salle[]" class="select2" multiple="multiple">
                </select>

                <div class="ajouter">
                    <button type="submit">Ajouter Salle</button>
                </div>
            </form>

            <h2>Supprimer une salle :</h2>
            <form action="../Contrôleur/supprimer_salle.php" method="post" class="form-container">
                <select name="salle_id" id="salle_id">
                    <?php

                    include '../Modèle/bdd.php';

                    $sql = "SELECT id_Salle, nom_salle FROM salle";
                    $resultat = $connexion->query($sql);

                    // Générer les options de la liste déroulante
                    while ($salles = $resultat->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $salles['id_Salle'] . '">' . $salles['nom_salle'] . '</option>';
                    }
                    ?>
                </select>
                <button class="sele-moment" type="submit">Supprimer</button>
            </form>
        </section>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                var type = [
                    'Conférence',
                    'Projection de film',
                    'Evénement spécial',
                    'Spectacle Humoristique',
                    'Pièce de théâtre'
                ];

                $('#type_salle').select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    placeholder: 'Sélectionnez des types',
                    data: type.map(function (type) {
                        return { id: type, text: type };
                    }),
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
