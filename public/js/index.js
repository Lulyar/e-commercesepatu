

const swiper = new Swiper('.swiper', {
    // Optional parameters
    slidesOffsetAfter: 16,
    slidesOffsetBefore: 16,
    slidesPerView: "auto",
    spaceBetween: 16,
    
    // Center slides for better visual balance
    centeredSlides: false,
    centerInsufficientSlides: true,
    
    // Prevent unwanted scrolling
    allowTouchMove: true,
    resistance: false,
    resistanceRatio: 0,
    
    // Prevent loop
    loop: false,
    
    // Prevent auto slide
    autoplay: false,
    

    
    // Responsive breakpoints untuk 5 sepatu
    breakpoints: {
        // Mobile: 1 slide
        320: {
            slidesPerView: 1,
            spaceBetween: 12,
        },
        // Tablet kecil: 2 slides
        640: {
            slidesPerView: 2,
            spaceBetween: 16,
        },
        // Tablet: 3 slides
        768: {
            slidesPerView: 3,
            spaceBetween: 16,
        },
        // Desktop kecil: 4 slides
        1024: {
            slidesPerView: 4,
            spaceBetween: 16,
        },
        // Desktop besar: 5 slides (semua sepatu)
        1280: {
            slidesPerView: 5,
            spaceBetween: 16,
        }
    },
    
    // Callbacks
    on: {
        init: function () {
            // Initialize swiper
        },
        slideChange: function () {
            // Handle slide change
        },
        resize: function () {
            // Handle resize
        }
    }
});

