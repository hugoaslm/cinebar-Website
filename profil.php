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
    <link rel="stylesheet" href="style/profil.css">
    <!-- Ajoutez les liens vers d'autres fichiers CSS si nécessaire -->
</head>

<body>

<header>
    <nav>
        <img src="images/logo-cinebar.png" alt="Logo Cinébar">
        <div class="pages">
            <a href="accueil.php">Accueil</a>
            <a href="cinema.html">Le Cinéma</a>
            <a href="rooftop.html">La Cafétéria</a>
            <a href="films.html">Films</a>
            <a href="events.html">Évènements</a>
            <a href="billet.html">Billetterie</a>
            <a href="forum.html">Forum</a>
        </div>
        <div class="bouton-access">
            <div class="bouton-pro">
                <a href="pro.html">Professionnel</a>
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

<main>
    <h1>Bienvenue, <?php echo $identifiant; ?>!</h1>

    <?php if ($estAdmin): ?>
        <!-- Section spécifique pour les administrateurs -->
        <section>
            <h2>Options d'administration</h2>
            <p>Choisissez une option :</p>
            <ul>
                <li><a href="dashboard_user.php">Gestion du Compte</a></li>
                <li><a href="dashboard_admin.php">Interface d'Administration</a></li>
            </ul>
        </section>
    <?php else: ?>
        <!-- Inclure le tableau de bord de l'utilisateur non administrateur -->
        <?php include("dashboard_user.php"); ?>
    <?php endif; ?>

    <!-- Ajoutez d'autres sections en fonction de vos besoins -->

    <div class="bouton-deco">
        <a href="logout.php">Se déconnecter</a>
    </div>

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
        <a href="cookies.html">Gestion des cookies</a> -
        <a href="cgu.html">CGU</a> -
        <a href="faq.html">FAQ</a>
    </div>
</footer>

</body>

</html>


