<?php

function modifierProfil($connexion, $identifiant, $email, $pseudo, $themeToggle) {
    $query = "UPDATE utilisateur SET theme = :themeToggle";
    
    if ($email !== '') {
        $query .= ", mail = :email";
    }
    if ($pseudo !== '') {
        $query .= ", pseudo = :pseudo";
    }
    $query .= " WHERE pseudo = :identifiant";

    $stmt = $connexion->prepare($query);

    if ($email !== '') {
        $stmt->bindParam(':email', $email);
    }
    if ($pseudo !== '') {
        $stmt->bindParam(':pseudo', $pseudo);
    }
    $stmt->bindParam(':themeToggle', $themeToggle);
    $stmt->bindParam(':identifiant', $identifiant);

    return $stmt->execute();
}

function modifierCompteUser($connexion, $idUtilisateur, $email, $pseudo, $admin, $themeToggle) {
    $query = "UPDATE utilisateur SET theme = :themeToggle";

    if ($email !== '') {
        $query .= ", mail = :email";
    }
    if ($pseudo !== '') {
        $query .= ", pseudo = :pseudo";
    }
    if ($admin !== '') {
        $query .= ", admin = :admin";
    }
    $query .= " WHERE id_Utilisateur = :user_id";

    $stmt = $connexion->prepare($query);

    if ($email !== '') {
        $stmt->bindParam(':email', $email);
    }
    if ($pseudo !== '') {
        $stmt->bindParam(':pseudo', $pseudo);
    }
    if ($admin !== '') {
        $stmt->bindParam(':admin', $admin);
    }
    $stmt->bindParam(':themeToggle', $themeToggle);
    $stmt->bindParam(':user_id', $idUtilisateur);

    return $stmt->execute();
}

function getUtilisateurById($connexion, $userId) {

    $query = $connexion->prepare("SELECT * FROM utilisateur WHERE id_Utilisateur = :id_user");
    $query->bindParam(':id_user', $userId);
    
    $query->execute();

    $utilisateurs = $query->fetch(PDO::FETCH_ASSOC);

    return $utilisateurs;
}

function getAllUtilisateurs($connexion) {

    $query = "SELECT * FROM utilisateur";

    $stmt = $connexion->query($query);

    $AllUtilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $AllUtilisateurs;
}

function info_userConnected($connexion) {

    if (isset($_SESSION['identifiant'])) {
        $identifiant = $_SESSION['identifiant'];

        $query = "SELECT * FROM utilisateur WHERE pseudo = :identifiant";
        $stmt = $connexion->prepare($query);
        $stmt->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
        $stmt->execute();

        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultat;
    }

    return null;
}

function deleteUser($connexion, $id_user) {

    $sql_insert = "DELETE FROM utilisateur WHERE id_Utilisateur = :id_user";
    $stmt_insert = $connexion->prepare($sql_insert);
    $stmt_insert->bindParam(":id_user", $id_user);
    $stmt_insert->execute();
}

?>
