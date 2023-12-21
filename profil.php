<?php
// Connexion à la base de données
$serveur = 'localhost'; 
$utilisateur_db = 'root'; 
$mot_de_passe_db = 'bddisep19'; 
$nom_base_de_donnees = 'cinebar';

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$nom_base_de_donnees", $utilisateur_db, $mot_de_passe_db);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

// Vérifier si l'utilisateur est connecté (exemple : en utilisant une variable de session)
session_start();

// Vérifier le statut administrateur de l'utilisateur en interrogeant la base de données
$estAdmin = false; // Initialisez à false par défaut

if (isset($_SESSION['identifiant'])) {
    $identifiant = $_SESSION['identifiant'];

    // Interroger la base de données pour obtenir la valeur de l'attribut admin
    $query = "SELECT admin FROM utilisateur WHERE pseudo = :identifiant";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
    $stmt->execute();

    // Récupérer le résultat
    $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier la valeur de l'attribut admin
    if ($resultat && $resultat['admin'] == 1) {
        $estAdmin = true;
        $role = 'Administrateur';
    } else {
        $role = 'Utilisateur';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/user.css">
</head>

<body>

<header>
    <nav>
        <img src="images/logo-cinebar.png" alt="Logo Cinébar">
        <div class="pages">
            <a href="accueil.php">Accueil</a>
            <a href="cinema.php">Le Cinéma</a>
            <a href="cafet.php">La Cafétéria</a>
            <a href="films.php">Films</a>
            <a href="events.php">Évènements</a>
            <a href="billet.php">Billetterie</a>
            <a href="forum.php">Forum</a>
        </div>
        <div class="bouton-access">
            <div class="bouton-pro">
                <a href="pro.php">Réservation de salles</a>
            </div>
            <?php
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

<main class="profil">
    <h1>Bienvenue <span class="mot_cle"><?php echo $identifiant; ?> </span> !</h1>

    <?php
    if ($estAdmin) :
    ?>
        <section class="profil-options">
            <h2>Options d'administration :</h2>
            <p>Choisissez une option :</p>
            <ul>
                <li><a class="profil-link" href="dashboard_user.php">Gestion du Compte</a></li>
                <li><a class="profil-link" href="dashboard_admin.php">Interface d'Administration</a></li>
            </ul>
        </section>
    <?php
    else:
        header("Location: dashboard_user.php");
        exit;
    endif;
    ?>

</main>

<footer>
    <section class='logo-adresse'>
        <img src="images/logo-cinebar.png" alt="Logo Cinébar">
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


