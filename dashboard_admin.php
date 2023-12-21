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
                    <a href="pro.php">Réservation de salles</a>
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
    <p class="intro-text">Bienvenue sur la page d'administration du site Cinébar ! <br> Cette section vous permet de gérer les films, 
        événements et salles du cinéma. Utilisez les formulaires ci-dessous pour ajouter, modifier ou supprimer des informations. 
        Assurez-vous de saisir correctement les détails pour maintenir la précision de la base de données.</p>

        <section class="admin-section">
            <h1>Gestion des Films</h1>
            <h2>Ajout de film :</h2>
            <form action="ajouter_film.php" method="post" class="form-container">
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

                <label for="genre_film">Genre :</label>
                <input type="text" id="genre_film" name="genre_film" required>

                <label for="affiche_film">Chemin vers l'affiche :</label>
                <input type="text" id="affiche_film" name="affiche_film" required>

                <div class="ajouter">
                    <button type="submit">Ajouter Film</button>
                </div>
            </form>

            <h2>Sélection du film du moment :</h2>
            <form action="film_moment.php" method="post" class="form-container">
                <select name="film_id" id="film_id">
                    <?php
                    // Connexion à la base de données
                    $serveur = 'localhost';
                    $utilisateur_db = 'root';
                    $mot_de_passe_db = 'bddisep19';
                    $nom_base_de_donnees = 'cinebar';

                    try {
                        $conn = new PDO("mysql:host=$serveur;dbname=$nom_base_de_donnees", $utilisateur_db, $mot_de_passe_db);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Récupérer les films depuis la base de données
                        $sql = "SELECT id_F, nom FROM films";
                        $resultat = $conn->query($sql);

                        // Générer les options de la liste déroulante
                        while ($film = $resultat->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $film['id_F'] . '">' . $film['nom'] . '</option>';
                        }
                    } catch (PDOException $e) {
                        echo "Erreur de connexion à la base de données : " . $e->getMessage();
                    }
                    ?>
                </select>
                <button class="sele-moment" type="submit">Sélectionner</button>
            </form>
        </section>

        <section class="admin-section">
            <h1>Gestion des Événements</h1>
            <form action="ajouter_evenement.php" method="post" class="form-container">
                <label for="titre_event">Titre de l'Événement :</label>
                <input type="text" id="titre_event" name="titre_event" required>

                <label for="date_event">Date de l'Événement :</label>
                <input type="date" id="date_event" name="date_event" required>

                <label for="lieu_event">Lieu de l'Événement :</label>
                <input type="text" id="lieu_event" name="lieu_event" required>

                <div class="ajouter">
                    <button type="submit">Ajouter Événement</button>
                </div>
            </form>
        </section>

        <section class="admin-section">
            <h1>Gestion des Salles</h1>
            <form action="ajouter_salle.php" method="post" class="form-container">
                <label for="nom_salle">Nom de la Salle :</label>
                <input type="text" id="nom_salle" name="nom_salle" required>

                <label for="capacite_salle">Capacité de la Salle :</label>
                <input type="number" id="capacite_salle" name="capacite_salle" required>

                <label for="equipement_salle">Équipements de la Salle :</label>
                <input type="text" id="equipement_salle" name="equipement_salle" required>

                <div class="ajouter">
                    <button type="submit">Ajouter Salle</button>
                </div>
            </form>
        </section>

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
