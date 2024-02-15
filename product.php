<?php
include('dbconn.php');
//total user
$stmt = $pdo->prepare('SELECT * FROM product ORDER BY timestamp DESC ');
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/eda993e11c.js" crossorigin="anonymous"></script>
    <!-- swiper slide -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
<body>
    <!-- <div class="container"> -->

            <nav class="navbar">
                <div class="logo">
                    <a href="index.php">
                        <img src="assets/img/bloom-high-resolution-logo-transparent.png"/> 
                    </a>
                </div>
                </div>
                <input type="checkbox" id="click">
                <label for="click" class="menu-btn">
                    <i class="fa-solid fa-bars"></i>
                </label>
                <ul>
                <li class="homeLink"><a href="index.php#home">Home</a></li>
                <li><a href="#category">Category</a></li>
                <li><a href="product.php">Produts</a></li>
                <li><a href="#contact">Contacts</a></li>     
                </ul>
                <div class="icons">
                    <div class="fa fa-search" id="search-btn"></div>
                    <div class="fa fa-cart-shopping" id="cart"></div>
                    <a href="login.php"> <div class="fa fa-user" id="login-btn"></div></a>
                </div>
                <form class="search-form">
                    <input type="search" id="search-box" placeholder="Search Here...">
                    <label for="search-box" class="fa fa-search"></label>
        
                </form>
            </nav>
            <!--home section-->
        <section class="product">
            <div class="product-list">

                <ul>
                        <li><a href="indoor.php">
                            <span class="nav-item">Indoor Plants</span>
                        </a></li>
                        <li><a href="outdoor.php">
                            <span class="nav-item">Outdoor Plants</span>
                        </a></li>
                        <li><a href="succulent.php">
                            <span class="nav-item">Succulent</span>
                        </a></li>
                        <li><a href="bonsai.php">
                            <span class="nav-item">Bonsai</span>
                        </a></li>
                </ul>
            </div>
            <div class="product-item">
            <?php if (empty($products)): ?>
                <p class="no-plants-message">No plants available.</p>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <div class="box">
                            <img src="assets/img/<?php echo $product['image']; ?>" alt="Plant Image">
                            <div class="content-box">
                                <h3><?php echo $product['name']; ?></h3>
                                <div class="price"><?php echo $product['price']; ?></div>
                                <a href="#" class="btn">Add to Cart</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
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