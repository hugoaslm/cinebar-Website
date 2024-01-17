<?php
// Vérification si la méthode POST est utilisée pour envoyer des données
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des informations du formulaire
    $identifiant = $_POST["identifiant"];
    $password = $_POST["mdp"];

    include '../Modèle/bdd.php';

    // Requête pour récupérer l'utilisateur par son identifiant (mail ou pseudo)
    $requete = $connexion->prepare("SELECT * FROM `utilisateur` WHERE `mail` = :identifiant OR `pseudo` = :identifiant");
    $requete->bindParam(':identifiant', $identifiant);
    $requete->execute();

    // Vérification si l'utilisateur existe bien 
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);

    if (password_verify($password, $resultat['MotDePasse'])) {
        // Mot de passe correct, connectez l'utilisateur
        session_start();
        $_SESSION['identifiant'] = $resultat['pseudo'];
    
        // Ajoutez des messages de débogage
        echo "Connexion réussie. Redirection en cours...";
        header("Location: ../accueil");
        exit();
    } else {
        // Sinon on affiche un message d'erreur
        echo "Adresse e-mail, pseudo ou mot de passe incorrect.";
    }
}
?>