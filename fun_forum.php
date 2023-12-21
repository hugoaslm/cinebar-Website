<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "bddisep19";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get forum questions
function getForumQuestions($conn) {
    $sql = "SELECT * FROM Forum_question";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    return array();
}

// Function to get forum answers for a question
function getForumAnswers($conn, $questionId) {
    $sql = "SELECT * FROM Forum_reponse WHERE Forum_question_id_Forum_question = $questionId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    return array();
}

// Sample usage
$forumQuestions = getForumQuestions($conn);

foreach ($forumQuestions as $question) {
    echo "<div class='question'>";
    echo "<p>{$question['donnees_question']}</p>";

    $answers = getForumAnswers($conn, $question['id_Forum_question']);
    foreach ($answers as $answer) {
        echo "<div class='answer'>";
        echo "<p>{$answer['donnees_reponse']}</p>";
        echo "</div>";
    }

    echo "</div>";
}

$conn->close();
?>
