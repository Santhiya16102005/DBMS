<?php
// save_order.php

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve items and prices from POST
$items = $_POST['items'] ?? [];
$prices = $_POST['prices'] ?? [];

if (empty($items) || empty($prices) || count($items) !== count($prices)) {
    die("Invalid order data");
}

// Build order details array and calculate total
$orderDetails = [];
$totalAmount = 0;

for ($i = 0; $i < count($items); $i++) {
    $item = $conn->real_escape_string($items[$i]);
    $price = floatval($prices[$i]);
    $orderDetails[] = ['item' => $item, 'price' => $price];
    $totalAmount += $price;
}

// Convert order details to JSON
$orderDetailsJson = json_encode($orderDetails);

// Prepare statement
$stmt = $conn->prepare("INSERT INTO orders (order_details, total_amount) VALUES (?, ?)");

// Check if prepare() succeeded
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters and execute
$stmt->bind_param("sd", $orderDetailsJson, $totalAmount);

if ($stmt->execute()) {
    echo "Order placed successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
