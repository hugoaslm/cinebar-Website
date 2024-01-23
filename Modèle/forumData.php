<?php

function getResponsesForQuestion($connexion, $questionId)
{
    $sql = "SELECT * FROM forum_reponse WHERE Forum_question_id_Forum_question = :questionId";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':questionId', $questionId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUtilisateurAnswer($connexion, $userId) {
    $query = $connexion->prepare("SELECT pseudo FROM utilisateur WHERE id_Utilisateur = (SELECT Utilisateur_id_Utilisateur FROM forum_reponse WHERE Utilisateur_id_Utilisateur = :id_user LIMIT 1)");
    $query->bindParam(':id_user', $userId);
    
    $query->execute();

    $utilisateur = $query->fetch(PDO::FETCH_ASSOC);

    return $utilisateur;
}

function reponseForum($connexion, $answerText, $questionId, $userId) {
    $sql = "INSERT INTO forum_reponse (date, donnees_reponse, Forum_question_id_Forum_question, Utilisateur_id_Utilisateur) VALUES (NOW(), :answerText, :questionId, :userId)";
    
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':answerText', $answerText, PDO::PARAM_STR);
    $stmt->bindParam(':questionId', $questionId, PDO::PARAM_INT);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    
    $result = $stmt->execute();

    return $result;
}

function questionForum($connexion, $questionText, $user_id) {
    $sql = "INSERT INTO forum_question (date, donnees_question, Utilisateur_id_Utilisateur) VALUES (NOW(), :questionText, :user_id)";
    
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':questionText', $questionText, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
    $result = $stmt->execute();

    return $result;
}

function RepQuestForum($connexion) {
    $sql = "SELECT forum_question.id_Forum_question, forum_question.date AS question_date, 
    forum_question.donnees_question AS question, utilisateur.id_Utilisateur AS user_id, utilisateur.pseudo AS user_pseudo, forum_reponse.id_Forum_reponse, forum_reponse.date AS reponse_date, forum_reponse.donnees_reponse AS reponse, forum_reponse.Utilisateur_id_Utilisateur AS reponse_user
    FROM forum_question
    LEFT JOIN forum_reponse ON forum_question.id_Forum_question = forum_reponse.Forum_question_id_Forum_question
    LEFT JOIN utilisateur ON forum_question.Utilisateur_id_Utilisateur = utilisateur.id_Utilisateur
    ORDER BY forum_reponse.date DESC";

    $result = $connexion->query($sql);

    return $result;
}

function ForumOptions($connexion) {

    $stmt = $connexion->prepare("SELECT id_Forum_question, donnees_question FROM forum_question");
    
    $stmt->execute();

    $question = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $question;

}

function supprimerForum($connexion, $id_question) {

    $sql = "DELETE FROM forum_question WHERE id_Forum_question = :id_quest";
    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(":id_quest", $id_question);

    $stmt->execute();
}

function supprimerMsgForum($connexion, $messageId) {

    $sql = "DELETE FROM forum_reponse WHERE id_Forum_reponse = :id_rep";
    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(":id_rep", $messageId);

    $stmt->execute();
}

function getMessagesForQuestion($connexion, $question_id) {

    $query = "SELECT * FROM forum_reponse WHERE Forum_question_id_Forum_question = :question_id";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    } else {
        return false;
    }
}


?>