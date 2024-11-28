document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelectorAll('.slide');
    const nextButton = document.getElementById('next');
    const prevButton = document.getElementById('prev');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
    }

    function updateState(newIndex) {
        currentSlide = newIndex;
        showSlide(currentSlide);
    }

    nextButton.addEventListener('click', () => {
        const newIndex = (currentSlide + 1) % slides.length;
        updateState(newIndex);
    });

    prevButton.addEventListener('click', () => {
        const newIndex = (currentSlide - 1 + slides.length) % slides.length;
        updateState(newIndex);
    });

    showSlide(currentSlide);
});
