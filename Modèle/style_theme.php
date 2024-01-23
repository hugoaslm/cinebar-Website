<?php

include '../Modèle/themeClair.php';

# Thème clair
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
    
    .form_billet h1 {
        color: black;
    }

    .desc-bar-cine p {
    color: black;
    }

    .sav-plus h2 {
    color: black;
    }

    .block-aside h2 {
    color: black;
    }

    .menu-list li {
    color: black;
    }

    .menu h1 {
    color: black;
    }

    svg {
        fill: black;
    }

    .capteur_bar h1 {
        color: black;
    }

    .vol_bar span {
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

    .container-films {
    color: black;
    }

    .note h1, .reservation h1 {
        color: black;
    }

    .reserv-billet select,
    .reserv-billet input {
    border: solid 2px black;
    }

    .info svg {
        fill: rgba(0, 0, 0, 0);
    }

    .event a {
        color: white;
    }

    .vedette {
        color: white;
    }

    .film-info {
        color: white;
    }

    .film-vedette {
        color: white;
    }

    #questionForm label {
        color: white;
    }

    .profil-options {
        border: solid 1px black;
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

    .desc-bar-cine p {
    color: white;
    }

    .sav-plus h2 {
    color: white;
    }

    .block-aside h2 {
    color: white;
    }

    .aside-list {
        color: white;
    }

    .menu-list li {
    color: white;
    }

    .menu h1 {
    color: white;
    }

    svg {
        fill: white;
    }

    .description-bar-cine h1 {
        color: white;
    }

    .capteur_bar h1 {
        color: white;
    }

    .vol_bar span {
        color: white;
    }

    .vignette-film svg {
        fill: rgba(0, 0, 0, 0);
    }

    .info svg {
        fill: rgba(0, 0, 0, 0);
    }

    .sep {
        display: flex;
    }

    .titre {
        color: white;
    }

    .reserv-billet select,
    .reserv-billet input {
    border: none;
    }

    .container-films {
    color: white;
    }

    .note h1, .reservation h1 {
        color: white;
    }

    .details h2, h4, .details p {
    color: white;
    }

    .details {
        color: white;
    }

    .cast p {
        color: white;
    }

    .event a {
        color: white;
    }

    .film-vedette {
        color: white;
    }

    .film-info {
        color: white;
    }

    #questionForm label {
        color: white;
    }

    .profil-options {
        border: solid 1px white;
    }
</style>
<?php } ?>