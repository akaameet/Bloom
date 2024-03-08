<?php

include('../dbconn.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = 'Unregistered';
    $phone = 'Unregistered';
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists in the database
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM user WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $emailCount = $stmt->fetchColumn();
    if ($emailCount > 0) {
        $msg = 'Email already exit.';
    } else {
        $stmt = $pdo->prepare('INSERT INTO user(name,email,password,address,phone) VALUES (:name,:email,:password,:address,:phone)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        if ($stmt->execute()) {
            $success = 1;
            header("Refresh: 2; url=/Bloom/login.php");
        }
    }
}
?>  
<!DOCTYPE html>
<html>

<head>
    <title>Signup</title>
    <link rel="stylesheet" href="../assets/css/signup.css" /> <!-- Link to the CSS file for styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <section id="signup-form">
        <div class="overlay">
         <div class="logo">
            <a href="index.php"><img src="../assets/img/bloom-high-resolution-logo-transparent.png" /> </a>
         </div>
         <div class="wrapper">
            <!-- <div class="log_img">
                <img src="img/signupbg.png" />
            </div> -->

            <div class="signup_container">
                <h1>Signup</h1>
                <div class="message" style="color:red;">
                    <?php echo isset($msg) ? $msg : ''; ?>
                </div>
                <form id="sign_up" action="#" method="post">

                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Full Name" />
                    <div id="name-error" class="error-message"></div>
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Email Address" />
                    <div id="email-error" class="error-message"></div>
                    <span class="toggle-password1" id="toggle-pass">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" />
                        <span class="eye" onclick="toggleNPassword()">
                            <i id="hideopen" class="fa-solid fa-eye" style="color: #849a9a;"></i>
                            <i id="hideclose" class="fa-solid fa-eye-slash" style="color: #849a9a;"></i>
                        </span>
                    </span>
                    <div id="password-error" class="error-message"></div>
                    <span class="toggle-password1" id="toggle-cpass">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password"
                            placeholder="Confirm Password" />
                        <span class="eye" onclick="toggleCPassword()">
                            <i id="Chideopen" class="fa-solid fa-eye" style="color: #849a9a;"></i>
                            <i id="Chideclose" class="fa-solid fa-eye-slash" style="color: #849a9a;"></i>
                        </span>
                    </span>
                    <div id="confirm-password-error" class="error-message"></div>
                    <input type="submit" class="btn" value="Signup" />
                </form>
                <!-- <script src="sweetalert.js"></script> -->
                <script src="validate_signup.js"></script>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
            <!-- including footer section -->

         </div>
        </div>
    </section>
    <?php
    if (isset($success) == 1) {
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
            })

            Toast.fire({
                icon: "success",
                title: "Signup Successfully"
            });
        </script>
        <?php
    }
    ?> 
</body>

</html>