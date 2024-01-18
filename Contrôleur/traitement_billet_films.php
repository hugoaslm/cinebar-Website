<?php

session_start();

require "../Modèle/userData.php";
include "../Modèle/bdd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["mail"];
    $film = $_POST["film"];
    $nb = $_POST["places"];
    $horaire = $_POST["horaire"];
    $date = $_POST['date'];

    // Récupération de l'id de projection

    $stmt_projection = $connexion->prepare("SELECT id_Projection FROM projection WHERE date = :date AND heure = :horaire");
    $stmt_projection->bindParam(':date', $date);
    $stmt_projection->bindParam(':horaire', $horaire);
    $stmt_projection->execute();
    $projection_id = $stmt_projection->fetchColumn();

    $user_co = info_userConnected($connexion);
    $utilisateur_id = $user_co['id_Utilisateur'];

    if ($projection_id !== null) {
        // Insertion des données dans la table reservation_film
        $stmt = $connexion->prepare("INSERT INTO reservation_film (nb_reservation, Projection_id_Projection, Utilisateur_id_Utilisateur) VALUES (:places, :projection_id, :utilisateur_id)");
        $stmt->bindParam(':places', $nb);
        $stmt->bindParam(':projection_id', $projection_id);
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

    header("Location: ../billet-confirm");
    exit();

    // Fermer la connexion
    $connexion = null;
}
?>
