<?php
    
$id_user = $_GET['id'];

include '../Modèle/bdd.php';
require_once '../Modèle/userData.php';

$delete = deleteUser($connexion, $id_user);

header("Location: ../gestion_users");
exit();

?>
