
// Carousel
document.addEventListener("DOMContentLoaded", () => {
    const track = document.getElementById("carousel-track");
    const slides = track.children;
    const indicators = document.querySelectorAll("[data-slide-to]");
    const prevBtn = document.getElementById("prev-btn");
    const nextBtn = document.getElementById("next-btn");

    let currentIndex = 0;

    const updateCarousel = () => {
        const offset = -currentIndex * 100; // Calculate the translation offset
        track.style.transform = `translateX(${offset}%)`;

        // Update indicators
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle("bg-gray-800", index === currentIndex);
            indicator.classList.toggle("bg-gray-400", index !== currentIndex);
        });
    };

    const nextSlide = () => {
        currentIndex = (currentIndex + 1) % slides.length;
        updateCarousel();
    };

    const prevSlide = () => {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        updateCarousel();
    };

    // Add event listeners
    nextBtn.addEventListener("click", nextSlide);
    prevBtn.addEventListener("click", prevSlide);

    indicators.forEach((indicator, index) => {
        indicator.addEventListener("click", () => {
            currentIndex = index;
            updateCarousel();
        });
    });

    // Optional: Auto-slide every 5 seconds
    setInterval(nextSlide, 10000);
});


