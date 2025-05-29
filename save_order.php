<?php
session_start(); // start session to access user_id

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

// Check if user is logged in and user_id exists
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}
$user_id = $_SESSION['user_id'];

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

// Prepare statement with user_id
$stmt = $conn->prepare("INSERT INTO orders (user_id, order_details, total_amount) VALUES (?, ?, ?)");

// Check if prepare() succeeded
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters and execute (user_id = int, order_details = string, total_amount = double)
$stmt->bind_param("isd", $user_id, $orderDetailsJson, $totalAmount);

if ($stmt->execute()) {
    // Redirect to payment page automatically after successful insert
    header("Location: payment.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
