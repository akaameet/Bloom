//search btn******************************************************
// Get the search icon element by ID
    const searchIcon = document.getElementById('search-btn');
    // Get the search form element by class
    const searchForm = document.querySelector(".search-form");
    // Add event listener to the search icon for click event
    searchIcon.addEventListener("click", () => {
        // Add 'active' class to the search form when the search icon is clicked
        searchForm.classList.add('active');
    });

    // Add event listener to the document for click event
    document.addEventListener("click", function(event) {
        // Get the search box element by ID
        const searchBox = document.getElementById("search-box");
        // Check if the event target is the search form
        if (event.target == searchForm) {
            console.log("Is search form...");
        }

        // Check if the click event target is not the search icon or the search input box
        if (event.target !== searchIcon && event.target !== searchBox) {
            // Remove 'active' class from the search form to hide it
            searchForm.classList.remove('active');
            console.log("outside the form...");
        }
    });
// navbar highlight***********************************************************************************8
document.addEventListener('DOMContentLoaded', function () {
// Get the current hash fragment from the URL
    // Get all navbar links
    var navLinks = document.querySelectorAll('.navbar ul li a');

    // Loop through each link
    navLinks.forEach(function(link) {
        // Attach click event listener
        link.addEventListener('click', function(event) {
            // Remove 'active' class from all navigation items
            navLinks.forEach(function(navLink) {
                navLink.parentElement.classList.remove('active');
            });

            // Add 'active' class to the clicked item's parent <li> element
            link.parentElement.classList.add('active');

            // Update the URL hash to match the clicked item's href
            var sectionId = link.getAttribute('href').split('#')[1];
            window.location.hash = sectionId;
        });
    });

    // Highlight the navigation item based on the current URL hash
    var currentPageHash = window.location.hash.substr(1);
    if (currentPageHash) {
        var currentNavItem = document.querySelector('.navbar ul li a[href="#' + currentPageHash + '"]');
        if (currentNavItem) {
            currentNavItem.parentElement.classList.add('active');
        }
    }



// swiper slider*************************************
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
//  navbar scrollable****************************************************************************
const navbar = document.querySelector(".navbar");
function positionScrollbar() {
    const currentVerticalScroll = window.scrollY;
    if (currentVerticalScroll > 200) navbar.classList.add('stick-nav'); 
    else navbar.classList.remove('stick-nav');
}

window.addEventListener('scroll', positionScrollbar);


// product data filter***********************************************************************88
const productLinks = document.querySelectorAll('.product-link');
    
productLinks.forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();
            // Remove the active class from all links
            productLinks.forEach(function(link) {
                link.classList.remove('active');
            });
        
            // Add the active class to the clicked link
            this.classList.add('active');
            const targetCategory = this.getAttribute('data-target');
            const boxes = document.querySelectorAll('.box');

            let foundProducts = false;

            boxes.forEach(function(box) {
                if (box.classList.contains(targetCategory) || targetCategory === 'all') {
                    box.style.display = 'block';
                    foundProducts = true;
                } else {
                    box.style.display = 'none';
                }
            });

            if (!foundProducts) {
                const noPlantsMessage = document.createElement('p');
                noPlantsMessage.textContent = `No plants available in the ${targetCategory} category.`;
                noPlantsMessage.classList.add('no-plants-message');
                document.querySelector('.product-item').appendChild(noPlantsMessage);
            } else {
                // Remove any existing no plants message
                const existingNoPlantsMessage = document.querySelector('.no-plants-message');
                if (existingNoPlantsMessage) {
                    existingNoPlantsMessage.remove();
                }
            }
        });
    });

