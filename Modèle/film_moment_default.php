<?php

$sql_manuelle = "SELECT selection_manuelle FROM film_moment";

// Sélectionner l'id du film avec le plus de réservations
$sql_req = "SELECT reservation_film.Projection_id_Projection AS id_F, SUM(reservation_film.nb_reservation) AS total_reservations
FROM reservation_film
GROUP BY reservation_film.Projection_id_Projection
ORDER BY total_reservations DESC
LIMIT 1;";

$stmt_req = $connexion->query($sql_req);
$film_row = $stmt_req->fetch(PDO::FETCH_ASSOC);

if ($sql_manuelle = 0) {
    // Mettre à jour film_moment avec le nouvel id du film du moment
    $sql_update = "UPDATE film_moment SET film_id_F = :film_id";
    $stmt_update = $connexion->prepare($sql_update);
    $stmt_update->bindParam(":film_id", $film_row['id_F'], PDO::PARAM_INT);
    $stmt_update->execute();
}

?>
