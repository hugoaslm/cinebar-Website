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