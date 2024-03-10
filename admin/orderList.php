<?php
    session_start();
    include '../dbconn.php';

    if(!isset($_SESSION['admin_id'])){
        header('location: ../user/index.php');
        exit(); // It's good practice to stop script execution after redirection
    }

    // Retrieve the user_id from the session
    $user_id = $_SESSION['admin_id'];

    // Prepare and execute the SQL statement to select order data for the user
    $stmt = $pdo->prepare("SELECT * FROM order_data ");
    $stmt->execute();
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href=" admin.css">
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
            <!-- <li class="homeLink"><a href="#home">Home</a></li>
            <li class="categoryLink"><a href="#category">Category</a></li>
            <li class="productLink"><a href="product.php">Products</a></li> -->
            <li ><a href="">Order List</a></li>   
        </ul>
        <div class="icons">
                <a href="adminLogout.php"><div class="fa fa-sign-out" id="logout-btn"></div></a>
        </div>
    </nav>
    <section class="productPage">
        <div class="product-list">
            <ul>
            <li><a href="admindashboard.php"  >
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
                <li><a href="orderList.php" class="active">
                <i class="fa-solid fa-truck"></i>
                        <span class="nav-item">Order</span>
                    </a></li>
                <li><a href="adminProfile.php">
                        <i class="fas fa-user""></i>
                        <span class="nav-item">Profile</span>
                    </a></li>
            </ul>
          </div>
                    <div class="cart-container">
                        <div class="cart-items">
                            <!-- <h1>Shopping Cart</h1> -->
                                <table >
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Product Name</th>
                                                <th>User Id</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th>Transaction Id</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($cartItems as $item): ?>
                                            <tr data-item-id="<?php echo $item['product_id']; ?>"> <!-- Add data-item-id attribute -->
                                                <td><img src="../assets/img/<?php echo $item['image']; ?>" alt="Product Image"></td>
                                                <td><?php echo $item['name']; ?></td>
                                                <td><?php echo $item['user_id']; ?></td>
                                                <td class="price"><?php echo $item['price']; ?></td> 
                                                <td class="price"><?php echo $item['quantity']; ?></td> 
                                                <td class="price"><?php echo $item['price'] * $item['quantity']; ?></td>
                                                <td class="price"><?php echo $item['transaction_id']; ?></td> 
                                                <td class="price"><?php echo $item['status']; ?></td> 
                                            </tr>
                                        <?php endforeach; ?>

                                        </tbody>
                                </table>

                    </div>
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
</body>
</html>
