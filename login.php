<?php

session_start();
include('dbconn.php');

if (isset($_SESSION['user_id'])) {
    header('location:  user/userdashboard.php');
    exit;
}

if (isset($_SESSION['admin_id'])) {
    header('location: admin/admindashboard.php');
    exit;
}
// var_dump($admin);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == '' || $password == '') {
        $invalid = 'Fill all the fields';
    } else {
        // Check in user table
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check in admin table
        $stmt_admin = $pdo->prepare("SELECT * FROM admin WHERE email = :email");
        $stmt_admin->bindParam(':email', $email);
        $stmt_admin->execute();
        $admin = $stmt_admin->fetch(PDO::FETCH_ASSOC);

        if (!$user && !$admin) {
            $invalid = "Email doesn't exist";
        } elseif ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            header("Location: user/userdashboard.php");
            exit;
        } elseif ($admin &&  $admin['password']) {
            $_SESSION['admin_id'] = $admin['admin_id'];
            header("Location: admin/admindashboard.php");
            exit;
        } else {
            $invalid = "Invalid Credentials!";
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="login.css" /> <!-- Include your CSS file here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- header section-->

    <!-- Add the content for the "Donate Now" login page here -->
    <section id="login-form">
            <div class="overlay">
            <div class="logo">
                <a href="index.php"><img src="assets/img/bloom-high-resolution-logo-transparent.png"/> </a>
            </div>
            <div class="wrapper">
                <!-- <div class="log_img">
                    <img src="assets/img/login_back.jpg" />
                </div> -->
    
    
                <div class="container">
                    <h1>Login</h1>
                    <div class="message">
                        <?php echo isset($invalid) ? $invalid : ''; ?>
                    </div>
                    <form action="#" method="post">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" />
    
                        <div class="toggle-password" id="toggle-pass"></span>
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Enter your password" />
                            <span class="eye" onclick="togglePassword()">
                                <i id="hideopen" class="fa-solid fa-eye" style="color: #849a9a;"></i>
                                <i id="hideclose" class="fa-solid fa-eye-slash" style="color: #849a9a;"></i>
                            </span>
                        </div>
                        <input type="submit" name="sub" class="btn" value="Login" />
                    </form>
    
                    <script>
                    function togglePassword() {
                        const x = document.getElementById('password');
                        const show = document.getElementById('hideopen');
                        const hide = document.getElementById('hideclose');
                        if (x.type === "password") {
                            x.type = "text";
                            show.style.display = "none";
                            hide.style.display = "block";
                        } else {
                            x.type = "password";
                            show.style.display = "block";
                            hide.style.display = "none";
                        }
                    }
                    </script>
                    <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                    <!-- Add a link to the signup page if needed -->
    
                </div>
    
            </div>
        </div>
    </section>
</body>

</html>