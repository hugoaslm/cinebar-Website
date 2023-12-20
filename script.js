document.addEventListener('DOMContentLoaded', function () {
    var button = document.getElementById('backToTopBtn');

    window.onscroll = function () {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            button.style.display = 'block';
        } else {
            button.style.display = 'none';
        }
    };

    button.onclick = function () {
        document.body.scrollTop = 0; // Pour Safari
        document.documentElement.scrollTop = 0; // Pour Chrome, Firefox, IE et Opera
    };
});






let currentIndex = 0;
const totalSlides = document.querySelectorAll('.img-carrousel img').length;
const imgCarrousel = document.querySelector('.img-carrousel');

function nextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;
    updateCarousel();
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    updateCarousel();
}

function updateCarousel() {
    const translateValue = -currentIndex * 110; // 110 est la largeur de chaque image + la marge
    imgCarrousel.style.transform = `translateX(${translateValue}px)`;
}