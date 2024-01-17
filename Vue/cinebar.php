<?php 

session_start();

include "../Modèle/bdd.php";
include '../Modèle/style_theme.php' ?>

<?php

 if ($theme==0) {?>
<style>
    body {
        color: black;
    }

    .contenant {
        color: black;
    }

    .sep {
        display: none;
    }

    .illu, .text {
        margin-bottom: 50px;
    }

    .titre {
        color: black;
    }
</style>
<?php } ?>

<?php if ($theme==1) {?>
<style>

    body {
    background-color: #1E1E1E;
    }

    footer, header {
    background-color: rgb(17, 17, 17);
    }

    .sep {
        display: flex;
    }

    .titre {
        color: white;
    }
</style>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Films à l'affiche">
    <link rel="stylesheet" href="style/style.css">
	<link rel="stylesheet" href="style/cinema.css">
	<link rel="stylesheet" href="style/capteur.css">
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
        <div class="haut-cine">
            <img src="images/darcy.jpg" alt="Cinéma Darcy" >
        </div>
		
        <section class="contenant">
            <div class="titre">La solution <span class="cinebar">CinéBar</span></div>
<br>
            <div class="text">
                <span class="mot_cle">Grâce à la solution CinéBar</span>, nous adoptons une <span class="mot_cle">approche novatrice</span> pour évaluer la réception d'un film par notre public. Notre <span class="mot_cle">système unique de notation</span> est basé sur les applaudissements de l'audience à la fin de chaque projection. 
				En utilisant une <span class="mot_cle">technologie sonore de pointe</span>, nous mesurons le volume des applaudissements, qui nous sert d'indicateur direct de l'appréciation du film.
<br><br>
				Le principe est simple : nous normalisons d'abord le volume sonore des applaudissements en le situant entre un niveau de bruit ambiant (lorsqu'il n'y a pas d'applaudissements) et un niveau maximal (lorsque l'enthousiasme est à son comble). Cette valeur normalisée est ensuite multipliée par 5 pour obtenir une note allant de 0 à 5. 
<br><br>
				<span class="mot_cle">Pourquoi attendre les critiques quand les applaudissements parlent d'eux-mêmes ?</span> 
				Chaque fois que vous voyez une note sur notre site, sachez qu'elle est le reflet direct de <span class="mot_cle">l'enthousiasme de nos spectateurs</span>.
<br><br>
				Alors, <b>prêt à entrer dans le futur de la notation cinématographique ?</b> <span class="mot_cle">CinéBar</span> vous promet une <b>expérience comme nulle part ailleurs !</b>
            </div>
			<div class="sep">
				<img src="../images/separateur.jpg">
			</div>
			
			<div class="illu">
                <img src="../images/bar.jpg">
			</div>
			<div class="text">
				De plus, <span class="mot_cle">un oasis de sérénité vous attend</span>. 
				Au-delà de l'expérience cinématographique, nous voulons que vous profitiez d'un moment de détente dans notre espace bar. 
			<br>C'est là qu'intervient notre <span class="mot_cle">innovation sonore</span>. 
				Notre capteur, discret mais efficace, veille à ce que le niveau sonore demeure toujours idéal, garantissant que les discussions restent privées et que l'ambiance demeure <span class="mot_cle">apaisante</span>.
			</div>
			
			<br><br>
			<div class="text">
				Comment cela fonctionne-t-il ? 
				Notre capteur analyse en permanence l'environnement sonore. 
				Si un niveau sonore élevé est détecté, des mesures immédiates sont prises pour préserver la tranquillité des lieux. 
				Ainsi, chaque visiteur peut savourer son verre dans un <span class="mot_cle">cadre confortable et reposant</span>.
				Là où d'autres espaces peuvent devenir bruyants ou perturbants, notre bar promet une <span class="mot_cle">pause paisible après votre film</span>. 
				Faites l'expérience et laissez-vous surprendre par le niveau de confort offert par <span class="mot_cle">CinéBar</span>.
			</div>
			
        </section>
		
        <section class='sav-plus'>
            <h2>Si vous souhaitez réserver une salle :</h2>
            <div class="bouton-cinebar">
                <a href="pro">Réservation de salles</a>
            </div>
        </section>
		

		
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