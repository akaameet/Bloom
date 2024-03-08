<?php
    session_start();
    include '../dbconn.php';

    if(!isset($_SESSION['user_id'])){
        header('location: index.php');
    }

    $status = $_GET['status'];
    $amount = $_GET['amount'];
    $user_id = $_SESSION['user_id'];
    $transaction_id = $_GET['transaction_id'];

    $total = $amount / 100;

    $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = :user_id");
    $stmt ->bindParam(':user_id', $user_id);
    $stmt ->execute();

    $cartItems = array();
    $status= "Paid";

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $cartItems[] = array(
            'product_id' => $row['product_id'],
            'name' => $row['name'],
            'image' => $row['image'],
            'price' => $row['price'],
            'quantity' => $row['quantity'],
        );
    }

    foreach($cartItems as $item){
        $product_id = $item['product_id'];
        $name = $item['name'];
        $image = $item['image'];
        $price = $item['price'];
        $quantity = $item['quantity'];

        $sql = "INSERT INTO order_data (user_id, product_id, name, image, price, quantity, transaction_id, status) VALUES (:user_id, :product_id, :name, :image, :price, :quantity, :transaction_id, :status)";
        $stmt = $pdo->prepare($sql);
        $stmt ->bindParam(':user_id', $user_id);
        $stmt ->bindParam(':product_id', $product_id);
        $stmt ->bindParam(':name', $name);
        $stmt ->bindParam(':image', $image);
        $stmt ->bindParam(':price', $price);
        $stmt ->bindParam(':quantity', $quantity);
        $stmt ->bindParam(':transaction_id', $transaction_id);
        $stmt ->bindParam(':status', $status);
        $stmt ->execute();
    }

    $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = :user_id");
    $stmt ->bindParam(':user_id', $user_id);
    $stmt->execute();
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
            <li class="homeLink"><a href="index.php#home">Home</a></li>
            <li class="categoryLink"><a href="index.php#category">Category</a></li>
            <li class="productLink"><a href="product.php">Products</a></li>
            <li class="contactLink"><a href="index.php#contact">Contact</a></li>   
        </ul>
        <div class="icons">
        <a href="userProfile.php"><div class="fa-solid fa-house-user" id="logout-btn"></div></a>
        </div>
    </nav>
        <div class="success_container">
            <img src="../assets/img/success.png" alt="Success" />
            <h3 class="heading">Payment Success</h3>
            <div class="success">Thank you for purchasing via Khalti Payment Gateway! Your payment has been confirmed successfully.</div>
            <div class="success">Paid Amount: NRs. <?php echo $total; ?></div>
            <div class="success">Transaction ID: <?php echo $transaction_id; ?></div>

            <!-- Back button -->
            <a href="index.php" class="btn">Back to User Page</a>
        </div>
    
        <!-- footer section -->
        <footer class="footer">
        <div class="footer_container container grid">
            <div class="footer_logo">
                    <img src="../assets/img/bloom-high-resolution-logo-transparent.png"/> 
                <p>Feel free to follow us on Our Social <br>Media Handlers. All the links are <br>Given below </p>
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
