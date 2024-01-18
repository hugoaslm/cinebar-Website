<?php

function rechercherTermes($connexion, $termeRecherche) {
    
    $termeRecherche = "%" . $termeRecherche . "%";

    $sqlFilms = "SELECT * FROM films WHERE nom LIKE :termeRecherche";
    $stmtFilms = $connexion->prepare($sqlFilms);
    $stmtFilms->bindParam(':termeRecherche', $termeRecherche, PDO::PARAM_STR);
    $stmtFilms->execute();

    $sqlEvents = "SELECT * FROM events WHERE nom LIKE :termeRecherche";
    $stmtEvents = $connexion->prepare($sqlEvents);
    $stmtEvents->bindParam(':termeRecherche', $termeRecherche, PDO::PARAM_STR);
    $stmtEvents->execute();

    $resultats = array(
        'films' => $stmtFilms->fetchAll(PDO::FETCH_ASSOC),
        'events' => $stmtEvents->fetchAll(PDO::FETCH_ASSOC)
    );

    return $resultats;
}

?>
