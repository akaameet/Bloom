//search btn******************************************************
// Get the search icon element by ID
const searchIcon = document.getElementById('search-btn');
const searchForm = document.querySelector(".search-form");
const searchBox = document.getElementById("search-box");

// Toggle the visibility of the search form when clicking the search icon
searchIcon.addEventListener("click", () => {
    searchForm.classList.toggle('active');
});

// Hide the search form when clicking outside of it
document.addEventListener("click", function(event) {
    if (event.target !== searchIcon && event.target !== searchBox) {
        searchForm.classList.remove('active');
    }
});

// Enable form submission when pressing the Enter key
searchBox.addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Prevent the default form submission
        
        // Extract the search term from the search input box
        const searchTerm = searchBox.value.trim();
        
        // Check if the search term is not empty
        if (searchTerm !== '') {
            // Redirect to the search page with the search term as a query parameter
            window.location.href = 'search.php?search=' + encodeURIComponent(searchTerm);
        }
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

