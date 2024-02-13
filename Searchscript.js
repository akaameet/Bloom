let searchBtn = document.querySelector('.search-form');
document.querySelector('#search-btn').onclick = () =>
{
    searchBtn.classList.toggle('active');
}
// slider js
document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper(".product-slider", {
        loop: false, // Set loop to false
        spaceBetween: 20,
        autoplay: {
            delay: 5500,
            disableOnInteraction: false,
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1020: {
                slidesPerView: 3,
            },
        },
        // navigation: {
        //     nextEl: ".swiper-button-next",
        //     prevEl: ".swiper-button-prev",
        // },
    });
    
    swiper.on('slideChange', function () {
        if (swiper.isEnd) {
            setTimeout(function () {
                swiper.slideTo(0, 1000, false); // Go to the first slide with a duration of 1000ms (1 second)
            }, 2000); // Delay for 1 second before moving to the first slide
        }
    });
});

// const homeLink = document.querySelector('.homeLink');
// homeLink.onclick = () => {
//     navbar.classList.remove('stick-nav');
// }

const navbar = document.querySelector(".navbar");

function positionScrollbar() {
    const currentVerticalScroll = window.scrollY;
    if (currentVerticalScroll > 200) navbar.classList.add('stick-nav'); 
    else navbar.classList.remove('stick-nav');
}

window.addEventListener('scroll', positionScrollbar);
