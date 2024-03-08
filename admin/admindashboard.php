<?php
include('../dbconn.php');
session_start();

// Check if the user is logged in
$userLoggedIn = isset($_SESSION['admin_id']);

// Retrieve total plants
$stmt = $pdo->prepare("SELECT COUNT(*) AS total_plants FROM product");
$stmt->execute();
$total_plants = $stmt->fetch(PDO::FETCH_ASSOC)['total_plants'];

//Retrieve total user
$stmt = $pdo->prepare("SELECT COUNT(*) AS total_user FROM user");
$stmt->execute();
$total_user = $stmt->fetch(PDO::FETCH_ASSOC)['total_user'];

//Retrieve total order
$stmt = $pdo->prepare("SELECT COUNT(*) AS total_order FROM order_data");
$stmt->execute();
$total_order = $stmt->fetch(PDO::FETCH_ASSOC)['total_order'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <script src="https://kit.fontawesome.com/eda993e11c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <li><a>Dashboard<a></li>     
        </ul>
        <div class="icons">
            <div class="fa fa-search" id="search-btn"></div>
            <a href="adminLogout.php"> <div class="fa fa-sign-out" id="login-btn"></div></a>
        </div>
        <!-- <form class="search-form">
            <input type="search" id="search-box" placeholder="Search Here...">
            <label for="search-box" class="fa fa-search"></label>
        </form> -->
    </nav>
    <section class="productPage">
        <div class="product-list">
            <ul>
                <li><a href="admindashboard.php" class="active" >
                        <i class="fas fa-user"></i>
                        <span class="nav-item">Dashboard</span>
                    </a></li>
                    <li><a href="addProduct.php" >
                    <i class="fa-solid fa-cart-shopping"></i>
                        <span class="nav-item">New Product</span>
                    </a></li>
                <li><a href="adminProduct.php">
                <i class="fa-solid fa-list"></i>
                        <span class="nav-item">Product</span>
                    </a></li>
                <li><a href="userlist.php">
                        <i class="fas fa-user"></i>
                        <span class="nav-item">User</span>
                    </a></li>
                <li><a href="adminProfile.php">
                        <i class="fas fa-user""></i>
                        <span class="nav-item">Profile</span>
                    </a></li>
            </ul>
         
        </div>
 
            <!-- <div class="rounded-box">
                <h2>Total Sales: $<?php echo $total_sales; ?></h2>
            </div>
            <div class="rounded-box">
                <h2>Total Quantity: <?php echo $total_quantity; ?></h2>
            </div> -->

        <div class="product-item">
        <div class="box">
             <div class="step_number"><img src="../assets/img/plant_icon-transformed.png" style="width: 40px; height: 40px;"></div>
                <h2>Total Plants: <?php echo $total_plants; ?></h2>
            </div>
            <div class="box">
            <div class="step_number"><i class="fa-solid fa-user"></i></div>
                <h2>Total User: <?php echo $total_user; ?></h2>
            </div>
            <div class="box">
            <div class="step_number"><i class="fa-solid fa-cart-shopping"></i></div>
                <h2>Total Order: <?php echo $total_order; ?></h2>
            </div>
                    
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


</body>
</html>
