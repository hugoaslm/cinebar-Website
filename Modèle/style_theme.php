<?php

include '../Modèle/themeClair.php';

 if ($theme==0) {?>
<style>
    body {
    background-color: white;
    }

    footer, header {
    background-color: white;
    }

    nav a {
        color: black;
    }

    footer h3, footer p, footer a {
        color: black;
    }

    .donnees a {
        color: black;
    }

    .vignette-film p, .vignette-film h2 {
        color: white;
    }

    .accueil-cine, .accueil-bar, .carousel-container, .boite3 {
        background-color: rgba(218, 218, 218, 0.888);
    }

    .boite3 h1 {
        color: black;
    }

    .bouton-pro a, .bouton-co a{
    color: white ;
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

    nav a {
        color: white;
    }

    footer h3, footer p, footer a {
        color: white;
    }

    .donnees a {
        color: white;
    }

    .vignette-film p, .vignette-film h2 {
        color: white;
    }

    .accueil-cine, .accueil-bar, .carousel-container, .boite3 {
        background-color: black;
    }

    .boite3 h1 {
        color: black;
    }

    .bouton-pro a, .bouton-co a{
    color: white ;
    }

    .carousel-container h1 {
        color: white;
    }

    .titre-boite3 h1 {
        color: white;
    }

    .acc-bar h1, .acc-bar p {
        color: white;
    }

    .acc-cine h1, .acc-cine p {
        color: white;
    }
</style>
<?php } ?>