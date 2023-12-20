<!-- Formulaire pour ajouter un nouveau film -->
<form action="ajouter_film.php" method="post">
    <label for="titre">Titre du Film:</label>
    <input type="text" id="titre" name="titre" required>

    <label for="realisateur">Réalisateur:</label>
    <input type="text" id="realisateur" name="realisateur" required>

    <label for="annee">Année de Sortie:</label>
    <input type="number" id="annee" name="annee" required>

    <button type="submit">Ajouter Film</button>
</form>

<!-- Liste des films existants avec options de modification/suppression -->
<ul>
    <li>
        <span class="film-titre">Titre du Film 1</span>
        <span class="film-realisateur">Réalisateur 1</span>
        <span class="film-annee">Année 1</span>
        <button class="modifier">Modifier</button>
        <button class="supprimer">Supprimer</button>
    </li>
    <!-- Répétez ces éléments pour chaque film -->
</ul>
