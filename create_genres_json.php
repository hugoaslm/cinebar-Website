<?php
// Liste des genres
$genres = ["Action", "Comédie", "Drame", "Science-fiction", "Horreur", "Romance", "Documentaire", "Thriller"];

// Convertir en JSON
$jsonContent = json_encode($genres);

// Écrire dans le fichier genres.json
file_put_contents('../genres.json', $jsonContent);
