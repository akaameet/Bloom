<?php
include('../dbconn.php');
session_start();

// Check if the user is logged in
$userLoggedIn = isset($_SESSION['admin_id']);

// Handle item deletion if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_item'])) {
    // Check if the item ID is provided and if the user is logged in
    if (isset($_POST['item_id']) ) {
        // Get the item ID from the POST request
        $item_id = $_POST['item_id'];
        
        // Prepare and execute the SQL statement to delete the item from the cart
        $stmt = $pdo->prepare('DELETE FROM product WHERE product_id = :item_id ');
        $stmt->execute(['item_id' => $item_id]);
        
        // Redirect the user back to the cart page after deletion
        header('Location: adminCart.php');
        exit();
    }
}
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_id']) && isset($_POST['quantity'])) {
    // Sanitize input data
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    // Prepare and execute the SQL statement to update the quantity in the cart table
    $stmt = $pdo->prepare('UPDATE product SET stock = :quantity WHERE product_id = :item_id');
    $stmt->execute(['quantity' => $quantity, 'item_id' => $item_id]);

    // You can echo a success message if needed
    // echo 'Quantity updated successfully';
    // exit();
} 

    // echo 'Invalid request';

// Check if the user is logged in
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
            <!-- <li class="homeLink"><a href="index.php#home">Home</a></li>
            <li><a href="index.php#category">Category</a></li>
            <li class="productPage-hover"><a href="product.php">Products</a></li> -->
            <li><a>Product<a></li>     
        </ul>
        <div class="icons">
            <!-- <div class="fa fa-search" id="search-btn"></div> -->
            <div class="fa fa-cart-shopping" id="cart" style="background-color: #5D9943; color: white;"></div>
            <?php if ($userLoggedIn): ?>
              <!-- Show logout icon if user is logged in -->
                    <a href="userlogout.php"><div class="fa fa-sign-out" id="logout-btn"></div></a>
                    <?php else: ?>
                    <!-- Show login icon if user is not logged in -->
                    <a href="login.php?"> <div class="fa fa-user" id="login-btn"></div></a>
             <?php endif; ?>
         </div>
        <!-- <form class="search-form">
            <input type="search" id="search-box" placeholder="Search Here...">
            <label for="search-box" class="fa fa-search"></label>
        </form> -->
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
                <li><a href="addProduct.php">
                        <i class="fas fa-user"></i>
                        <span class="nav-item">New Product</span>
                    </a></li>
                <li><a href="adminProduct.php" class="active">
                        <i class="fas fa-user"></i>
                        <span class="nav-item">Product</span>
                    </a></li>
                <li><a href="adminProfile.php">
                        <i class="fa-solid fa-shopping-cart"></i>
                        <span class="nav-item">Profile</span>
                    </a></li>
            </ul>
         
        </div>

        <div class="cart-container">
           <div class="cart-items">
           <?php if ($userLoggedIn && count($cartItems) > 0): ?>
            <!-- <h1>Update Product</h1> -->
                <table >
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <!-- <th>Update</th> -->

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartItems as $item): ?>
                                <tr data-item-id="<?php echo $item['product_id']; ?>"> <!-- Add data-item-id attribute -->
                                    <td><img src="../assets/img/<?php echo $item['image']; ?>" alt="Product Image"></td>
                                    <td><?php echo $item['name']; ?></td>
                                    <td class="price"><?php echo $item['price']; ?></td> <!-- Add class="price" -->
                                    <td>
                                        <!-- Quantity adjustment buttons -->
                                        <button class="quantity-btn minus">-</button>
                                        <input type="text" class="quantity" value="<?php echo $item['stock']; ?>">
                                        <button class="quantity-btn plus">+</button>
                                    </td>
                                    <td> </td>
                                    <td>
                                        <!-- Delete icon form -->
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
                    <h1>Shopping Cart</h1>
                    <p>There is nothing in the cart.</p>
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
        // JavaScript code to handle quantity update and total price calculation using AJAX
        document.addEventListener('DOMContentLoaded', function() {
    
    // Add event listeners to the plus and minus buttons
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

    // Function to update the cart item and total dynamically
    function updateCartItem(cartItem) {
        var quantityInput = cartItem.querySelector('.quantity');
        var quantity = parseInt(quantityInput.value);
        var itemId = cartItem.dataset.itemId;




                // Send AJAX request to update quantity in the database
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo $_SERVER["PHP_SELF"]; ?>', true); // Update this URL with the correct PHP script
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('item_id=' + itemId + '&quantity=' + quantity);
            }
        });
    </script>

</body>
</html>
