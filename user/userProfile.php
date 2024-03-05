<?php
include('../dbconn.php');
session_start();
$userLoggedIn = isset($_SESSION['user_id']);
$userProfile = null;
if ($userLoggedIn) {
    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in the session
    $query = "SELECT * FROM user WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $userProfile = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $update_query = "UPDATE user SET name = :name, email = :email, phone = :phone, address = :address WHERE user_id = :user_id";
    $update_stmt = $pdo->prepare($update_query);
    $update_stmt->bindParam(':name', $name);
    $update_stmt->bindParam(':email', $email);
    $update_stmt->bindParam(':phone', $phone);
    $update_stmt->bindParam(':address', $address);
    $update_stmt->bindParam(':user_id', $user_id);

    if ($update_stmt->execute()) {
        $_SESSION['success'] = 1; 
        $query = "SELECT * FROM user WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $userProfile = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Error updating profile.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['password'];

    $query = "SELECT password FROM user WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($old_password, $user['password'])) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $update_query = "UPDATE user SET password = :password WHERE user_id = :user_id";
        $update_stmt = $pdo->prepare($update_query);
        $update_stmt->bindParam(':password', $hashed_password);
        $update_stmt->bindParam(':user_id', $user_id);

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
    <title>Profile</title>
    <link rel="stylesheet" href="userdashboard.css">
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

        <div class="icons">
            <!-- <div class="fa fa-search" id="search-btn"></div> -->
            <div class="fa fa-cart-shopping" id="cart" style="background-color: #5D9943; color: white;"></div>
            <?php if ($userLoggedIn): ?>
              <!-- Show logout icon if user is logged in -->
                    <a href="../userlogout.php"><div class="fa fa-sign-out" id="logout-btn"></div></a>
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
                <li><a href="userProfile.php" class="active1" >
                        <i class="fas fa-user"></i>
                        <span class="nav-item">Profile</span>
                    </a></li>
                <li><a href="addProduct.php">
                        <i class="fas fa-user"></i>
                        <span class="nav-item">Order History</span>
                    </a></li>
                <!-- <li><a href="adminProduct.php">
                        <i class="fas fa-user"></i>
                        <span class="nav-item">Product</span>
                    </a></li>
                <li><a href="bloodstock.php">
                        <i class="fa-solid fa-shopping-cart"></i>
                        <span class="nav-item">Profile</span>
                    </a></li> -->
            </ul>
         
        </div>
        <div class="update_container">
            <h2>User Profile</h2>
            <form action="#" method="POST" id="update_profile">
                <div class="form-group">
                    <label for="name">Name:</label><br>
                    <input type="text" id="name" name="name" value="<?php echo $userProfile['name']; ?>" ><br>
                    <div id="name-error" class="error-message"></div> 
                    
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" value="<?php echo $userProfile['email']; ?>" ><br>
                    <div id="email-error" class="error-message"></div> 
                    
                    <label for="phone">Phone:</label><br>
                    <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" value="<?php echo $userProfile['phone']; ?>" ><br>
                    <div id="phone-error" class="error-message"></div> 

                    <label for="address">Address:</label><br>
                    <input type="text" id="address" name="address" value="<?php echo $userProfile['address']; ?>" ><br>
                    <div id="address-error" class="error-message"></div> 
                    
                    <button type="submit" name="update_profile">Update Profile</button>
                </div>
            </form>
        </div>
        

        <div class="change_password_container">
            <!-- <h3>Change Password</h3> -->
            <form action="#" method="POST" id="change_password">
                <div class="form-group">
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
                        <input type="submit" class="btn" name="change_password"  value="Change Password">
                    </div>
                </div>
            </form>
        </div>
        <script src="user.js"></script>

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
// Display profile update success alert
if (isset($_SESSION['success']) && $_SESSION['success'] == 1) {
    // Display success alert
    ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            }
        });

        Toast.fire({
            icon: "success",
            title: "Profile Updated Successfully"
        });
    </script>
    <?php
}

// Display password change success alert
if (isset($_SESSION['success']) && $_SESSION['success'] == 2) {
    // Display success alert
    ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            }
        });

        Toast.fire({
            icon: "success",
            title: "Password Changed Successfully"
        });
    </script>
    <?php
}

// Unset the session variable
unset($_SESSION['success']);
?>


</body>
</html>