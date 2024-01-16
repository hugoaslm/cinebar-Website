<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des informations du formulaire
    $email = $_POST["mail"];
    $password = $_POST["mdp"];
    $pseudo = $_POST["pseudo"];

    include '../Modèle/bdd.php';

    // Vérification du captcha
    $recaptcha_secret = "6LdKIEopAAAAAM34t8K5V5yFEpTuc3-IvZZBLK-C";
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";
    $recaptcha_data = [
        'secret' => $recaptcha_secret,
        'response' => $recaptcha_response,
    ];

    $recaptcha_options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($recaptcha_data),
        ],
    ];

    $recaptcha_context = stream_context_create($recaptcha_options);
    $recaptcha_result = file_get_contents($recaptcha_url, false, $recaptcha_context);
    $recaptcha_data = json_decode($recaptcha_result);

    if (!$recaptcha_data->success) {
        echo "Veuillez remplir correctement le captcha.";
        exit();
    }

    // Vérification si l'utilisateur existe déjà
    $check_user_query = $connexion->prepare("SELECT * FROM `utilisateur` WHERE `mail` = :email");
    $check_user_query->bindParam(':email', $email);
    $check_user_query->execute();

    if ($check_user_query->rowCount() > 0) {
        // L'utilisateur existe déjà
        echo "L'utilisateur existe déjà. Veuillez vous connecter.";
    } else {
        // Hachage du mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertion des données de l'utilisateur dans la base de données avec le mot de passe haché
        $insert_user_query = $connexion->prepare("INSERT INTO `utilisateur` (`pseudo`, `mail`, `MotDePasse`) VALUES (:pseudo, :email, :hashed_password)");
        $insert_user_query->bindParam(':pseudo', $pseudo);
        $insert_user_query->bindParam(':email', $email);
        $insert_user_query->bindParam(':hashed_password', $hashed_password);
        $insert_user_query->execute();

        header("Location: ../Vue/connexion.php");
        echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
        exit();
    }
}

?>