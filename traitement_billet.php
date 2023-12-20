<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Récupère les valeurs du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["mail"];
    $film = $_POST["film"];
    $nb = $_POST["places"];
    $horaire = $_POST["horaire"];

    // Construction de l'e-mail

    // Adresse e-mail à laquelle l'e-mail sera envoyé
    $to = "$email";

    // Sujet de l'e-mail
    $subject = "Réservation pour $film";

    // En-têtes de l'e-mail
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    
    // Adresse e-mail de l'expéditeur (vous pouvez personnaliser cela)
    $headers .= "From: cinebar@gmail.com\r\n";

    // Corps de l'e-mail au format HTML
    $body = "<p><strong>Nom:</strong> $nom</p>";
    $body .= "<p><strong>Prénom:</strong> $prenom</p>";
    $body .= "<p><strong>Email:</strong> $email</p>";
    $body .= "<p><strong>Film:</strong> $film</p>";
    $body .= "<p><strong>Nombre de places:</strong> $nb</p>";
    $body .= "<p><strong>Horaire:</strong> $horaire</p>";

    // Envoi de l'e-mail
    mail($to, $subject, $body, $headers);

    // Redirection après l'envoi de l'e-mail
    header("Location: billet-confirm.php");
    exit();
}
?>
