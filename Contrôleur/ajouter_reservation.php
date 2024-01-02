<?php
// Inclure le fichier de connexion à la base de données
include '../Modèle/bdd.php';

// Variables à partir des données du formulaire ou d'autres sources
$nom_pro = $_POST['nom'];
$prenom_pro = $_POST['prenom'];
$mail = $_POST['mail'];
$numTel = $_POST['num'];
$date = $_POST['date'];
$horaires = $_POST['horaires'];
$nb_invite = $_POST['number'];
$type_event = $_POST['type_event'];
$equipements = implode(', ', $_POST['equip']); // Convertir le tableau en chaîne pour le stocker dans la base de données
$commentaires = $_POST['comm'];
$Salle_id_Salle = $_POST['salle'];

// Requête d'insertion
$sql = "INSERT INTO `reservation_salle` (`nom_pro`, `prenom_pro`, `mail`, `numTel`, `date`, `horaires`, `nb_invite`, `type_event`, `equipements`, `commentaires`, `Salle_id_Salle`) 
        VALUES (:nom_pro, :prenom_pro, :mail, :numTel, :date, :horaires, :nb_invite, :type_event, :equipements, :commentaires, :Salle_id_Salle)";

// Préparation de la requête
$stmt = $connexion->prepare($sql);

// Liaison des paramètres
$stmt->bindParam(':nom_pro', $nom_pro, PDO::PARAM_STR);
$stmt->bindParam(':prenom_pro', $prenom_pro, PDO::PARAM_STR);
$stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
$stmt->bindParam(':numTel', $numTel, PDO::PARAM_STR);
$stmt->bindParam(':date', $date, PDO::PARAM_STR);
$stmt->bindParam(':horaires', $horaires, PDO::PARAM_STR);
$stmt->bindParam(':nb_invite', $nb_invite, PDO::PARAM_INT);
$stmt->bindParam(':type_event', $type_event, PDO::PARAM_STR);
$stmt->bindParam(':equipements', $equipements, PDO::PARAM_STR);
$stmt->bindParam(':commentaires', $commentaires, PDO::PARAM_STR);
$stmt->bindParam(':Salle_id_Salle', $Salle_id_Salle, PDO::PARAM_INT);

// Exécution de la requête
if ($stmt->execute()) {
    header("Location: ../Vue/billet-confirm.php");
    exit();
} else {
    echo "Erreur lors de l'ajout de la réservation : " . $stmt->errorInfo()[2];
}
?>