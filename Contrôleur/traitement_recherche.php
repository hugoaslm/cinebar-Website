<?php

include '../Modèle/bdd.php';

require_once '../Modèle/rechercheData.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $termeRecherche = $_POST['recherche'];

    $resultats = rechercherTermes($connexion, $termeRecherche);

    $films = $resultats['films'];
    $events = $resultats['events'];
    
}
?>

