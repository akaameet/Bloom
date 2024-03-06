<?php
include('../dbconn.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit();
}
$u_id = $_SESSION['admin_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $image = $_POST['product_image'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];
    $categories = $_POST['categories'];
    $stock = $_POST['stock'];
    date_default_timezone_set('Asia/Kathmandu');
    $timestamp = date('Y-m-d H:i:s');
    $stmt = $pdo->prepare("INSERT INTO product (name, price, categories, description, image, subtitle, stock, timestamp)
    VALUES (:name, :price, :categories, :description, :image, :subtitle, :stock, :timestamp)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':categories', $categories); 
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':subtitle', $subtitle);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':timestamp', $timestamp);

    if ($stmt->execute()) {
    header("Location: admindashboard.php?success=1");
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product</title>
    <link rel="stylesheet" href="admin.css">
    <script src="https://kit.fontawesome.com/eda993e11c.js" crossorigin="anonymous"></script>
    <!-- swiper slide -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <a href="../index.php">
                <img src="../assets/img/bloom-high-resolution-logo-transparent.png"/> 
            </a>
        </div>
        <input type="checkbox" id="click">
        <label for="click" class="menu-btn">
            <i class="fa-solid fa-bars"></i>
        </label>
        <ul>
            <li><a >Add a New Product</a></li>     
        </ul>
        <div class="icons">
            <div class="fa fa-search" id="search-btn"></div>
            <a href="adminCart.php"><div class="fa fa-cart-shopping" id="cart"></div></a>
            <a href="login.php"> <div class="fa fa-user" id="login-btn"></div></a>
        </div>
        <form class="search-form">
            <input type="search" id="search-box" placeholder="Search Here...">
            <label for="search-box" class="fa fa-search"></label>
        </form>
    </nav>

    <section class="productPage">
        <div class="product-list">
            <ul>
                <!-- <li>
                    <div class="logo">
                        <img src="../assets/img/bloom-high-resolution-logo-transparent.png" alt="">
                    </div>
                </li> -->
                <!-- <li class="dropdown1">
                    <a id="categories-toggle"  href="#"> <i class="fas fa-list"></i> 
                         <span class="nav-item"> Categories</span></a>
                    <div id="categories-dropdown" class="dropdown1-content">
                        <a href="#indoor-plants">Indoor Plants</a>
                        <a href="#outdoor-plants">Outdoor Plants</a>
                    </div>
                </li> -->
                <li><a href="admindashboard.php" >
                        <i class="fas fa-user"></i>
                        <span class="nav-item">Dashboard</span>
                    </a></li>
                <li><a href="addProduct.php" class="active">
                        <i class="fas fa-user"></i>
                        <span class="nav-item">New Product</span>
                    </a></li>
                <li><a href="adminProduct.php">
                        <i class="fas fa-user"></i>
                        <span class="nav-item">Product</span>
                    </a></li>
                <li><a href="adminProfile.php">
                     <i class="fa-solid fa-shopping-cart"></i>
                    <span class="nav-item">Profile</span>
                </a></li>
            </ul>
         
        </div>
    <div class="new_product">
        <form id="form" action="#" method="POST">
        <div class="input-group">
            <input type="text" placeholder="Enter a product name" name="product_name" class="box">
            <input type="file" accept="image/png,image/jpeg,image/jpg" name="product_image" class="box">
        </div>
        <div class="input-group">
            <input type="number" placeholder="Enter a product price" name="product_price" class="box">
            <input type="text" placeholder="Categories" name="categories" class="box">
        </div>
        <div class="input-group">
            <input type="number" placeholder="Enter a stock" name="stock" class="box">
        </div>
        <input type="text" placeholder="Subtitle" name="subtitle" class="box">
        <textarea id="description" name="description" rows="4" cols="50" class="box" required></textarea>
        <div class="button-container">
          <input type="submit" class="btn" name="add_product" value="Add Product">
        </div>
        </form>
    </div>

    </section>
    


    <footer class="footer">
        <div class="footer_container container grid">
            <div class="footer_logo">
                <img src="assets/img/bloom-high-resolution-logo-transparent.png"/> 
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
