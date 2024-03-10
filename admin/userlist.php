<?php
include('../dbconn.php');
session_start();

// Check if the user is logged in
$userLoggedIn = isset($_SESSION['admin_id']);

$stmt = $pdo->prepare('SELECT * FROM user ');
$stmt->execute();
$userList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
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
            <li><a>Product<a></li>     
        </ul>
        <div class="icons">
            <!-- <div class="fa fa-search" id="search-btn"></div> -->
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
                <li><a href="admindashboard.php" >
                        <i class="fas fa-user"></i>
                        <span class="nav-item">Dashboard</span>
                    </a></li>
                <li><a href="addProduct.php" >
                <i class="fa-solid fa-cart-shopping"></i>
                        <span class="nav-item">New Product</span>
                    </a></li>
                <li><a href="adminProduct.php" >
                        <i class="fa-solid fa-list"></i>
                        <span class="nav-item">Product</span>
                    </a></li>
                <li><a href="userlist.php" class="active">
                            <i class="fas fa-user"></i>
                            <span class="nav-item">User</span>
                        </a></li>
                <li><a href="orderList.php" >
                <i class="fa-solid fa-truck"></i>
                        <span class="nav-item">Order</span>
                    </a></li>
                <li><a href="adminProfile.php" >
                     <i class="fas fa-user"></i>
                    <span class="nav-item">Profile</span>
                </a></li>
            </ul>   
            </ul>
         
        </div>

        <div class="cart-container">
           <div class="cart-items">
           <?php if ($userLoggedIn && count($userList) > 0): ?>
                <table >
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($userList as $user): ?>
                                <tr data-item-id="<?php echo $item['user_id']; ?>"> 
                                    <td><?php echo $user['name']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><?php echo $user['phone']; ?></td>
                                    <td><?php echo $user['address']; ?></td>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php elseif (!$userLoggedIn): ?>
                <!-- Display a message if the user is not logged in -->
                <div class="empty-cart">
                    <!-- <h1>Shopping Cart</h1> -->
                    <p>There is nothing in the list.</p>
                </div>
                 <?php endif; ?>
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
