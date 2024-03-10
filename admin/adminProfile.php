<?php
include('../dbconn.php');
session_start();

// Check if the user is logged in
$userLoggedIn = isset($_SESSION['admin_id']);

if ($userLoggedIn) {
    $admin_id = $_SESSION['admin_id']; // Assuming user_id is stored in the session
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE admin_id = :admin_id");
    $stmt->bindParam(':admin_id', $admin_id);
    $stmt->execute();
    $userProfile = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_admin'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['password'];
    
        $stmt = $pdo->prepare("SELECT password FROM admin WHERE admin_id = :admin_id");
        $stmt->bindParam(':admin_id', $admin_id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (password_verify($old_password, $user['password'])) {
            $update_stmt = $pdo->prepare("UPDATE admin SET password = :password,name = :name, email = :email WHERE admin_id = :admin_id");
            $update_stmt->bindParam(':name', $name);
            $update_stmt->bindParam(':email', $email);
            $update_stmt->bindParam(':password', $new_password );
            $update_stmt->bindParam(':admin_id', $admin_id);
    
            if ($update_stmt->execute()) {
                $_SESSION['success'] = 2;
            } else {
                echo "Error changing password.";
            }
        } else {
            $error_message = "Old password is incorrect.";
        }
     }
    }
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
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
            <li><a>Admin Profile<a></li>     
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
                <li><a href="admindashboard.php">
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
                <li><a href="userlist.php">
                    <i class="fas fa-user"></i>
                    <span class="nav-item">User</span>
                </a></li>
                <li><a href="orderList.php" >
                <i class="fa-solid fa-truck"></i>
                        <span class="nav-item">Order</span>
                    </a></li>
                <li><a href="adminProfile.php" class="active">
                     <i class="fas fa-user"></i>
                    <span class="nav-item">Profile</span>
                </a></li>
            </ul>
         
        </div>
        
        <div class="change_password_container">
            <!-- <h3>Change Password</h3> -->
            <form action="#" method="POST" id="update_admin">
                <div class="form-group">
                <label for="name">Name:</label><br>
                 <input type="text" id="name" name="name" value="<?php echo $userProfile['name']; ?>" ><br>
                <div id="name-error" class="error-message"></div> 
                 
                 <label for="email">Email:</label><br>
                 <input type="email" id="email" name="email" value="<?php echo $userProfile['email']; ?>" ><br>
                 <div id="email-error" class="error-message"></div> 
                 <div class="toggle-password">
                    <label for="password">Old Password:</label>
                    <input type="password" id="old_password" name="old_password"
                        placeholder="Enter your old password">
                    <span class="eye" onclick="toggleOPassword()">
                        <i id="Ohideopen" class="fa-solid fa-eye" style="color: #849a9a;"></i>
                        <i id="Ohideclose" class="fa-solid fa-eye-slash" style="color: #849a9a;"></i>
                    </span>
                    <div id="old-password-error" class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
                </div>

                <div class="toggle-password">
                     <label for="password">New Password:</label>
                     <input type="password" id="password" name="password" placeholder="Enter your new password">
                     <span class="eye" onclick="toggleNPassword()">
                         <i id="Nhideopen" class="fa-solid fa-eye" style="color: #849a9a;"></i>
                         <i id="Nhideclose" class="fa-solid fa-eye-slash" style="color: #849a9a;"></i>
                     </span>
                     <div id="password-error" class="error-message"></div>
                </div>
                <div class="toggle-password">
                     <label for="password">Confirm Password:</label>
                     <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter your confirm password">
                     <span class="eye" onclick="toggleCPassword()">
                         <i id="Chideopen" class="fa-solid fa-eye" style="color: #849a9a;"></i>
                         <i id="Chideclose" class="fa-solid fa-eye-slash" style="color: #849a9a;"></i>
                     </span>
                     <div id="confirm-password-error" class="error-message"></div>
                </div>
                     <div class="button-container">
                        <input type="submit" class="btn" name="update_admin"  value="Change Password">
                    </div>
                </div>
            </form>
        </div>
        <script src="admin.js"></script>
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