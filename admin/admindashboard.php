<?php
include('../dbconn.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit();
}
$u_id = $_SESSION['admin_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $image = $_POST['product_image'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];
    $categories = $_POST['categories'];
    $stock = $_POST['stock'];
    date_default_timezone_set('Asia/Kathmandu');
    $timestamp = date('Y-m-d H:i:s');
    $stmt = $pdo->prepare("INSERT INTO product (name, price, categories, description, image, subtitle, stock, timestamp)
    VALUES (:name, :price, :categories, :description, :image, :subtitle, :stock, :timestamp)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':categories', $categories); 
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':subtitle', $subtitle);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':timestamp', $timestamp);

    if ($stmt->execute()) {
    header("Location: admindashboard.php?success=1");
}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user dashboard</title>
    <link rel="stylesheet" href="admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
     <nav>
            <ul>
                <li>
                    <div class="logo">
                        <img src="../assets/img/bloom-high-resolution-logo-transparent.png" alt="">
                    </div>
                </li>
                <li class="dropdown1">
                    <a id="categories-toggle"  href="#"> <i class="fas fa-list"></i> 
                         <span class="nav-item"> Categories</span></a>
                    <div id="categories-dropdown" class="dropdown1-content">
                        <a href="#indoor-plants">Indoor Plants</a>
                        <a href="#outdoor-plants">Outdoor Plants</a>
                    </div>
                </li>
                <li><a href="profile.php">
                        <i class="fas fa-user"></i>
                        <span class="nav-item">Profile</span>
                    </a></li>
                <li><a href="addnew.php">
                        <i class="fas fa-user"></i>
                        <span class="nav-item">Update</span>
                    </a></li>
                <li><a href="bloodstock.php">
                        <i class="fa-solid fa-shopping-cart"></i>
                        <span class="nav-item">Cart</span>
                    </a></li>
            </ul>
     </nav>


        <!-- container section started for donate -->

        <section class="main">
            <div class="main-top">
                <h1>New Arrival</h1>
                <!-- addding dropdown -->
                <div class="dropdown">
                    <button class="dropbtn"><span>
                            
                        </span><i class="fas fa-user-cog"></i></button>
                    <div class="dropdown-content">
                        <a href="setting.php">Edit Profile</a>
                        <a href="../userlogout.php">Logout</a>
                    </div>
                </div>
            </div>
       <div class="new_product">    
              <div class="admin-product-form-container">
                  <form id="form" action="#" method="POST">
                    <h3>Add a new product</h3>
                    <input type="text" placeholder="Enter a product name" name="product_name" class="box">
                    <input type="file"  accept="image/png,image/jpeg,image/jpg" name="product_image" class="box">
                    <input type="number" placeholder="Enter a product price" name="product_price" class="box">
                    <input type="text" placeholder="Subtitle" name="subtitle" class="box">
                    <input type="text" placeholder="Categories" name="categories" class="box">
                    <input type="number" placeholder="Enter a stock" name="stock" class="box">
                    <textarea id="description" name="description" rows="4" cols="50" class="box"required></textarea>
                    <input type="submit" class="btn" name="add_product" value="add_product">
                 </form>
                    
            </div>
        </div>
    </section>
    </div>
    <?php
    @$success = $_GET['success'];
    if(null != $success && $success == 1) {
        ?>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer)
                    toast.addEventListener("mouseleave", Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: "success",
                title: "Data Submitted Successfully"
            });
        </script>
        <?php
        }
        ?>
</body>

</html>