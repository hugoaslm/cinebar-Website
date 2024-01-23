<?php
require_once("db.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    $isAuthenticated = false;
} else {
    $isAuthenticated = true;
}

// Traitement de la question posée
if (isset($_POST['ask_question']) && $isAuthenticated) {
    $questionText = $_POST['question_text'];
    $userId = $_SESSION['user_id'];

    $sql = "INSERT INTO Question (Date, Texte, User_idUser) VALUES (NOW(), '$questionText', $userId)";
    $result = $conn->query($sql);

    if ($result) {
        echo "Question posée avec succès!";
    } else {
        echo "Erreur lors de la pose de la question : " . $conn->error;
    }
}

// Traitement de la réponse
if (isset($_POST['submit_answer']) && $isAuthenticated) {
    $answerText = $_POST['answer_text'];
    $questionId = $_POST['question_id'];
    $userId = $_SESSION['user_id'];

    $sql = "INSERT INTO Réponse (Date, Texte, Question_idQuestion, User_idUser) VALUES (NOW(), '$answerText', $questionId, $userId)";
    $result = $conn->query($sql);

    if ($result) {
        echo "Réponse ajoutée avec succès!";
    } else {
        echo "Erreur lors de l'ajout de la réponse : " . $conn->error;
    }
}

// Récupération des questions et réponses
$sql = "SELECT Question.idQuestion, Question.Date AS question_date, Question.Texte AS question_text, 
        Réponse.idRéponse, Réponse.Date AS answer_date, Réponse.Texte AS answer_text, Réponse.User_idUser AS answer_user,
        User.Nom AS user_nom, User.Prenom AS user_prenom, User.PhotoProfil AS user_photo
        FROM Question
        LEFT JOIN Réponse ON Question.idQuestion = Réponse.Question_idQuestion
        LEFT JOIN User ON User.idUser = Question.User_idUser
        ORDER BY Question.Date DESC, Réponse.Date DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
</head>
<body>

<?php if ($isAuthenticated) : ?>
    <form action="forum.php" method="post">
        <label for="question_text">Posez votre question :</label>
        <textarea name="question_text" id="question_text" required></textarea>
        <input type="submit" name="ask_question" value="Poser la question">
    </form>
<?php else : ?>
    <p>Vous devez être connecté pour poser une question.</p>
<?php endif; ?>

<h2>Questions et réponses</h2>

<?php
while ($row = $result->fetch_assoc()) {
    echo "<div class='cgu-content'>";

    // Formatage de la date et de l'heure
    $questionDate = date("j F Y à G\hi", strtotime($row['question_date']));
    // Affichage du texte de la question
    echo "<p><strong>{$row['question_text']}</strong></p>";

    echo "{$row['user_prenom']}";

    // Affichage de la date et de l'heure
    echo "<p>{$questionDate}</p>";

    

    if ($row['idRéponse'] !== null) {
        // Formatage de la date et de l'heure de la réponse
        $answerDate = date("j F Y à G\hi", strtotime($row['answer_date']));

        // Affichage de la réponse
        echo "<p>Réponse ajoutée {$answerDate} par {$row['user_prenom']} {$row['user_nom']} :<br>{$row['answer_text']}</p>";
    } else {
        echo "<p>Aucune réponse disponible.</p>";
    }

    if ($isAuthenticated) {
        echo "<form action='forum.php' method='post'>";
        echo "<label for='answer_text'>Répondre :</label>";
        echo "<textarea name='answer_text' id='answer_text' required></textarea>";
        echo "<input type='hidden' name='question_id' value='{$row['idQuestion']}'>";
        echo "<input type='submit' name='submit_answer' value='Répondre'>";
        echo "</form>";
    }
    
    echo "</div>";
}
?>



</body>
</html>

<?php
$conn->close();
?>