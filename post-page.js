document.addEventListener("DOMContentLoaded", function () {
    const images = document.querySelectorAll(".product-image");
    const prevButton = document.getElementById("prevImageButton");
    const nextButton = document.getElementById("nextImageButton");
    let currentIndex = 0;
    function showImage(index) {
        images.forEach((image, i) => {
            if (i === index) {
                image.classList.add("active");
            } else {
                image.classList.remove("active");
            }
        });
    }
    function prevImage() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        showImage(currentIndex);
    }
    function nextImage() {
        currentIndex = (currentIndex + 1) % images.length;
        showImage(currentIndex);
    }
    prevButton.addEventListener("click", prevImage);
    nextButton.addEventListener("click", nextImage);
});