<?php
include('../dbconn.php');
session_start();

// Check if the user is logged in
$userLoggedIn = isset($_SESSION['user_id']);

// Check if the search term is provided in the URL query parameter
if(isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    // Query to search for products matching the search term
    $stmt = $pdo->prepare("SELECT * FROM product WHERE name LIKE :searchTerm");
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    $stmt->execute();
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // If no search term is provided, set search results as an empty array
    $searchResults = array();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://kit.fontawesome.com/eda993e11c.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <nav class="navbar">
        <div class="logo">
            <a href="#"> 
                <img src="../assets/img/bloom-high-resolution-logo-transparent.png"/> 
            </a>
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
                <a href="userProfile.php"><div class="fa-solid fa-house-user" id="logout-btn"></div></a>
            <?php else: ?>
                <a href="login.php"><div class="fa fa-user" id="login-btn"></div></a>
            <?php endif; ?>
        </div>
        <form class="search-form" action="search.php" method="GET">
            <input type="search" id="search-box" name="search" placeholder="Search Here...">
            <label for="search-box" class="fa fa-search"></label>
        </form>
    </nav>
    
    <section class="search" id="search">
        <h1 class="search-heading">Search Results</h1>
        <div class="search-container">
            <?php if(!empty($searchResults)): ?>
                <div class="search-results">
                    <?php foreach ($searchResults as $product): ?>
                        <div class="search-item">
                            <img src="../assets/img/<?php echo $product['image']?>" alt="Product Image">
                            <div class="search-details">
                                <div class="search-name"><?php echo $product['name']?></div>
                                <div class="search-price""> <?php echo $product['categories']?></div>
                                <div class="search-price">Rs. <?php echo $product['price']?></div>
                                <a href="productDetails.php?product_id=<?php echo $product['product_id']; ?><?php echo isset($_SESSION['user_id']) ? '&user_id='.$_SESSION['user_id'] : ''; ?>" class="btn">Add to Cart</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No search results found.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- footer section -->
    <footer class="footer">
        <div class="footer_container container grid">
            <div class="footer_logo">
                <!-- <a href=""> -->
                    <img src="../assets/img/bloom-high-resolution-logo-transparent.png"/> 
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

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="Searchscript.js"></script>
</body>
</html>
