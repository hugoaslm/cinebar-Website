<?php

include 'bdd.php';

function getFilmDetailsById($connexion, $film_id) {

    // Vérifier si l'ID de l'événement est défini
    if ($film_id !== null) {
        
        $stmt_film = $connexion->prepare("SELECT * FROM films WHERE id_F = :id_F");
        $stmt_film->bindParam(':id_F', $film_id);
        $stmt_film->execute();

        $film_details = $stmt_film->fetch(PDO::FETCH_ASSOC);$film_details['affiche'];
    }

    // Retourner les détails de l'événement
    return 
        $film_details;
            
}

function updateFilmMomentAdmin($db, $filmId) {

    $sqlInsert = "UPDATE film_moment SET film_id_F = :film_id, selection_manuelle = 1";
    $stmtInsert = $db->prepare($sqlInsert);
    $stmtInsert->bindParam(":film_id", $filmId, PDO::PARAM_INT);
    $stmtInsert->execute();
}

function addFilm($db, $nom, $acteurs, $description, $DateDeSortie, $duree, $realisateur, $affiche, $genres) {

    $genre_str = implode(", ", $genres);

    $sql = "INSERT INTO films (nom, genre, acteurs, description, DateDeSortie, duree, realisateur, affiche) VALUES (:nom, :genre, :acteurs, :description, :DateDeSortie, :duree, :realisateur, :affiche)";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':genre', $genre_str);
    $stmt->bindParam(':acteurs', $acteurs);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':DateDeSortie', $DateDeSortie);
    $stmt->bindParam(':duree', $duree);
    $stmt->bindParam(':realisateur', $realisateur);
    $stmt->bindParam(':affiche', $affiche);

    $stmt->execute();

}

function deleteFilm($db, $filmId) {

    $sqlDelete = "DELETE FROM films WHERE id_F = :film_id";
    $stmtDelete = $db->prepare($sqlDelete);
    $stmtDelete->bindParam(":film_id", $filmId, PDO::PARAM_INT);
    $stmtDelete->execute();

}

function deleteProjection($db, $projectionId) {

    $sqlDelete = "DELETE FROM projection WHERE id_Projection = :proj_id";
    $stmtDelete = $db->prepare($sqlDelete);
    $stmtDelete->bindParam(":proj_id", $projectionId, PDO::PARAM_INT);
    $stmtDelete->execute();

}

function addProjection($db, $idSalle, $idFilm, $horaire, $dateProjection) {

    $sql = "INSERT INTO projection (films_salle_salle_id_Salle, films_salle_films_id_F, heure, date) VALUES (:idSalle, :idFilm, :horaire, :dateProjection)";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':idSalle', $idSalle);
    $stmt->bindParam(':idFilm', $idFilm);
    $stmt->bindParam(':horaire', $horaire);
    $stmt->bindParam(':dateProjection', $dateProjection);

    $stmt->execute();
}

function reserverFilm($db, $nom, $prenom, $email, $film, $nb, $horaire, $date) {

    $stmtProjection = $db->prepare("SELECT id_Projection FROM projection WHERE date = :date AND heure = :horaire");
    $stmtProjection->bindParam(':date', $date);
    $stmtProjection->bindParam(':horaire', $horaire);
    $stmtProjection->execute();
    $projectionId = $stmtProjection->fetchColumn();

    $userConnected = info_userConnected($db);
    $utilisateurId = $userConnected['id_Utilisateur'];

    if ($projectionId !== null) {

        $stmt = $db->prepare("INSERT INTO reservation_film (nb_reservation, Projection_id_Projection, Utilisateur_id_Utilisateur) VALUES (:places, :projectionId, :utilisateurId)");
        $stmt->bindParam(':places', $nb);
        $stmt->bindParam(':projectionId', $projectionId);
        $stmt->bindParam(':utilisateurId', $utilisateurId);

    }

    $body = "
        <html>
        <head>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    background-color: #f4f4f4;
                    padding: 20px;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    color: #89404F;
                }
                p {
                    margin-bottom: 15px;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Merci pour votre réservation au Cinébar !</h2>
                <p><strong>Nom:</strong> $nom</p>
                <p><strong>Prénom:</strong> $prenom</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Film:</strong> $film</p>
                <p><strong>Nombre de places:</strong> $nb</p>
                <p><strong>Horaire:</strong> $horaire</p>
                <p>Votre réservation a bien été enregistrée. Nous sommes impatients de vous accueillir !</p>
            </div>
        </body>
        </html>
    ";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";

    $headers .= "From: Cinébar <cinebar@gmail.com>\r\n";

    $subject = "Confirmation de réservation pour $film";

    mail($email, $subject, $body, $headers);

}

function getFilmMomentId($db) {

    $sql = "SELECT film_id_F FROM film_moment";
    $stmt = $db->query($sql);

    $film_id = $stmt->fetch(PDO::FETCH_ASSOC)['film_id_F'];

    return $film_id;
}

function getLatestReleaseId($db) {

    $sql = "SELECT id_F FROM films ORDER BY DateDeSortie DESC LIMIT 1";
    $stmt = $db->query($sql);

    $filmId = $stmt->fetchColumn();

    return $filmId;
}

function getAllFilms($db) {

    $stmt = $db->prepare("SELECT * FROM films");
        
    $stmt->execute();

    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $films;
}

function getAllProjections($db) {

    $stmt = $db->prepare("SELECT * FROM projection");
        
    $stmt->execute();

    $proj = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $proj;
}

function getReservationChamps($db, $projectionId) {
    $defaultValues = [
        'nom' => '',
        'prenom' => '',
        'email' => '',
        'film' => '',
        'places' => '',
        'date' => '',
        'horaire' => ''
    ];

    // Vérifier si l'ID de la projection est défini
    if ($projectionId !== null) {
        $stmtProjection = $db->prepare("SELECT films_salle_films_id_F, date, heure FROM projection WHERE id_Projection = :id_Projection");
        $stmtProjection->bindParam(':id_Projection', $projectionId);
        $stmtProjection->execute();
        $projectionDetails = $stmtProjection->fetch(PDO::FETCH_ASSOC);

        // Si la projection est trouvée, mettre à jour les valeurs par défaut
        if ($projectionDetails) {
            $defaultValues['film'] = $projectionDetails['films_salle_films_id_F'];

            $stmtFilm = $db->prepare("SELECT nom FROM films WHERE id_F = :id_Film");
            $stmtFilm->bindParam(':id_Film', $defaultValues['film']);
            $stmtFilm->execute();
            $defaultValues['nom'] = $stmtFilm->fetchColumn();

            $defaultValues['date'] = $projectionDetails['date'];
            $defaultValues['horaire'] = $projectionDetails['heure'];
        }
    }

    return $defaultValues;
}

function idAllFilms($connexion) {

    $stmt = $connexion->prepare("SELECT id_F, nom FROM films");
    
    $stmt->execute();

    $film = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $film;

}

?>
