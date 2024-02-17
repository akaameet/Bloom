<?php
// Include the database connection file
include('dbconn.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity']; // Ensure this is correctly captured from the form

    // Prepare and execute the SQL query to insert data into the cart table
    $stmt = $pdo->prepare("INSERT INTO cart (product_id, name, price, quantity) VALUES (:product_id, :product_name, :product_price, :quantity)");
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':product_price', $product_price);
    $stmt->bindParam(':quantity', $quantity);

    // Execute the statement
    if ($stmt->execute()) {
        // If insertion is successful, redirect the user to a success page
        header("Location: cart_success.php");
        exit();
    } else {
        // If insertion fails, display an error message
        echo "Error: Unable to add the product to the cart.";
    }
}
?>
<?php
include('dbconn.php');
if(isset($_GET['id'])) {
    $productId = $_GET['id'];
    
    // Fetch product details from the database based on the product ID
 $stmt = $pdo->prepare('SELECT * FROM product WHERE product_id = :id');
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT); // Corrected line
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

if($product) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="productDetails.css">
    <script src="https://kit.fontawesome.com/eda993e11c.js" crossorigin="anonymous"></script>
    <!-- swiper slide -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <a href="index.php">
                <img src="assets/img/bloom-high-resolution-logo-transparent.png"/> 
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
            <div class="fa fa-cart-shopping" id="cart"></div>
            <a href="login.php"> <div class="fa fa-user" id="login-btn"></div></a>
        </div>
        <!-- <form class="search-form">
            <input type="search" id="search-box" placeholder="Search Here...">
            <label for="search-box" class="fa fa-search"></label>
        </form> -->
    </nav>

    <section class="productDetail">
    <div class="container">
        <div class="product-details">
            <div class="product-image">
                <img src="assets/img/<?php echo $product['image']; ?>" alt="Product Image">
            </div>
            <div class="product-info">
                <h2><?php echo $product['name']; ?></h2>
                <p><strong>Category:</strong><?php echo $product['categories']; ?></p>
                <p><strong>Price:</strong> Rs. <?php echo $product['price']; ?></p>
                <p><?php echo $product['subtitle']; ?></p>

                <div class="quantity-input">
                    <button class="quantity-btn minus">-</button>
                    <input type="text" class="quantity" value="1">
                    <button class="quantity-btn plus">+</button>
                </div>
                <!-- Add more details here if needed -->
                <form action="#" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                    <input type="hidden" name="quantity" id="quantity" value="">
                    <!-- Add more hidden input fields if needed -->
                    <button type="submit" class="btn">Add to Cart</button>
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
        <!-- <script src="Searchscript.js"></script> -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
        // Get the plus and minus buttons and the quantity input field
        var minusButton = document.querySelector('.quantity-btn.minus');
        var plusButton = document.querySelector('.quantity-btn.plus');
        var quantityInput = document.querySelector('.quantity');

        // Add event listeners to the plus and minus buttons
        minusButton.addEventListener('click', function() {
            // Ensure the quantity is not less than 1
            if (quantityInput.value > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        });

        plusButton.addEventListener('click', function() {
            // Increment the quantity
            quantityInput.value = parseInt(quantityInput.value) + 1;
        });
    });

    // Function to set the quantity value to the hidden input field before form submission
    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('quantity').value = document.querySelector('.quantity').value;
    });
</script>


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