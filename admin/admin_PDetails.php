<?php
include('../dbconn.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit();
}
$u_id = $_SESSION['admin_id'];

// Fetch product details from the database
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $pdo->prepare("SELECT * FROM product WHERE product_id = :product_id");
    $stmt->execute(['product_id' => $product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $product = null;
}
// echo "Existing Image Path: " . $product['image'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];
    $categories = $_POST['categories'];
    $stock = $_POST['stock'];
    $product_id = $_POST['product_id'];
    // Check if a new image file is uploaded
    if (isset($_FILES['product_image']) && is_uploaded_file($_FILES['product_image']['tmp_name']) && !empty($_FILES['product_image']['tmp_name'])) {
        // New file is uploaded
        $image = $_FILES['product_image']['name'];
        $image_tmp = $_FILES['product_image']['tmp_name'];
        move_uploaded_file($image_tmp, "../assets/img/$image");
    } else {
        // No new file uploaded, retain existing image path
        $image = isset($product['image']) ? $product['image'] : null;
    }

    $stmt = $pdo->prepare("UPDATE product SET name=:name, price=:price, categories=:categories, description=:description, image=:image, subtitle=:subtitle, stock=:stock WHERE product_id = :item_id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':categories', $categories);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':subtitle', $subtitle);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':item_id', $product_id);

    if ($stmt->execute()) {
        $stmt = $pdo->prepare("SELECT * FROM product WHERE product_id = :product_id");
        $stmt->execute(['product_id' => $product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $success = true;
        header("Refresh: 5; url=/Bloom/admin/adminProduct.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="admin.css">
    <script src="https://kit.fontawesome.com/eda993e11c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
             <li><a>Product Details <a></li>      
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
                    <li><a href="addProduct.php">
                    <i class="fa-solid fa-cart-shopping"></i>
                        <span class="nav-item">New Product</span>
                    </a></li>
                <li><a href="adminProduct.php" class="active">
                <i class="fa-solid fa-list"></i>
                        <span class="nav-item">Product</span>
                    </a></li>
                <li><a href="userlist.php" >
                        <i class="fas fa-user"></i>
                        <span class="nav-item">User</span>
                    </a></li>
                <li><a href="adminProfile.php">
                     <i class="fas fa-user"></i>
                    <span class="nav-item">Profile</span>
                </a></li>
            </ul>
         
        </div>
        <div class="new_product">
            <form id="form" action="#" method="POST"  enctype="multipart/form-data">
                <h3>Details</h3>
                <div class="input-group">
                    <input type="text" value="<?= isset($product['name']) ? $product['name'] : ''; ?>" name="product_name" class="box">
                    <input type="file" accept="image/png,image/jpeg,image/jpg" name="product_image" class="box">
                    <?php if (isset($product['image'])): ?>
                        <img src ="../assets/img/<?= $product['image']; ?>" alt="Current Image" style="max-width: 100px; border-radius: 8px; max-height: 80px;" >
                        <?php endif; ?>
                </div>
                <div class="input-group">
                    <input type="text" value="<?= isset($product['price']) ? $product['price'] : ''; ?>" name="product_price" class="box">
                    <input type="text" value="<?= isset($product['categories']) ? $product['categories'] : ''; ?>" name="categories" class="box">
                </div>
                <div class="input-group">
                    <input type="text" value="<?= isset($product['stock']) ? $product['stock'] : ''; ?>" name="stock" class="box">
                </div>
                <input type="text" value="<?= isset($product['subtitle']) ? $product['subtitle'] : ''; ?>" name="subtitle" class="box">
                <textarea id="description" name="description" rows="4" cols="50" class="box" required><?= isset($product['description']) ? $product['description'] : ''; ?></textarea>
                <input type="hidden" name="product_id" value="<?= isset($product['product_id']) ? $product['product_id'] : ''; ?>">
                <div class="button-container">
                    <input type="submit" class="btn" name="add_product" value="Update">
                </div>
            </form>
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

    <?php
    if (isset($success) && $success) {
    ?>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer)
                    toast.addEventListener("mouseleave", Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: "success",
                title: "Updated Successfully"
            });
        </script>
    <?php
    }
    ?> 
</body>
</html>
