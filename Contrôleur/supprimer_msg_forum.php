<?php

include '../Modèle/bdd.php';

require_once '../Modèle/forumData.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $messageId = $_POST["messages_id"];
    
    supprimerMsgForum($connexion, $messageId);

    header("Location: ../forum");
    exit();
}
?>
