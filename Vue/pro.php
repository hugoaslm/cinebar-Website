<?php 

session_start();

include '../Modèle/themeClair.php';

include '../Modèle/style_theme.php' ?>

<?php

 if ($theme==0) {?>
<style>
    body {
        color: black;
    }

    .salles ul li {
        color: white;
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

    main a {
        color: white;
    }
</style>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Salles">
    <title>Salles</title>
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
                <a href="accueil">Accueil</a>
                <a href="cinema">Le Cinéma</a>
                <a href="cafet">La Cafétéria</a>
                <a href="films">Films</a>
                <a href="events">Évènements</a>
                <a href="forum">Forum</a>
            </div>
            <div class="bouton-access">
                <form class="container" action="recherche" method="POST">
                    <input type="text" placeholder="Rechercher..." name="recherche">
                    <div class="search"></div>
                </form>

                <div class="bouton-pro">
                    <a href="pro">Réservation de salles</a>
                </div>

                <?php

                // Vérifiez si l'utilisateur est connecté en vérifiant la présence de la variable de session
                $estConnecte = isset($_SESSION['identifiant']);

                // Sélectionnez le bouton de connexion en PHP
                $boutonConnexion = '<div class="bouton-co">';
                if ($estConnecte) {
                    $identif = $_SESSION['identifiant'];
                    $boutonConnexion .= '<a href="profil"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" 
                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - 
                    https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> '
                      . $identif . ' </a>';
                    $boutonConnexion .= '<div class="menu-deroulant">';
                    $boutonConnexion .= '<a href="Contrôleur/deconnexion.php">Se déconnecter</a>';
                    $boutonConnexion .= '</div>';
                } else {
                    // Si non connecté, affichez le bouton de connexion normal
                    $boutonConnexion .= '<a href="connexion">Connexion</a>';
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
        <?php
        
        include '../Modèle/bdd.php';

        // Préparer la requête SQL
        $stmt = $connexion->prepare("SELECT * FROM salle WHERE nom_salle != 'cafet'");
            
        // Exécuter la requête
        $stmt->execute();

        // Récupérer toutes les lignes résultantes
        $salles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <section class='salles'>
            <?php foreach ($salles as $salle) : ?>
                <div>
                    <h2><?php echo htmlspecialchars($salle['nom_salle']); ?></h2>
                    <ul>
                        <li><?php echo htmlspecialchars($salle['capacite_salle']); ?> places</li>
                        <li><?php echo htmlspecialchars($salle['equipement_salle']); ?></li>
                    </ul>
                    <p>
                        <a href="#form">Réserver</a>
                    </p>
                </div>
            <?php endforeach; ?>
        </section>

        <?php
        $conn = null;
        ?>

        <section id="form" class='form'>
            <h1>FORMULAIRE DE RESERVATION DE SALLES</h1>
            <form action="Contrôleur/ajouter_reservation.php" method="post" class="form-container">
                <div class="form-column">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required>
                    <label for="mail">E-mail :</label>
                    <input type="mail" id="mail" name="mail" required>

                    <h3>Choix de la salle :</h3>
                    <div class="choix-salles">
                        <?php foreach ($salles as $salle) : ?>
                            <div class="salle-option">
                                <input type="radio" id="<?php echo htmlspecialchars($salle['id_Salle']); ?>" name="salle" value="<?php echo htmlspecialchars($salle['id_Salle']); ?>" data-types="<?php echo htmlspecialchars($salle['type']); ?>">
                                <label for="<?php echo htmlspecialchars($salle['id_Salle']); ?>"><?php echo htmlspecialchars($salle['nom_salle']); ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <h3>Types d'évènements :</h3>
                    <div class="type-event">
                        <div>
                            <input type="radio" id="conf" name="type_event" value="Conférence">
                            <label for="conf">Conférence</label>
                        </div>
                    
                        <div>
                            <input type="radio" id="proj" name="type_event" value="Projection de film">
                            <label for="proj">Projection de film</label>
                        </div>
                    
                        <div>
                            <input type="radio" id="humour" name="type_event" value="Spectacle Humoristique">
                            <label for="humour">Spectacle Humoristique</label>
                        </div>
                    
                        <div>
                            <input type="radio" id="theatre" name="type_event" value="Pièce de théâtre">
                            <label for="theatre">Pièce de théâtre</label>
                        </div>
                    </div>                   

                </div>
                <div class="form-column">
                    <label for="text">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" required>
                    <label for="num">Numéro de téléphone :</label>
                    <input type="text" id="num" name="num" required>

                    <label for="date">Date de l'évènement :</label>
                    <input type="date" id="date" name="date" required>
                    <label for="text">Horaires :</label>
                    <input type="text" id="text" name="horaires" required>
                    <label for="number">Nombre d'invités :</label>
                    <input type="number" id="number" name="number" required>

                    <h3>Equipements nécessaires si besoin :</h3>
                    <?php $equipements = [
                        'Microphone',
                        'Projecteur',
                        'Pupitre',
                        'Tableau blanc',
                        'Podium'
                    ]; ?>
                    <div class="equip-checkboxes">
                        <?php foreach ($equipements as $equipement) : ?>
                            <div class="equipement-option">
                                <input type="checkbox" id="<?php echo htmlspecialchars($equipement); ?>" name="equip[]" value="<?php echo htmlspecialchars($equipement); ?>">
                                <label for="<?php echo htmlspecialchars($equipement); ?>"><?php echo htmlspecialchars($equipement); ?></label>
                            </div>
                        <?php endforeach; ?>
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

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const choixSalles = document.querySelectorAll('.choix-salles input[name="salle"]');
                const typeEventsContainer = document.querySelector('.type-event');

                choixSalles.forEach(function (salle) {
                    salle.addEventListener('change', function () {
                        // Récupérer les types d'événements associés à la salle sélectionnée
                        const selectedSalleId = salle.value;
                        const selectedSalle = document.getElementById(selectedSalleId);
                        const typesAssocies = selectedSalle ? selectedSalle.dataset.types.split(',') : [];

                        // Supprimer les anciennes options
                        typeEventsContainer.innerHTML = '';

                        // Ajouter les nouvelles options
                        typesAssocies.forEach(function (typeAssocie) {
                            const typeEvent = document.createElement('div');
                            typeEvent.innerHTML = `
                                <input type="radio" id="${typeAssocie}" name="type_event" value="${typeAssocie}">
                                <label for="${typeAssocie}">${typeAssocie}</label>
                            `;
                            typeEventsContainer.appendChild(typeEvent);
                        });
                    });
                });
            });
        </script>

    </main>

    <footer>
        <section class='logo-adresse'>
            <img src="images/logo-cinebar.png" alt="Logo Cinébar" >
            <div>
                <h3>Adresse :</h3>
                <p>8 Prom. Coeur de Ville</p>
                <a>92130- Issy-les-Moulineaux</a>
            </div>
        </section>
        <div class="donnees">
            <a href="cookies">Gestion des cookies</a> - 
            <a href="cgu">CGU</a> - 
            <a href="faq">FAQ</a>
        </div>        
    </footer>

</body>
</html>
