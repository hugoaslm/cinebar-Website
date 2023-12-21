<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/faq.css">
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

                // Vérifiez si l'utilisateur est connecté en vérifiant la présence de la variable de session
                $estConnecte = isset($_SESSION['identifiant']);

                // Sélectionnez le bouton de connexion en PHP
                $boutonConnexion = '<div class="bouton-co">';
                if ($estConnecte) {
                    $identifiant = $_SESSION['identifiant'];
                    $boutonConnexion .= '<a href="profil.php">' . $identifiant . '</a>';
                } else {
                    // Si non connecté, affichez le bouton de connexion normal
                    $boutonConnexion .= '<a href="connexion.php">Connexion </a>';
                }
                $boutonConnexion .= '</div>';

                // Affichez le bouton de connexion généré
                echo $boutonConnexion;
                ?>

            </div>
        </nav>
  </header>

    <main>
        <div class="wrapper">
            <h1>Foire Aux Questions</h1>
      
            <div class="faq">
              <button class="accordion">
                Cinébar, c'est quoi ?
                <i class="fa-solid fa-chevron-down"></i>
              </button>
              <div class="pannel">
                <p>
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
                  saepe molestiae distinctio asperiores cupiditate consequuntur dolor
                  ullam, iure eligendi harum eaque hic corporis debitis porro
                  consectetur voluptate rem officiis architecto.
                </p>
              </div>
            </div>
      
            <div class="faq">
              <button class="accordion">
                Comment ça marche ?
                <i class="fa-solid fa-chevron-down"></i>
              </button>
              <div class="pannel">
                <p>
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
                  saepe molestiae distinctio asperiores cupiditate consequuntur dolor
                  ullam, iure eligendi harum eaque hic corporis debitis porro
                  consectetur voluptate rem officiis architecto.
                </p>
              </div>
            </div>
            <div class="faq">
                <button class="accordion">
                  Comment puis-je acheter des billets en ligne ?
                  <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="pannel">
                  <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
                    saepe molestiae distinctio asperiores cupiditate consequuntur dolor
                    ullam, iure eligendi harum eaque hic corporis debitis porro
                    consectetur voluptate rem officiis architecto.
                  </p>
                </div>
              </div>
        
              <div class="faq">
                <button class="accordion">
                  Y a-t-il des réductions pour les étudiants, les seniors ou les enfants ?
                  <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="pannel">
                  <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
                    saepe molestiae distinctio asperiores cupiditate consequuntur dolor
                    ullam, iure eligendi harum eaque hic corporis debitis porro
                    consectetur voluptate rem officiis architecto.
                  </p>
                </div>
              </div>
              <div class="faq">
                <button class="accordion">
                  Y a-t-il un parking disponible près du cinéma ?
                  <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="pannel">
                  <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
                    saepe molestiae distinctio asperiores cupiditate consequuntur dolor
                    ullam, iure eligendi harum eaque hic corporis debitis porro
                    consectetur voluptate rem officiis architecto.
                  </p>
                </div>
              </div>
        
              <div class="faq">
                <button class="accordion">
                  Quelles sont les installations pour les personnes à mobilité réduite ?
                  <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="pannel">
                  <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
                    saepe molestiae distinctio asperiores cupiditate consequuntur dolor
                    ullam, iure eligendi harum eaque hic corporis debitis porro
                    consectetur voluptate rem officiis architecto.
                  </p>
                </div>
              </div>
        </div>
        
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