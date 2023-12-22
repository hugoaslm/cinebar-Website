<?php include 'bdd.php'; ?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/films_events.css">
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
        <?php

        // Récupérer l'ID du film sélectionné depuis la table film_moment
        $sql = "SELECT film_id_F FROM film_moment";
        $stmt = $conn->query($sql);

        if ($stmt->rowCount() > 0) {
            $film_id = $stmt->fetch(PDO::FETCH_ASSOC)['film_id_F'];

            // Récupérer les détails du film associé à l'ID
            $sql = "SELECT * FROM films WHERE id_F = :film_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":film_id", $film_id);
            $stmt->execute();

            // Vérifier s'il y a des résultats
            if ($stmt->rowCount() > 0) {
                $film = $stmt->fetch(PDO::FETCH_ASSOC);

                // Afficher les détails du film
                echo '<h1>FILM DU MOMENT</h1>';
                echo '<section class="vedette">';
                echo '<div class="film-vedette">';
                echo '<div class="illu">';
                echo '<img src="' . $film['affiche_large'] . '" alt="' . $film['nom'] . '">';
                echo '</div>';
                echo '<div class="details">';
                echo '<h2>' . $film['nom'] . '</h2>';
                echo '<h4>' . $film['genre'] . '</h4>';
                echo '<p>' . $film['description'] . '</p>';
                echo '<div>Date de sortie: ' . $film['DateDeSortie'] . '</div>';
                echo '<div>Durée: ' . $film['duree'] . ' minutes</div>';
                echo '</div>';
                echo '<div class="cast">';
                echo '<p>Réalisateur: ' . $film['realisateur'] . '</p>';
                echo '<p>Acteurs: ' . $film['acteurs'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</section>';
            } else {
                echo 'Film du moment non trouvé.';
            }
        } else {
            echo 'Film du moment non trouvé dans film_moment.';
        }
        ?>


        <section class="films-en-salle">
            <div class="films-title">
                <h1>FILM EN SALLES</h1>
            </div>
            <div class="films-container">

                <?php
                try {
                    // Préparer la requête SQL
                    $stmt = $conn->prepare("SELECT * FROM films");
                    
                    // Exécuter la requête
                    $stmt->execute();
                
                    // Récupérer toutes les lignes résultantes
                    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
                }
                ?>

                <?php foreach ($films as $film) : ?>
                    <div class="film">
                        <a href="details.php?id_F=<?= $film['id_F'] ?>">
                            <img src="<?= $film['affiche'] ?>" alt="<?= $film['nom'] ?>">
                            <p class="film-info">
                                <span><?= $film['nom'] ?></span><br>
                                <span class="small-text"><?= $film['genre'] ?></span>
                            </p>
                        </a>
                    </div>
                <?php endforeach; ?>


            </div>
        </section>
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