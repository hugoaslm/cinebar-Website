<?php

include '../Modèle/bdd.php';
require_once '../Modèle/forumData.php';
require_once '../Modèle/userData.php';

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    $isAuthenticated = false;
    echo 'slt';
    echo $_SESSION['identifiant'];
} else {
    $isAuthenticated = true;
}

echo $isAuthenticated;

// Traitement de la question posée
if (isset($_POST['ask_question']) && $isAuthenticated) {
    $questionText = $_POST['question_text'];
    $user_question = info_userConnected($connexion);
    $user_id = $user_question['id_Utilisateur'];

    $insertReponse = questionForum($connexion, $questionText, $user_id);

    header("Location: ../forum");
    exit();
}

// Traitement de la réponse
if (isset($_POST['submit_answer']) && $isAuthenticated) {
    $answerText = $_POST['answer_text'];
    $questionId = $_POST['question_id'];
    $user_rep = info_userConnected($connexion);
    $userId = $user_rep['id_Utilisateur'];

    $insertReponse = reponseForum($connexion, $answerText, $questionId, $userId);

    header("Location: ../forum");
    exit();
}

?>