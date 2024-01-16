<?php
session_start();

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FAQ">
    <title>FAQ</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/faq.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Montserrat&display=swap" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
</head>

<body>

  <header>
    <nav>    
    <img src="../images/logo-cinebar.png" alt="Logo Cinébar" >
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
    <?php
      // Inclure le fichier de connexion à la base de données
      include '../Modèle/bdd.php';

      // Requête SQL pour récupérer les questions et réponses de la FAQ
      $sql = "SELECT * FROM faq";
      $stmt = $connexion->query($sql);

      // Vérifier si la requête a réussi
      if ($stmt) {
          // Récupérer toutes les questions et réponses de la FAQ
          $faqs = $stmt->fetchAll(PDO::FETCH_ASSOC);

          // Afficher chaque question et réponse dans la structure HTML
          echo "<div class='wrapper'>";
          echo "<h1>Foire Aux Questions</h1>";

          foreach ($faqs as $faq) {
              echo "<div class='faq'>";
              echo "<button class='accordion'>";
              echo $faq['question'];
              echo "<i class='fa-solid fa-chevron-down'></i>";
              echo "</button>";
              echo "<div class='pannel'>";
              echo "<p>";
              echo $faq['reponse'];
              echo "</p>";
              echo "</div>";
              echo "</div>";
          }

          echo "</div>";
      } else {
          // En cas d'erreur lors de l'exécution de la requête
          echo "Erreur lors de la récupération des questions et réponses de la FAQ.";
      }

      // Fermer la connexion à la base de données
      $connexion = null;
      ?>
        
        <script>
            var acc = document.getElementsByClassName("accordion");
            var i;
      
            for (i = 0; i < acc.length; i++) {
              acc[i].addEventListener("click", function () {
                this.classList.toggle("active");
                this.parentElement.classList.toggle("active");
      
                var pannel = this.nextElementSibling;
      
                if (pannel.style.display === "block") {
                  pannel.style.display = "none";
                } else {
                  pannel.style.display = "block";
                }
              });
            }
          </script>
    </main>

    <footer>
        <section class='logo-adresse'>
            <img src="../images/logo-cinebar.png" alt="Logo Cinébar" >
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