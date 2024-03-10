<?php
include('../dbconn.php');
session_start();

$userLoggedIn = isset($_SESSION['admin_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_item'])) {

    if (isset($_POST['item_id']) ) {
        $item_id = $_POST['item_id'];
        $stmt = $pdo->prepare('DELETE FROM product WHERE product_id = :item_id ');
        $stmt->execute(['item_id' => $item_id]);

        header('Location: adminCart.php');
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_id']) && isset($_POST['quantity'])) {
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $stmt = $pdo->prepare('UPDATE product SET stock = :quantity WHERE product_id = :item_id');
    $stmt->execute(['quantity' => $quantity, 'item_id' => $item_id]);

} 
$stmt = $pdo->prepare('SELECT * FROM product ');
$stmt->execute();
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <li><a href="adminProduct.php" class="active">
                <i class="fa-solid fa-list"></i>
                        <span class="nav-item">Product</span>
                    </a></li>
                <li><a href="userlist.php">
                    <i class="fas fa-user"></i>
                    <span class="nav-item">User</span>
                </a></li>
                <li><a href="orderList.php" >
                <i class="fa-solid fa-truck"></i>
                        <span class="nav-item">Order</span>
                    </a></li>
                <li><a href="adminProfile.php">
                     <i class="fas fa-user"></i>
                    <span class="nav-item">Profile</span>
                </a></li>
            </ul>
         
        </div>

        <div class="cart-container">
           <div class="cart-items">
           <?php if ($userLoggedIn && count($cartItems) > 0): ?>
                <table >
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartItems as $item): ?>
                                <tr data-item-id="<?php echo $item['product_id']; ?>"> <!-- Add data-item-id attribute -->
                                    <td><img src="../assets/img/<?php echo $item['image']; ?>" alt="Product Image"></td>
                                    <td><?php echo $item['name']; ?></td>
                                    <td class="price"><?php echo $item['price']; ?></td> <!-- Add class="price" -->
                                    <td>
                                        <button class="quantity-btn minus">-</button>
                                        <input type="text" class="quantity" value="<?php echo $item['stock']; ?>">
                                        <button class="quantity-btn plus">+</button>
                                    </td>
                                    <td> </td>
                                    <td>
                                        <form action="#" method="POST">
                                            <input type="hidden" name="item_id" value="<?php echo $item['product_id']; ?>">
                                            <button type="submit" class="delete-icon" name="delete_item"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                    <td><a href="admin_PDetails.php?product_id=<?php echo $item['product_id']; ?>" class='update_btn'>Details</a></td>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php elseif (!$userLoggedIn): ?>
                <!-- Display a message if the user is not logged in -->
                <div class="empty-cart">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.quantity-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var quantityInput = this.parentNode.querySelector('.quantity');
            var currentValue = parseInt(quantityInput.value);

            if (this.classList.contains('minus')) {
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                    updateCartItem(this.parentNode.parentNode);
                }
            } else if (this.classList.contains('plus')) {
                quantityInput.value = currentValue + 1;
                updateCartItem(this.parentNode.parentNode);
            }
        });
    });

    function updateCartItem(cartItem) {
        var quantityInput = cartItem.querySelector('.quantity');
        var quantity = parseInt(quantityInput.value);
        var itemId = cartItem.dataset.itemId;

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo $_SERVER["PHP_SELF"]; ?>', true); 
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('item_id=' + itemId + '&quantity=' + quantity);
            }
        });
    </script>

</body>
</html>
