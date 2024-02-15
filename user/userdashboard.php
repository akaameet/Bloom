<?php
include('../dbconn.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$u_id = $_SESSION['user_id'];

//user 
$id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT name FROM user WHERE user_id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user dashboard</title>
    <link rel="stylesheet" href="userdashboard.css" />
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
                            <?php echo $user['name']; ?>
                        </span><i class="fas fa-user-cog"></i></button>
                    <div class="dropdown-content">
                        <a href="setting.php">Edit Profile</a>
                        <a href="../userlogout.php">Logout</a>
                    </div>
                </div>
            </div>
            <!-- <div class="user-history">
                <div class="donate-history">
                    <h3>Donate History</h3>
                    <?php if ($donate) {
                        $totalDonated = count($donate);
                        $lastDonated = date('Y-m-d', strtotime($donate[$totalDonated - 1]['timestamp'])); ?>
                        <table border="3">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Total Donated</th>
                                    <th>Last Donated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo $donate[$totalDonated - 1]['name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $totalDonated ?>
                                    </td>
                                    <td>
                                        <?php echo $lastDonated ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } else {
                        echo '<p>No donation history available.</p>';
                    } ?>
                </div>

                <div class="donate-history">
                    <h3>Recently Requested Forms </h3>
                    <?php if ($item) { ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Date of Birth</th>
                                    <th>Gender</th>
                                    <th>Blood Group</th>
                                    <th>Quantity</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo $item['Pname'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['email'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['contact'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['dob'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['gender'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['blood_group'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['qty'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['address'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['status'] ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p> No recently Requested Forms.</p>
                    <?php } ?>


                </div>
                <div class="donate-history">
                    <h3>Request History</h3>

                    <table border="3">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Patient Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Blood Group</th>
                                <th>Quantity</th>
                                <th>Address</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($request as $item) { ?>
                                <tr>
                                    <td>
                                        <?php echo $count ?>
                                    </td>
                                    <td>
                                        <?php echo $item['Pname'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['email'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['contact'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['dob'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['gender'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['blood_group'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['qty'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['address'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['status'] ?>
                                    </td>

                                    <?php $count++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div> -->

        </section>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    var categoriesToggle = document.getElementById('categories-toggle');
    var categoriesDropdown = document.getElementById('categories-dropdown');

    // Toggle dropdown content when clicking on the Categories link
    categoriesToggle.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior
        categoriesDropdown.classList.toggle('show');
    });

    // Close dropdown content when clicking outside of it
    window.addEventListener('click', function(event) {
        if (!event.target.matches('#categories-toggle')) {
            if (categoriesDropdown.classList.contains('show')) {
                categoriesDropdown.classList.remove('show');
            }
        }
    });
});



    </script>
</body>

</html>