// showtimes.js

document.addEventListener('DOMContentLoaded', function () {
    // Sélectionnez les éléments nécessaires
    const movieSelect = document.getElementById('movie');
    const showtimeSelect = document.getElementById('showtime');

    // Définissez les séances de projection pour chaque film
    const showtimes = {
        '220': ['10:00 AM', '2:00 PM', '7:00 PM'],
        '320': ['11:30 AM', '3:30 PM', '8:30 PM'],
        '250': ['1:00 PM', '5:00 PM', '9:00 PM'],
        '260': ['12:00 PM', '4:00 PM', '9:30 PM'],
    };

    // Fonction pour mettre à jour les séances en fonction du film sélectionné
    function updateShowtimes() {
        const selectedMovie = movieSelect.value;
        const selectedShowtimes = showtimes[selectedMovie] || [];

        // Effacez les options actuelles
        showtimeSelect.innerHTML = '';

        // Ajoutez les nouvelles options
        selectedShowtimes.forEach(function (showtime) {
            const option = document.createElement('option');
            option.value = showtime;
            option.textContent = showtime;
            showtimeSelect.appendChild(option);
        });
    }

    // Ajoutez un auditeur d'événements pour mettre à jour les séances lorsqu'un film est sélectionné
    movieSelect.addEventListener('change', updateShowtimes);

    // Appelez la fonction une fois pour initialiser les séances pour le film par défaut
    updateShowtimes();
});
