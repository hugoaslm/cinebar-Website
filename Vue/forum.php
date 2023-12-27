<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum de Questions-Réponses</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-bi+2BIvPHs5peU+5wDTrAYu9fEF+j4uANCBF8bXaSv1ap4SC1vY+gJEAY6npa9vm4tft9NxLXR+rWn5eknjOXA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-size: 16px;
            margin: 0;
            padding: 0;
            background-color: #1E1E1E;
            color: white;
        }

        section {
            margin: 20px;
            padding: 20px;
            background-color: #1E1E1E;
            
            
        }

        h2 {
            color: #ffffff;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        textarea {
            color: rgb(0, 0, 0);
            width: 30%;
            padding: 8px;
            margin-bottom: 16px;
            
        }

        button {
            background-color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #d3cdcd;
        }

        .question {
            margin-bottom: 100px;
            color: white;
            background-color: #89404F; 
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);

        }

        .answer {
            margin-bottom:20px;
            border-left: 2px solid #333;
            padding-left: 20px;
            word-wrap: break-word;
            height: auto;
    }

        .center-text {
            text-align: center;
    }


        #questionForm{
            background-color: #89404F; 
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
            margin-bottom: 100px;

            
    }

    </style>
</head>

<body>


    <header>
        <nav>
            
            <img src="../images/logo-cinebar.png" alt="Logo Cinébar" >
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
                <form class="container" action="recherche.php" method="POST">
                    <input type="text" placeholder="Rechercher..." name="recherche">
                    <div class="search"></div>
                </form>

                <div class="bouton-pro">
                    <a href="pro.php">Réservation de salles</a>
                </div>

                <?php

                // Vérifiez si l'utilisateur est connecté en vérifiant la présence de la variable de session
                $estConnecte = isset($_SESSION['identifiant']);

                // Sélectionnez le bouton de connexion en PHP
                $boutonConnexion = '<div class="bouton-co">';
                if ($estConnecte) {
                    $identifiant = $_SESSION['identifiant'];
                    $boutonConnexion .= '<a href="profil.php">' . $identifiant . ' <i class="fas fa-user"></i></a>';
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

    

    <section id="questionsSection">
        
        <form id="questionForm">
            <h2>Poser une Question</h2>
            <label for="question">Votre Question:</label>
            <textarea id="question" name="question" rows="4" required></textarea>

            <label for="name">Votre Nom:</label>
            <input type="text" id="name" name="name" required>

            <button type="submit">Poser la Question</button>
        </form>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const questionForm = document.getElementById("questionForm");
            const questionsSection = document.getElementById("questionsSection");

            questionForm.addEventListener("submit", function (event) {
                event.preventDefault();

                const questionTextarea = document.getElementById("question");
                const nameInput = document.getElementById("name");

                const questionText = questionTextarea.value;
                const userName = nameInput.value;

                if (questionText.trim() !== "" && userName.trim() !== "") {
                    // Créer un nouvel élément question
                    const questionDiv = document.createElement("div");
                    questionDiv.classList.add("question");

                    // Ajouter le contenu de la question avec la classe de centrage
                    questionDiv.innerHTML = `
                        <p class="center-text"><strong>Nom de l'utilisateur:</strong> ${userName}</p>
                        <p class="center-text"><strong>Question:</strong> ${questionText}</p>
                    `;

                    // Ajouter un formulaire de réponse
                    const answerForm = document.createElement("form");
                    answerForm.innerHTML = `
                        <label for="answer">Votre Réponse:</label>
                        <textarea id="answer" name="answer" rows="3" required></textarea>

                        <label for="answerName">Votre Nom:</label>
                        <input type="text" id="answerName" name="answerName" required>

                        <button type="submit">Répondre</button>
                    `;

                    // Ajouter l'événement de soumission du formulaire de réponse
                    answerForm.addEventListener("submit", function (event) {
                        event.preventDefault();

                        const answerTextarea = answerForm.querySelector("#answer");
                        const answerNameInput = answerForm.querySelector("#answerName");

                        const answerText = answerTextarea.value;
                        const answerUserName = answerNameInput.value;

                        if (answerText.trim() !== "" && answerUserName.trim() !== "") {
                            const answerDiv = document.createElement("div");
                            answerDiv.classList.add("answer");
                            answerDiv.innerHTML = `<p><strong>${answerUserName} répond :</strong> ${answerText}</p>`;

                            // Ajouter la réponse avant le formulaire
                            questionDiv.insertBefore(answerDiv, answerForm);

                            // Effacer le champ de réponse après avoir répondu
                            answerTextarea.value = "";
                            answerNameInput.value = "";
                        }
                    });

                    questionDiv.appendChild(answerForm);

                    // Ajouter la question à la section des questions
                    questionsSection.appendChild(questionDiv);

                    // Effacer le formulaire après avoir posé la question
                    questionTextarea.value = "";
                    nameInput.value = "";
                }
            });
        });
    </script>

    <footer>
        <section class='logo-adresse'>
            <img src="../images/logo-cinebar.png" alt="Logo Cinébar" >
            <div>
                <h3>Adresse :</h3>
                8 Prom. Coeur de Ville<br>
                <a>92130- Issy-les-Moulineaux</a>
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
