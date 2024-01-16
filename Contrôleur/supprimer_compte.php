<?php
    
$id_user = $_GET['id'];

include '../Modèle/bdd.php';

// Insérer le nouveau film du moment
$sql_insert = "DELETE FROM utilisateur WHERE id_Utilisateur = :id_user";
$stmt_insert = $connexion->prepare($sql_insert);
$stmt_insert->bindParam(":id_user", $id_user);
$stmt_insert->execute();

header("Location: ../Vue/gestion_users.php");
exit();

?>
