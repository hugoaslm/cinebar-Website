<form action="modifier_compte.php" method="post">
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>

    <label for="langue">Préférence de Langue :</label>
    <select id="langue" name="langue" required>
        <option value="francais">Français</option>
        <option value="anglais">Anglais</option>
    </select>

    <label for="theme">Thème :</label>
    <div id="themeToggle" class="toggle-theme">
        <button type="button" onclick="toggleTheme()">Sombre</button>
    </div>

    <button type="submit">Modifier Compte</button>
</form>

<script>
    // Script JavaScript pour basculer entre les thèmes
    function toggleTheme() {
        var themeToggle = document.getElementById("themeToggle");
        var themeButton = themeToggle.querySelector("button");

        if (document.body.classList.contains("theme-sombre")) {
            // Passer au thème clair
            document.body.classList.remove("theme-sombre");
            themeButton.textContent = "Sombre";
        } else {
            // Passer au thème sombre
            document.body.classList.add("theme-sombre");
            themeButton.textContent = "Clair";
        }
    }
</script>
