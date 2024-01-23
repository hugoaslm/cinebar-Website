<?php

session_start();

include '../Modèle/style_theme.php';

require_once "../Modèle/userData.php";

require_once "../Modèle/forumData.php";

include '../Modèle/bdd.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    $isAuthenticated = false;
} else {
    $isAuthenticated = true;
}

$result = RepQuestForum($connexion);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Films à l'affiche">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/forum.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum de Questions-Réponses</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-bi+2BIvPHs5peU+5wDTrAYu9fEF+j4uANCBF8bXaSv1ap4SC1vY+gJEAY6npa9vm4tft9NxLXR+rWn5eknjOXA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
</head>

<body>


    <header>
        <nav>
            
            <img src="images/logo-cinebar.png" alt="Logo Cinébar" >
            <div class="pages">
                <a href="accueil">Accueil</a>
                <a href="cinema">Le Cinéma</a>
                <a href="cafet">La Cafétéria</a>
                <a href="films">Films</a>
                <a href="events">Évènements</a>
                <a href="forum">Forum</a>
            </div>
            <div class="bouton-access">
                <form class="container" action="recherche" method="POST">
                    <input type="text" placeholder="Rechercher..." name="recherche">
                    <div class="search"></div>
                </form>

                <div class="bouton-pro">
                    <a href="pro">Réservation de salles</a>
                </div>

                <?php

                // Vérifier si l'utilisateur est connecté en vérifiant la présence de la variable de session
                $estConnecte = isset($_SESSION['identifiant']);

                // Sélectionner le bouton de connexion en PHP
                $boutonConnexion = '<div class="bouton-co">';
                if ($estConnecte) {
                    $identif = $_SESSION['identifiant'];
                    $boutonConnexion .= '<a href="profil"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" 
                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - 
                    https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> '
                      . $identif . ' </a>';
                    $boutonConnexion .= '<div class="menu-deroulant">';
                    $boutonConnexion .= '<a href="Contrôleur/deconnexion.php">Se déconnecter</a>';
                    $boutonConnexion .= '</div>';
                } else {
                    // Si non connecté, afficher le bouton de connexion normal
                    $boutonConnexion .= '<a href="connexion">Connexion</a>';
                }
                $boutonConnexion .= '</div>';

                // Afficher le bouton de connexion généré
                echo $boutonConnexion;
                ?>

            </div>
        </nav>
    </header>
  

    <section id="questionsSection">

        <h2>Questions et réponses :</h2> <br>

        <?php

        $uniqueQuestionIds = [];

        foreach ($result as $row) {
            $questionId = $row['id_Forum_question'];

            // Vérifier si l'ID de la question a déjà été traité
            if (!in_array($questionId, $uniqueQuestionIds)) {

                echo "<div class='cgu-content'>";

                $date = new DateTime($row['question_date']);

                // Définir les noms des jours et des mois en français
                $jours = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
                $mois = [null, 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

                // Formatage de la date en français
                $formatted_date = $jours[$date->format('w')] . ' ' . $date->format('j') . ' ' . $mois[$date->format('n')] . ' ' . $date->format('Y');

                echo "<div class='question'>";
                echo "<p><i class='fa-solid fa-chevron-down'></i> <strong>{$row['question']}</strong></p>";
                echo "<p class='questionDate'>Posée par {$row['user_pseudo']} le {$formatted_date}</p>";

                echo "<div class='responses-container'>";

                // Utilisation de la fonction pour récupérer les réponses
                $responses = getResponsesForQuestion($connexion, $row['id_Forum_question']);

                // Vérifier s'il y a des réponses
                if (!empty($responses)) {
                    foreach ($responses as $response) {
                        $answererId = $response['Utilisateur_id_Utilisateur'];

                        // Utilise l'identifiant pour obtenir le pseudo de l'utilisateur
                        $pseudo_answer = getUtilisateurAnswer($connexion, $answererId);

                        $date_answer = new DateTime($response['date']);
                        $formatted_date_answer = $jours[$date_answer->format('w')] . ' ' . $date_answer->format('j') . ' ' . $mois[$date_answer->format('n')] . ' ' . $date_answer->format('Y');

                        echo "<div class='answer'>";
                        echo "<p class='desc_rep'>Réponse ajoutée le {$formatted_date_answer} par {$pseudo_answer['pseudo']} :</p>";
                        echo "<p>{$response['donnees_reponse']}</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p class='no-answer'>Aucune réponse disponible.</p>";
                }

                echo "</div>";

                if ($isAuthenticated) {
                    echo "<form action='Contrôleur/poster_forum.php' method='post' id=reponseForm>";
                    echo "<label for='answer_text'>Répondre :</label>";
                    echo "<textarea name='answer_text' id='answer_text' required></textarea>";
                    echo "<input type='hidden' name='question_id' value='{$row['id_Forum_question']}'>";
                    echo "<input type='submit' name='submit_answer' value='Répondre'>";
                    echo "</form>";
                }

                echo "</div>";

                // Ajouter l'ID de la question au tableau des ID déjà traités
                $uniqueQuestionIds[] = $questionId;
            }
        }
        ?>

        <h2>Poser une question :</h2>
        <?php if ($isAuthenticated) : ?>
            <form action="Contrôleur/poster_forum.php" method="post" id="questionForm">
                <label for="question_text">Votre question :</label>
                <textarea name="question_text" id="question_text" required></textarea>
                <input type="submit" name="ask_question" value="Poser la question">
            </form>
        <?php else : ?>
            <p>Vous devez être connecté pour poser une question.</p>
        <?php endif; ?>

    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var questionTexts = document.querySelectorAll('.question p strong');

            questionTexts.forEach(function (questionText) {
                var question = questionText.closest('.question');
                var responsesContainer = question.querySelector('.responses-container');

                // Cachez les réponses par défaut
                if (responsesContainer) {
                    responsesContainer.style.display = "none";
                }

                questionText.addEventListener("click", function () {
                    question.classList.toggle("active");

                    // Affichez ou masquez les réponses
                    if (responsesContainer) {
                        if (responsesContainer.style.display === "block" || getComputedStyle(responsesContainer).display === "block") {
                            responsesContainer.style.display = "none";
                        } else {
                            responsesContainer.style.display = "block";
                        }
                    }
                });
            });
        });
    </script>

    <footer>
        <section class='logo-adresse'>
            <img src="images/logo-cinebar.png" alt="Logo Cinébar" >
            <div>
                <h3>Adresse :</h3>
                <p>8 Prom. Coeur de Ville</p>
                <a>92130- Issy-les-Moulineaux</a>
            </div>
        </section>
        <div class="donnees">
            <a href="cookies">Gestion des cookies</a> - 
            <a href="cgu">CGU</a> - 
            <a href="faq">FAQ</a>
        </div>  
    </footer>

</body>

</html>
