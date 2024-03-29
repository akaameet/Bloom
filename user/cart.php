<?php
include('../dbconn.php');
session_start();

// Check if the user is logged in
$userLoggedIn = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Handle item deletion if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_item'])) {
    if (isset($_POST['product_id']) && $userLoggedIn) {
        $quantity = $_POST['quantity'];
        $product_id = $_POST['product_id'];

        $stmt = $pdo->prepare("UPDATE product SET stock = stock + :quantity WHERE product_id = :product_id");
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();

        $stmt = $pdo->prepare('DELETE FROM cart WHERE product_id = :product_id AND user_id = :user_id');
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':user_id', $userLoggedIn);
        $stmt->execute();
        header('Location: cart.php');
        exit();
    }
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $stmt = $pdo->prepare('UPDATE cart SET quantity = :quantity WHERE product_id = :product_id AND user_id = :user_id');
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':user_id', $userLoggedIn);
    $stmt->execute();
} 

// Check if the user is logged in and retrieve cart items
if ($userLoggedIn) {
    $stmt = $pdo->prepare('SELECT * FROM cart WHERE user_id = :user_id');
    $stmt->bindParam(':user_id', $userLoggedIn);
    $stmt->execute();
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // If the user is not logged in, set cartItems to an empty array
    $cartItems = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
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
            <li class="homeLink"><a href="index.php#home">Home</a></li>
            <li><a href="index.php#category">Category</a></li>
            <li><a href="product.php">Products</a></li>
            <li><a href="index.php#contact">Contacts</a></li>     
        </ul>
        <div class="icons">
            <!-- <div class="fa fa-search" id="search-btn"></div> -->
            <div class="fa fa-cart-shopping" id="cart" style="background-color: #5D9943; color: white;"></div>
            <?php if ($userLoggedIn): ?>
              <!-- Show logout icon if user is logged in -->
                    <a href="userProfile.php"><div class="fa-solid fa-house-user" id="logout-btn"></div></a>
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

    <div class="cart-container">
        <div class="cart-items">
        <?php if ($userLoggedIn && count($cartItems) > 0): ?>
            <h1>Shopping Cart</h1>
                <table >
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartItems as $item): ?>
                                <tr data-item-id="<?php echo $item['product_id']; ?>"> <!-- Add data-item-id attribute -->
                                    <td><img src="../assets/img/<?php echo $item['image']; ?>" alt="Product Image"></td>
                                    <td><?php echo $item['name']; ?></td>
                                    <td class="price1"><?php echo $item['price']; ?></td> <!-- Add class="price" -->
                                    <td>
                                        <button class="quantity-btn minus">-</button>
                                        <input type="text" class="quantity" value="<?php echo $item['quantity']; ?>">
                                        <button class="quantity-btn plus">+</button>
                                    </td>
                                    <td class="sub-total"><?php echo number_format($item['price'] * $item['quantity'], 2, '.', ''); ?></td>
                                    <td>
                                        <form action="#" method="POST">
                                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                            <input type="hidden" name="quantity" value="<?php echo $item['quantity']; ?>">
                                            <button type="submit" class="delete-icon" name="delete_item"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php elseif ($userLoggedIn && count($cartItems) == 0): ?>
                <div class="empty-cart">
                    <h1>Shopping Cart</h1>
                    <p>There is nothing in the cart.</p>
                </div>
            <?php else: ?>
                <div class="empty-cart">
                    <h1>Shopping Cart</h1>
                    <p>You need to log in to view your cart.</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="total-container">
        <form action="payment.php" method="POST">
        <div class="total">Total Price: $<span class="total-price"></span></div>
        <!-- Hidden input field to send the total price -->
        <input type="hidden" name="total_price" id="total_price_input" value="">
        <!-- <input type="hidden" name="uid" id="uid" value=""> -->
        <input type="submit" class="btn" value="Checkout">
    </form>
</div>
    </div>

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
    document.querySelector('.total-price').textContent = calculateTotalPrice();
    document.getElementById('total_price_input').value = calculateTotalPrice();
});

function calculateTotalPrice() {
    var total = 0;
    document.querySelectorAll('.sub-total').forEach(function(subtotalElement) {
        total += parseFloat(subtotalElement.textContent);
    });
    return total.toFixed(2);
}

function updateCartItem(cartItem) {
    var quantityInput = cartItem.querySelector('.quantity');
    var quantity = parseInt(quantityInput.value);
    var price = parseFloat(cartItem.querySelector('.price1').textContent);
    var totalElement = cartItem.querySelector('.sub-total');
    var itemId = cartItem.dataset.itemId;

    var subtotal = quantity * price;
    totalElement.textContent = subtotal.toFixed(2);

    // Update the total price after updating the subtotal
    document.querySelector('.total-price').textContent = calculateTotalPrice();

    // Send an XMLHttpRequest to update the quantity in the database
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?php echo $_SERVER["PHP_SELF"]; ?>', true); 
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('product_id=' + itemId + '&quantity=' + quantity);
}


    </script>

</body>
</html>