<?php
include('../dbconn.php');
session_start();

$userLoggedIn = isset($_SESSION['user_id']);
// Check if either product_id or user_id is present in the URL parameters
if(isset($_GET['product_id']) && isset($_GET['user_id'])) {
    $productId = $_GET['product_id'];
    $userId = $_GET['user_id'];
    $_SESSION['product_id'] = $productId;
    $_SESSION['user_id'] = $userId;
} elseif(isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    $_SESSION['product_id'] = $productId;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['user_id'])) {
        $product_id = $_POST['product_id'];
        $image = $_POST['image'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $quantity = $_POST['quantity']; 
    
        $stmt = $pdo->prepare("UPDATE product SET stock = stock - :quantity WHERE product_id = :product_id");
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        // Check if the same product exists in the cart for the logged-in user
        $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);

 
 if ($existingProduct) {
     // If the same product exists, update the quantity in the cart
     $newQuantity = $existingProduct['quantity'] + $quantity;
     $stmt = $pdo->prepare("UPDATE cart SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id");
     $stmt->bindParam(':quantity', $newQuantity);
     $stmt->bindParam(':user_id', $_SESSION['user_id']);
     $stmt->bindParam(':product_id', $product_id);
     $stmt->execute();
     $success = true;
     header("Refresh: 2;product.php?product_id={$_SESSION['product_id']}&user_id={$_SESSION['user_id']}");
 } else {
     // If the product doesn't exist in the cart, insert it as a new entry
     $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, image, name, price, quantity) VALUES (:user_id, :product_id, :image, :product_name, :product_price, :quantity)");
     $stmt->bindParam(':user_id', $_SESSION['user_id']);
     $stmt->bindParam(':product_id', $product_id);
     $stmt->bindParam(':image', $image);
     $stmt->bindParam(':product_name', $product_name);
     $stmt->bindParam(':product_price', $product_price);
     $stmt->bindParam(':quantity', $quantity);
     if ($stmt->execute()) {
         // Show SweetAlert for successful addition to cart
         $success = true;
         header("Refresh: 2;product.php?product_id={$_SESSION['product_id']}&user_id={$_SESSION['user_id']}");
     }
 }
    }
}

if(isset($_SESSION['product_id']) ) {    
 $stmt = $pdo->prepare('SELECT * FROM product WHERE product_id = :id');
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT); 
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

if($product) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name'];?></title>
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
            <li class="productPage-hover"><a href="product.php">Products</a></li>
            <li><a href="index.php#contact">Contacts</a></li>     
        </ul>
        <div class="icons">
            <!-- <div class="fa fa-search" id="search-btn"></div> -->
            <a href="cart.php"><div class="fa fa-cart-shopping" id="cart"></div></a>
            <?php if ($userLoggedIn): ?>
              <!-- Show logout icon if user is logged in -->
                    <a href="userProfile.php"><div class="fa-solid fa-house-user" id="logout-btn"></div></a>
                    <?php else: ?>
                    <!-- Show login icon if user is not logged in -->
                    <a href="login.php?product_id=<?php echo $productId; ?>"> <div class="fa fa-user" id="login-btn"></div></a>
             <?php endif; ?>
         </div>
        <!-- <form class="search-form">
            <input type="search" id="search-box" placeholder="Search Here...">
            <label for="search-box" class="fa fa-search"></label>
        </form> -->
    </nav>

    <section class="productDetail">
    <div class="Detail_container">
        <div class="product-details">
            <div class="product-image">
                <img src="../assets/img/<?php echo $product['image']; ?>" alt="Product Image">
            </div>
            <div class="product-info">
                <h2><?php echo $product['name']; ?></h2>
                <p><strong>Category:</strong><?php echo $product['categories']; ?></p>
                <p><strong>Price:</strong> Rs. <?php echo $product['price']; ?></p>
                <p><?php echo $product['subtitle']; ?></p>
                <?php if ($product['stock'] == 0): ?>
                    <div class="out-of-stock-message">(Out of Stock)</div>
                <?php endif; ?>

                <div class="quantity-input">
                    <button class="quantity-btn minus">-</button>
                    <input type="text" class="quantity" value="1">
                    <button class="quantity-btn plus">+</button>
                </div>
                <!-- Add more details here if needed -->
                <form action="#" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <input type="hidden" name="image" value="<?php echo $product['image']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                    <input type="hidden" name="quantity" id="quantity" value="">
                    <!-- Add more hidden input fields if needed -->
                    <button type="submit" class="btn" id="add-to-cart-btn">Add to Cart</button>
                </form>
            </div>
            <div class="product-description">
                <h3>Plant Care Tips</h3>
                <p><?php echo $product['description'];?></p>
            </div>
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
    // Set a JavaScript variable to indicate whether the user is logged in
    var userLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

    document.addEventListener('DOMContentLoaded', function() {
        // Get the plus and minus buttons and the quantity input field
        var minusButton = document.querySelector('.quantity-btn.minus');
        var plusButton = document.querySelector('.quantity-btn.plus');
        var quantityInput = document.querySelector('.quantity');

        // Add event listeners to the plus and minus buttons
        minusButton.addEventListener('click', function() {
            // Ensure the quantity is not less than 1
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        });

        plusButton.addEventListener('click', function() {
            // Increment the quantity
            quantityInput.value = parseInt(quantityInput.value) + 1;
        });

        // Form submission handling
        var addToCartForm = document.querySelector('form');

        addToCartForm.addEventListener('submit', function(event) {
            // Set the quantity value to the hidden input field before form submission
            document.getElementById('quantity').value = quantityInput.value;

            // Check if the user is logged in
            if (!userLoggedIn) {
                event.preventDefault(); // Prevent the default form submission

                // If not logged in, display a SweetAlert message
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'You need to login first!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
        <?php if (isset($success) && $success): ?>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
        Toast.fire({
            icon: 'success',
            title: 'Added to cart successfully'
        });
    <?php endif; ?>
    });
</script>

</body>
</html>
<?php 
  } else {
    echo "Product not found.";
}
} else {
echo "Product ID not provided.";
}
?>