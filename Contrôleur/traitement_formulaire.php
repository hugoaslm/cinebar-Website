<?php

include '../Modèle/bdd.php';

// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $num = $_POST['num'];
    $date = $_POST['date'];
    $horaires = $_POST['horaires'];
    $nombre_invite = $_POST['number'];
    $commentaires = $_POST['comm'];
    $type_event = $_POST['type_event'];

    // Traitement des équipements
    $micro = isset($_POST['micro']) ? 'Microphone' : '';
    $projecteur = isset($_POST['projecteur']) ? 'Projecteur' : '';
    $sonorisation = isset($_POST['sonorisation']) ? 'Sonorisation' : '';

    // Stocker le résultat de array_filter dans une variable
    $equipements = array_filter([$micro, $projecteur, $sonorisation]);
    // Convertir le tableau équipements en chaîne de caractères
    $equipements_str = implode(', ', $equipements);

    // Traitement de la salle
    $salle_id = $_POST['salle'];

    // Préparation de la requête SQL
    $query = "INSERT INTO reservation_salle (nom_pro, prenom_pro, mail, numTel, date, horaires, nb_invite, equipements, commentaires, type_event, Salle_id_Salle)
              VALUES (:nom, :prenom, :mail, :num, :date, :horaires, :nombre_invite, :equipements, :commentaires, :type_event, :salle_id)";
    
    $stmt = $connexion->prepare($query);

    // Liaison des paramètres
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':num', $num);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':horaires', $horaires);
    $stmt->bindParam(':nombre_invite', $nombre_invite);
    $stmt->bindParam(':equipements', $equipements_str);
    $stmt->bindParam(':commentaires', $commentaires);
    $stmt->bindParam(':type_event', $type_event);
    $stmt->bindParam(':salle_id', $salle_id);

    // Exécution de la requête
    if ($stmt->execute()) {
        echo 'Réservation enregistrée avec succès.';
    } else {
        echo 'Erreur lors de l\'enregistrement de la réservation.';
    }
}

?>
