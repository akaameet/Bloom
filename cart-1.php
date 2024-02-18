<?php
// Include the database connection file
include('dbconn.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit(); // Stop further execution
}

// Fetch cart items for the logged-in user from the database
$stmt = $pdo->prepare('SELECT * FROM cart WHERE user_id = :user_id');
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Cart</title>
    <link rel="stylesheet" href="style.css"> <!-- Include your CSS file -->
</head>
<body>
    <h1>Checkout Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['price']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo $item['price'] * $item['quantity']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div>
        <!-- Add a form for checkout process -->
        <form action="checkout_process.php" method="POST">
            <!-- Add any additional checkout information or fields here -->
            <button type="submit">Proceed to Checkout</button>
        </form>
    </div>
</body>
</html>
