<?php
$host = "localhost";
$username = "root";
$password = ""; // default for XAMPP
$dbname = "restaurant_db";

// Connect to database
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$item_name = $_POST['item_name'];
$quantity = $_POST['quantity'];

// Insert into orders table
$sql = "INSERT INTO orders (name, phone, email, item_name, quantity)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $name, $phone, $email, $item_name, $quantity);

if ($stmt->execute()) {
    echo "<script>alert('Order placed successfully!'); window.location.href='index.html';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>