<?php
include('../dbconn.php');
session_start();

// Check if the user is logged in
$userLoggedIn = isset($_SESSION['user_id']);

// Get the category filter from the URL
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

// Fetch all products from the database
if (!empty($categoryFilter)) {
    $stmt = $pdo->prepare('SELECT * FROM product WHERE categories = :category ORDER BY timestamp DESC');
    $stmt->bindParam(':category', $categoryFilter);
} else {
    $stmt = $pdo->prepare('SELECT * FROM product ORDER BY timestamp DESC');
}

$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Initialize an array to store product counts for each category
$productCounts = array(
    'Indoor' => 0,
    'Outdoor' => 0,
    'Succulent' => 0
);
// Count the number of products in each category
foreach ($products as $product) {
    $category = trim($product['categories']); 
    $productCounts[$category]++;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://kit.fontawesome.com/eda993e11c.js" crossorigin="anonymous"></script>
    <!-- swiper slide -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <a href="index.php">
                <img src="../assets/img/bloom-high-resolution-logo-transparent.png"/> 
            </a>
        </div>
        <input type="checkbox" id="click">
        <label for="click" class="menu-btn">
            <i class="fa-solid fa-bars"></i>
        </label>
        <ul>
            <li class="homeLink"><a href="index.php#home">Home</a></li>
            <li><a href="index.php#category">Category</a></li>
            <li class="productPage-hover"><a href="product.php">Products</a></li>
            <li><a href="index.php#contact">Contacts</a></li>     
        </ul>
        <div class="icons">
            <div class="fa fa-search" id="search-btn"></div>
            <a href="cart.php"><div class="fa fa-cart-shopping" id="cart"></div></a>
            <?php if ($userLoggedIn): ?>
                <a href="userProfile.php"> <div class="fa-solid fa-house-user" id="logout-btn"></div></a>
            <?php else: ?>
                <a href="login.php"> <div class="fa fa-user" id="login-btn"></div></a>
            <?php endif; ?>
        </div>
        <form class="search-form">
            <input type="search" id="search-box" placeholder="Search Here...">
            <label for="search-box" class="fa fa-search"></label>
        </form>
    </nav>

    <section class="productPage">
        <div class="product-list">
            <ul>
                <li><a href="product.php?category=Indoor" class="product-link <?php echo ($categoryFilter === 'Indoor') ? 'active' : ''; ?>" data-target="Indoor">Indoor Plants</a></li>
                <li><a href="product.php?category=Outdoor" class="product-link <?php echo ($categoryFilter === 'Outdoor') ? 'active' : ''; ?>" data-target="Outdoor">Outdoor Plants</a></li>
                <li><a href="product.php?category=Succulent" class="product-link <?php echo ($categoryFilter === 'Succulent') ? 'active' : ''; ?>" data-target="Succulent">Succulent</a></li>
            </ul>
        </div>
        <div class="product-item">
            <?php foreach ($productCounts as $category => $count): ?>
                <?php if ($count == 0 && $category === $categoryFilter): ?>
                    <p class='no-plants-message'>No plants available in the <?php echo $category; ?> category.</p>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php foreach ($products as $product): ?>
                <div class="box <?php echo $product['categories']; ?>">
                    <img src="../assets/img/<?php echo $product['image']; ?>" alt="Plant Image">
                    <div class="content-box">
                        <h3><?php echo $product['name']; ?></h3>
                        <p><?php echo $product['categories']; ?></p>
                        <div class="price">Rs.<?php echo $product['price']; ?></div>
                        <a href="productDetails.php?product_id=<?php echo $product['product_id']; ?><?php echo isset($_SESSION['user_id']) ? '&user_id='.$_SESSION['user_id'] : ''; ?>" class="btn">Add to Cart</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    


    <footer class="footer">
        <div class="footer_container container grid">
            <div class="footer_logo">
                <img src="../assets/img/bloom-high-resolution-logo-transparent.png"/> 
                <p>Feel free to follow us on Our Social <br>Media Handlers. All the links are <br>Given below </p>
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
        <script src="Searchscript.js"></script>
</body>
</html>