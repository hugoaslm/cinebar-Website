<?php

include 'bdd.php';

function getEvents($connexion) {
    $stmt = $connexion->prepare("SELECT * FROM events");

    $stmt->execute();

    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $events;
}

function getEventMoment($connexion) {
    $sql = "SELECT event_id_E FROM event_moment";
    $stmt = $connexion->query($sql);
    return $stmt;
}

function getEventDetailsById($connexion, $event_id) {

    // Vérifier si l'ID de l'événement est défini
    if ($event_id !== null) {
        
        $stmt_event = $connexion->prepare("SELECT * FROM events WHERE id_E = :event_id");
        $stmt_event->bindParam(':event_id', $event_id);
        $stmt_event->execute();

        $event_details = $stmt_event->fetch(PDO::FETCH_ASSOC);$event_details['affiche'];
    }

    // Retourner les détails de l'événement
    return 
        $event_details;
}

function getAverageDecibelAndNote($connexion, $event_id) {

    $query = "SELECT ROUND(AVG(decibel), 1) AS moyenne_decibel
              FROM donnees_capteur_event
              WHERE events_id_E = :event_id;";

    $stmt = $connexion->prepare($query);

    $stmt->bindParam(':event_id', $event_id);

    $stmt->execute();

    $donnees_capteur_event = $stmt->fetch(PDO::FETCH_ASSOC);

    // Normaliser la valeur en dB
    $min = 50;
    $max = 100;
    $valeurEnDB = number_format($donnees_capteur_event['moyenne_decibel'], 1);
    $valeurNormalisee = ($valeurEnDB - $min) / ($max - $min);

    // Calculer la note associée
    $note = $valeurNormalisee * 5;

    // Calculer la valeur pour le curseur de volume
    $valeurCurseur = round($valeurNormalisee * 100);

    // Retourner les données sous forme de tableau associatif
    return [
        'moyenne_decibel' => $donnees_capteur_event['moyenne_decibel'],
        'note' => $note,
        'valeurEnDB' => $valeurEnDB,
        'valeurCurseur' => $valeurCurseur,
    ];
}

function addEvent($connexion, $nom, $description, $date, $organisateur, $affiche, $salle, $horaires) {

    $sql = "INSERT INTO events (nom, description, date, organisateur, affiche, horaires) VALUES (:nom, :description, :date, :organisateur, :affiche, :horaires)";
    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':organisateur', $organisateur);
    $stmt->bindParam(':affiche', $affiche);
    $stmt->bindParam(':horaires', $horaires);

    $stmt->execute();

    $id_event = $connexion->lastInsertId();

    $sql_salle_event = "INSERT INTO events_salle (Event_id_E, Salle_id_Salle) VALUES (:id_event, :id_salle)";
    $stmt_salle_event = $connexion->prepare($sql_salle_event);

    $stmt_salle_event->bindParam(':id_event', $id_event);
    $stmt_salle_event->bindParam(':id_salle', $salle);

    $stmt_salle_event->execute();

}

function deleteEvent($connexion, $event_id) {

    $sql = "DELETE FROM events WHERE id_E = :event_id";
    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(":event_id", $event_id);

    $stmt->execute();
}

function setEventMoment($connexion, $event_id) {

    $sql_delete = "DELETE FROM event_moment";
    $connexion->exec($sql_delete);

    $sql_insert = "INSERT INTO event_moment (event_id_E) VALUES (:event_id)";
    $stmt_insert = $connexion->prepare($sql_insert);
    $stmt_insert->bindParam(":event_id", $event_id);
    $stmt_insert->execute();
}

function info_userConnected_event($connexion) {
    if (isset($_SESSION['identifiant'])) {
        $identifiant = $_SESSION['identifiant'];

        $query = "SELECT * FROM utilisateur WHERE pseudo = :identifiant";
        $stmt = $connexion->prepare($query);
        $stmt->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
        $stmt->execute();

        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultat;
    }
}

function reserverEvent($connexion, $nom, $prenom, $email, $event, $nb, $horaires, $date) {

    // Récupération de l'ID de l'événement
    $stmt_event = $connexion->prepare("SELECT id_E FROM events WHERE date = :date AND horaires = :horaires");
    $stmt_event->bindParam(':date', $date);
    $stmt_event->bindParam(':horaires', $horaires);
    $stmt_event->execute();
    $event_id = $stmt_event->fetchColumn();

    echo $event_id;

    // Récupération de l'ID de la salle associée à l'événement
    $stmt_salle = $connexion->prepare("SELECT Salle_id_Salle FROM events_salle WHERE Event_id_E = :event_id");
    $stmt_salle->bindParam(':event_id', $event_id);
    $stmt_salle->execute();
    $id_salle_event = $stmt_salle->fetchColumn();

    // Récupération de l'ID de l'utilisateur connecté
    $user_co = info_userConnected_event($connexion);
    $utilisateur_id = $user_co['id_Utilisateur'];

    // Vérifier si l'ID de l'événement est défini
    if ($event_id !== null) {

        // Insertion des données dans la table reservation_event
        $stmt = $connexion->prepare("INSERT INTO reservation_event (nb_reservation, events_salle_Event_id_E, events_salle_Salle_id_Salle, Utilisateur_id_Utilisateur)
         VALUES (:places, :event_id, :id_salle_event, :utilisateur_id)");
        $stmt->bindParam(':places', $nb);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->bindParam(':id_salle_event', $id_salle_event);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);

        // Vérifier les erreurs SQL
        if (!$stmt->execute()) {
            die("Erreur d'exécution de la requête : " . $stmt->errorInfo()[2]);
        }
    }
    else {
        echo 'marche po';
    }

    // Envoyer un email de confirmation
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
                <p><strong>Film:</strong> $event</p>
                <p><strong>Nombre de places:</strong> $nb</p>
                <p><strong>Horaire:</strong> $horaires</p>
                <p>Votre réservation a bien été enregistrée. Nous sommes impatients de vous accueillir !</p>
            </div>
        </body>
        </html>
    ";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";

    $headers .= "From: Cinébar <cinebar@gmail.com>\r\n";

    $subject = "Confirmation de réservation pour $event";

    mail($email, $subject, $body, $headers);

    header("Location: ../billet-confirm");
    exit();
}

function getAllEvents($connexion) {

    $stmt = $connexion->prepare("SELECT id_E, nom FROM events");
    
    $stmt->execute();

    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $events;

}

?>
