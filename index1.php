<?php
include('dbconn.php');
session_start();

// Check if the user is logged in
$userLoggedIn = isset($_SESSION['user_id']);
//product recently added
if(isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    // Query to search for products matching the search term
    $stmt = $pdo->prepare("SELECT * FROM product WHERE name LIKE :searchTerm");
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    $stmt->execute();
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $searchResults = array(); // Initialize empty array if no search query
}
$stmt = $pdo->prepare('SELECT * FROM product ORDER BY timestamp DESC LIMIT 10');
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
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
                <a href="#"> 
                    <img src="assets/img/bloom-high-resolution-logo-transparent.png"/> 
                </a>
            </div>
        </div>
        <input type="checkbox" id="click">
        <label for="click" class="menu-btn">
            <i class="fa-solid fa-bars"></i>
        </label>
        <ul>
            <li class="homeLink"><a href="#home">Home</a></li>
            <li class="categoryLink"><a href="#category">Category</a></li>
            <li class="productLink"><a href="product.php">Products</a></li>
            <li class="contactLink"><a href="#contact">Contact</a></li>   
        </ul>
        <div class="icons">
            <div class="fa fa-search" id="search-btn"></div>
            <a href="cart.php"><div class="fa fa-cart-shopping" id="cart"></div></a>
            <?php if ($userLoggedIn): ?>
                <!-- Show logout icon if user is logged in -->
                <a href="./user/userProfile.php"><div class="fa fa-sign-out" id="logout-btn"></div></a>
                <?php else: ?>
                    <!-- Show login icon if user is not logged in -->
                    <a href="login.php"><div class="fa fa-user" id="login-btn"></div></a>
                    <?php endif; ?>
                </div>
                <form action="" method="POST" class="search-form">
                    <input type="search" name="search" id="search-box" placeholder="Search Here...">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
                
            </form>
        </nav>
        <?php if(!empty($searchResults)): ?>
           <!-- Search results section -->
           <section class="search-results">
               <div class="product-grid">
                   <?php foreach ($searchResults as $product): ?>
                       <div class="product-item">
                           <img src="assets/img/<?php echo $product['image']?>" alt="Product Image">
                           <div class="product-details">
                               <h3 class="product-name"><?php echo $product['name']?></h3>
                               <div class="product-price">Rs. <?php echo $product['price']?></div>
                               <a href="productDetails.php?product_id=<?php echo $product['product_id']; ?>&user_id=<?php echo $userLoggedIn?>" class="btn">Add to Cart</a>
                           </div>
                       </div>
                   <?php endforeach; ?>
               </div>
           </section>
       <?php else: ?>
        <!--home section-->
        
        <section class="home" id="home">
                <div class="overlay">
                    <div class="content">
                        <h3>Green Oasis:<span>Explore</span> Our Lush Plants</h3>
                        <p>Transform your space with our lush plants, nurturing both your home and soul</p>
                        <a href="product.php" class="btn">Shop Now</a>
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
                            <a href="product.php?category=Indoor" class="btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="box">
                        <img src="assets/img/outdoor.jpg" alt="indoor">
                        <div class="content-box">
                            <h3>Outdoor plant</h3>
                            <a href="product.php?category=Outdoor" class="btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="box">
                        <img src="assets/img/succulent.jpg" alt="indoor">
                        <div class="content-box">
                            <h3>Succulent</h3>
                            <a href="product.php?category=Succulent" class="btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="box">
                        <img src="assets/img/bonsai.jpg" alt="indoor">
                        <div class="content-box">
                            <h3>Bonsai</h3>
                            <a href="product.php?category=Bonsai" class="btn">Shop Now</a>
                        </div>
                    </div>
        
        
                </div>
        
            </section>
            <!-- step section -->

            <section class = "steps section container">

                <div class="steps_bg">
                    <h2 class="step_section_title">Steps to start your <br>plants off right</h2>
                    <div class="steps_container grid">
                        <div class="step_card">

                                <div class="step_number"><i class="fa-brands fa-pagelines"></i></div>

                            <h3 class="step_title">Choose Plant</h3> 
                            <p class="step_description">We have several varities plants to choose from</p>                           
                        </div>
                        <div class="step_card">

                                <div class="step_number"><i class="fa-solid fa-cart-shopping"></i></div>

                            <h3 class="step_title">Place an order</h3> 
                            <p class="step_description">Once your is set,we move to the next step which is the shipping</p>                           
                        </div>
                        <div class="step_card">

                                <div class="step_number"><i class="fa-solid fa-truck-fast"></i></div>

                            <h3 class="step_title">Get plants delivered</h3> 
                            <p class="step_description">Our delivery process is easy,you receive the plant direct to your door</p>                           
                        </div>
                    </div>
                </div>
                </section>
        <!-- product section -->
        <section class="product" id="product">
            <h1 class="step_section_title">New Arrival</h1>
                <div class="swiper product-slider">
                        <div class="swiper-wrapper">
                          <?php foreach ($products as $product): ?>
                            <div class="swiper-slide box">
                                <img src="assets/img/<?php echo $product['image']?>" alt="indoor">
                                <div class="content-box">
                                    <h3 ><?php echo $product['name']?></h3>
                                    <div class="price">Rs.<?php echo $product['price']?></div>
                                    <a href="productDetails.php?product_id=<?php echo $product['product_id']; ?>&user_id=<?php echo $userLoggedIn?>" class="btn">Add to Cart</a>
                                </div>
                            </div>
                            <?php endforeach; ?>
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
    <?php endif; ?>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="Searchscript.js"></script>
    

</body>

</html>