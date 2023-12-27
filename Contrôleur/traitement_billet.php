<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["mail"];
    $film = $_POST["film"];
    $nb = $_POST["places"];
    $horaire = $_POST["horaire"];

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

    header("Location: ../Vue/billet-confirm.php");
    exit();
}
?>
