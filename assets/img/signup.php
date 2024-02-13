<?php
/*
include('dbconn.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists in the database
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM user WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $emailCount = $stmt->fetchColumn();
    if ($emailCount > 0) {
        $msg = 'Email already exit.';
    } else {
        $stmt = $pdo->prepare('INSERT INTO user(name,email,password) VALUES (:name,:email,:password)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        if ($stmt->execute()) {
            $success = 1;
            header("Refresh: 2; url=/Bloodspot/login.php");
        }
    }
}


*/
?> 
<!DOCTYPE html>
<html>

<head>
    <title>Donor Signup</title>
    <link rel="stylesheet" href="login.css" /> <!-- Link to the CSS file for styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <section id="login-form">
        <div class="logo">
            <a href="index.php"><img src="img/bloodspot.png" /> </a>
        </div>
        <div class="wrapper">
            <div class="log_img">
                <img src="img/signupbg.png" />
            </div>

            <div class="container">
                <h1>Donor Signup</h1>
                <div class="message" style="color:red;">
                    <?php echo isset($msg) ? $msg : ''; ?>
                </div>
                <form id="form" action="#" method="post">

                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Full Name" />
                    <div id="name-error" class="error-message"></div>
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Email Address" />
                    <div id="email-error" class="error-message"></div>
                    <span class="toggle-password" id="toggle-pass">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" />
                        <span class="eye" onclick="togglePassword()">
                            <i id="hideopen" class="fa-solid fa-eye" style="color: #849a9a;"></i>
                            <i id="hideclose" class="fa-solid fa-eye-slash" style="color: #849a9a;"></i>
                        </span>
                    </span>
                    <div id="password-error" class="error-message"></div>
                    <span class="toggle-password" id="toggle-cpass">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm_password"
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
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>

</html>