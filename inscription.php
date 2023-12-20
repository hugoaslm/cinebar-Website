<?php
// A utiliser avec une méthode post et mettre dans le code html : 
// method="POST" action="register.php" dans votre formulaire 
// Vérification si la méthode POST est utilisée pour envoyer des données
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des informations du formulaire
    $email = $_POST["mail"];
    $password = $_POST["mdp"];
    $pseudo = $_POST["pseudo"];

    // Connexion à la base de données
    $serveur = 'localhost'; 
    $utilisateur_db = 'root'; 
    $mot_de_passe_db = 'bddisep19'; 
    $nom_base_de_donnees = 'cinebar'; 

    try {
        // Connexion à la base de données via PDO
        $connexion = new PDO("mysql:host=$serveur;dbname=$nom_base_de_donnees", $utilisateur_db, $mot_de_passe_db);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérification si l'utilisateur existe déjà
        $check_user_query = $connexion->prepare("SELECT * FROM `utilisateur` WHERE `mail` = :email");
        $check_user_query->bindParam(':email', $email);
        $check_user_query->execute();
        
        if ($check_user_query->rowCount() > 0) {
            // L'utilisateur existe déjà
            echo "L'utilisateur existe déjà. Veuillez vous connecter.";
        } else {
            // Insertion des données de l'utilisateur dans la base de données
            $insert_user_query = $connexion->prepare("INSERT INTO `utilisateur` (`pseudo`, `mail`, `MotDePasse`) VALUES (:pseudo, :email, :password)");
            $insert_user_query->bindParam(':pseudo', $pseudo);
            $insert_user_query->bindParam(':email', $email);
            $insert_user_query->bindParam(':password', $password);
            $insert_user_query->execute();

            header("Location: connexion.php");
            echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
            exit();
        }
    } catch (PDOException $e) {
        // En cas d'erreur de connexion ou d'exécution de requête
        echo "Erreur : " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/connexion.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        
        <nav>
            
            <img src="images/logo-cinebar.png" alt="Logo Cinébar" >
            <div class="pages">
                <a href="accueil.php">Accueil</a>
                <a href="cinema.php">Le Cinéma</a>
                <a href="rooftop.php">La Cafétéria</a>
                <a href="films.php">Films</a>
                <a href="events.php">Évènements</a>
                <a href="billet.php">Billetterie</a>
                <a href="forum.php">Forum</a>
            </div>
            <div class="bouton-access">
                <div class="bouton-pro">
                    <a href="pro.php">Professionnel</a>
                </div>

                <?php

                session_start();

                // Vérifiez si l'utilisateur est connecté en vérifiant la présence de la variable de session
                $estConnecte = isset($_SESSION['identifiant']);

                // Sélectionnez le bouton de connexion en PHP
                $boutonConnexion = '<div class="bouton-co">';
                if ($estConnecte) {
                    $identif = $_SESSION['identifiant'];
                    $boutonConnexion .= '<a href="profil.php">' . $identif . ' <i class="fas fa-user"></i></a>';
                } else {
                    // Si non connecté, affichez le bouton de connexion normal
                    $boutonConnexion .= '<a href="connexion.php">Connexion <i class="fas fa-user"></i></a>';
                }
                $boutonConnexion .= '</div>';

                // Affichez le bouton de connexion généré
                echo $boutonConnexion;
                ?>
                
            </div>
        </nav>
        
    </header>

    <main class='connexion'>
        <form action="inscription.php" method="post" class="inscription">
            <div class="form-text" id="sugg">
                <p>
                    <label for="mail">Pseudonyme :</label>
                    <input type="text" id="pseudo" name="pseudo">
                </p>
                <p>
                    <label for="mail">E-mail :</label>
                    <input type="text" id="mail" name="mail">
                </p>
                <p>
                    <label for="mdp">Mot de passe :</label>
                    <input type="text" id="mdp" name="mdp">
                </p>
                <p>
                    <label for="mdp">Confirmer le mot de passe :</label>
                    <input type="text" id="mdp" name="mdp">
                </p>
            </div>
            <div class="co-bouton">
                <button name="send" type="submit">S'inscrire</button>
            </div>
        </form>
    </main>

    <footer>
        <section class='logo-adresse'>
            <img src="images/logo-cinebar.png" alt="Logo Cinébar" >
            <div>
                <h3>Adresse :</h3>
                Place Darcy <br>
                <a>21000 - Dijon</a>
            </div>
        </section>
        <div class="donnees">
            <a href="cookies.php">Gestion des cookies</a> - 
            <a href="cgu.php">CGU</a> - 
            <a href="faq.php">FAQ</a>
        </div>        
    </footer>

</body>
</html>