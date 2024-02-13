<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloom</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/eda993e11c.js" crossorigin="anonymous"></script>
    <!-- swiper slide -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
<body>
    <!-- <div class="container"> -->

            <nav class="navbar">
                <div class="logo">
                    <!-- <a href=""> -->
                        <img src="assets/img/bloom-high-resolution-logo-transparent.png"/> 
                    <!-- </a> -->
                </div>
                </div>
                <input type="checkbox" id="click">
                <label for="click" class="menu-btn">
                    <i class="fa-solid fa-bars"></i>
                </label>
                <ul>
                <li class="homeLink"><a href="#home">Home</a></li>
                <li><a href="#category">Category</a></li>
                <li><a href="#product">Produts</a></li>
                <li><a href="#contact">Contacts</a></li>      
                </ul>
                <div class="icons">
                    <div class="fa fa-search" id="search-btn"></div>
                    <div class="fa fa-cart-shopping" id="cart"></div>
                    <a href="login.php"> dddd</a>
                    <!-- <div class="fa fa-user" id="login-btn"></div> -->
                </div>
                <form class="search-form">
                    <input type="search" id="search-box" placeholder="Search Here...">
                    <label for="search-box" class="fa fa-search"></label>
        
                </form>
            </nav>
            <!--home section-->
            <section class="home" id="home">
                <div class="overlay">
                    <div class="content">
                        <h3>Green Oasis:<span>Explore</span> Our Lush Plants</h3>
                        <p>Transform your space with our lush plants, nurturing both your home and soul</p>
                        <a href="" class="btn">Shop Now</a>
                    </div>
                </div>
            </section>
            <!-- category section -->
            <section class="category" id="category">
                <h1 class="heading">Category</h1>
                <div class="box-container">
        
                    <div class="box">
                        <img src="assets/img/inddor.jpg" alt="indoor">
                        <div class="content-box">
                            <h3 >Indoor plant</h3>
                            <a href="#" class="btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="box">
                        <img src="assets/img/outdoor.jpg" alt="indoor">
                        <div class="content-box">
                            <h3>Outdoor plant</h3>
                            <a href="#" class="btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="box">
                        <img src="assets/img/succulent.jpg" alt="indoor">
                        <div class="content-box">
                            <h3>Succulent</h3>
                            <a href="#" class="btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="box box-4">
                        <img src="assets/img/bonsai.jpg" alt="indoor">
                        <div class="content-box">
                            <h3>Bonsai</h3>
                            <a href="#" class="btn">Shop Now</a>
                        </div>
                    </div>
        
        
                </div>
        
            </section>
        <!-- product section -->
            <section class="product" id="product">
                <h1 class="heading">Products</h1>
                <div class="swiper product-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide box">
                                <img src="assets/img/inddor.jpg" alt="indoor">
                                <div class="content-box">
                                    <h3 >Indoor plant</h3>
                                    <!-- <div class="quantity">
                                        <span>Quantity:</span>>
                                        <input type="number" min="1" max="100" value="1">
                                    </div> -->
                                    <div class="price"> $45</div>
                                    <a href="#" class="btn">Add to Cart</a>
                                </div>
                            </div>
                            <div class="swiper-slide box">
                                <img src="assets/img/outdoor.jpg" alt="indoor">
                                <div class="content-box">
                                    <h3>Outdoor plant</h3>
                                    <div class="price"> $45</div>
                                    <a href="#" class="btn">Add to Cart</a>
                                </div>
                            </div>
                            <div class="swiper-slide box">
                                <img src="assets/img/succulent.jpg" alt="indoor">
                                <div class="content-box">
                                    <h3>Succulent</h3>
                                    <div class="price"> $45</div>
                                    <a href="#" class="btn">Add to Cart</a>
                                </div>
                            </div>
                            <div class="swiper-slide box">
                                <img src="assets/img/succulent.jpg" alt="indoor">
                                <div class="content-box">
                                    <h3>Succulent</h3>
                                    <div class="price"> $45</div>
                                    <a href="#" class="btn">Add to Cart</a>
                                </div>
                            </div>
                            <div class="swiper-slide box">
                                <img src="assets/img/bonsai.jpg" alt="indoor">
                                <div class="content-box">
                                    <h3>Bonsai</h3>
                                    <div class="price"> $45</div>
                                    <a href="#" class="btn">Add to Cart</a>
                                </div>
                            </div>
                            <div class="swiper-slide box">
                                <img src="assets/img/bonsai.jpg" alt="indoor">
                                <div class="content-box">
                                    <h3>Bonsai</h3>
                                    <div class="price"> $45</div>
                                    <a href="#" class="btn">Add to Cart</a>
                                </div>
                                <!-- <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div> -->
                            </div>
                            <!-- <a href="product-page.html" class="see-more">See More</a>
                            </div> -->
                        </div>
                    </div>
                </div>
        
            </section>
        <!-- contact section -->
            <section class="contact" id="contact">
                <div class="contact_container">
                    <div class="contact_box">
                        <div class="conatct_data">
                            <div class="contact_info">
                                <h2 class="contact_title">
                                    Reach out to us today <br> via any of the given<br>information 
                                </h2>
                            </div>
                        </div>
                    </div>
        
                    <form action="" class="contact_form">
                        <div class="contact_inputs">
                            <div class="contact_content">
                                <label for="email" class="contact_label">Email</label>
                                <input type="email" class="contact_input" placeholder="">
                            </div>
        
                            <div class="contact_content">
                                <label for="Subject" class="contact_label">Subject</label>
                                <input type="text" class="contact_input" placeholder="">
                            </div>
        
                            <div class="contact_content contact_area">
                                <label for="message" class="contact_label">Message</label>
                                <textarea name="message"  class="contact_input"></textarea>
                            </div>
                        </div>
                        <button class="btn">
                            Send Message
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </button>
                    </form>
                </div>
        
            </section>
        
        <!-- footer section -->
        <footer class="footer">
            <div class="footer_container container grid">
                <div class="footer_logo">
                    <!-- <a href=""> -->
                        <img src="assets/img/bloom-high-resolution-logo-transparent.png"/> 
                    <!-- </a> -->
                    <p>Feel free to follow us on Our Social <br>Media Handlers. All the links are <br>Given below </p>
                
        
                    <!-- <h3 class="footer_title">Our Address</h3> -->
                    <ul class="footer_data">
                        <div class="footer_social">
                            <a href="" class="footer_social-link">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="" class="footer_social-link">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="" class="footer_social-link">
                                <i class="fa-brands fa-x-twitter"></i>r 
                            </a>
                        </div>
                </div>
                    <div class="footer_content">
                        <h3 class="footer_title">Contact</h3>
                        <ul class="footer_data">
                            <li class="footer_info">+977 9841000000</li>
                            <li class="footer_info">bloom@gmail.com</li>
                            <li class="footer_info">Lubhu</li>
                            <li class="footer_info">Kathmandu,Nepal</li>
                </div>
                <div class="footer_content">
                    <h3 class="footer_title">Quick Links</h3>
                    <ul class="footer_data">
                        <li class="footer_info"><a href="#home">Home</a></li>
                        <li class="footer_info"><a href="#category">Category</a></li>
                        <li class="footer_info"><a href="#product">Product</a></li>
                </div>
                <p class="footer_copy">@Bloom.All rights reserved</p>
            </div>
        </footer>
    <!-- </div> -->

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="Searchscript.js"></script>
    

</body>

</html>