<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["mail"];
    $event = $_POST["event"];
    $nb = $_POST["places"];
    $horaires = $_POST["horaires"];
    $date = $_POST['date'];

    include "../Modèle/infos_utilisateur.php";
    include "../Modèle/bdd.php";

    // Récupération de l'id de l'event

    $stmt_event = $connexion->prepare("SELECT id_E FROM events WHERE date = :date AND horaires = :horaires");
    $stmt_event->bindParam(':date', $date);
    $stmt_event->bindParam(':horaires', $horaires);
    $stmt_event->execute();
    $event_id = $stmt_event->fetchColumn();

    $stmt_salle = $connexion->prepare("SELECT Salle_id_Salle FROM events_salle WHERE Event_id_E = :event_id");
    $stmt_salle->bindParam(':event_id', $event_id);
    $stmt_salle->execute();
    $id_salle_event = $stmt_salle->fetchColumn();

    $utilisateur_id = $resultat['id_Utilisateur'];

    if ($event_id !== null) {
        // Insertion des données dans la table reservation_film
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

    header("Location: ../Vue/billet-confirm.php");
    exit();

    // Fermer la connexion
    $connexion = null;
}
?>
