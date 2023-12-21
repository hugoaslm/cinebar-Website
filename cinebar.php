<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
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
				<img src="images/separateur.jpg">
			</div>
			
			<div class="illu">
                <img src="images/bar.jpg">
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
            <h2>Si vous souhaitez en apprendre plus sur la solution :</h2>
            <div class="bouton-cinebar">
                <a href="pro.php">Professionnel</a>
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