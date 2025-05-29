<?php
// DATABASE CONNECTION AND SETUP
$host = 'localhost';
$user = 'root';       // Change if your DB username is different
$pass = '';           // Change if your DB password is set
$db = 'restaurant';

// Connect to MySQL
$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Create database if not exists
$conn->query("CREATE DATABASE IF NOT EXISTS $db");
$conn->select_db($db);

// Create menu table if not exists
$conn->query("
    CREATE TABLE IF NOT EXISTS menu (
        id INT AUTO_INCREMENT PRIMARY KEY,
        item_name VARCHAR(255) NOT NULL UNIQUE,
        display_name VARCHAR(255) NOT NULL,
        price DECIMAL(6,2) NOT NULL
    )
");

// Insert default menu items if table is empty
$checkMenu = $conn->query("SELECT COUNT(*) AS count FROM menu");
$count = $checkMenu->fetch_assoc()['count'];
if ($count == 0) {
    $conn->query("
        INSERT INTO menu (item_name, display_name, price) VALUES
        ('biryani', 'Chicken Biryani', 12.99),
        ('paneerTikka', 'Paneer Tikka', 8.99),
        ('butterChicken', 'Butter Chicken', 15.99),
        ('vegCurry', 'Vegetable Curry', 10.99)
    ");
}

// FETCH MENU
$menuItems = [];
$result = $conn->query("SELECT item_name, display_name, price FROM menu");
while ($row = $result->fetch_assoc()) {
    $menuItems[$row['item_name']] = [
        'name' => $row['display_name'],
        'price' => $row['price']
    ];
}

// HANDLE ORDER FORM
$orderDetails = '';
$totalAmount = 0.00;
$quantities = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($menuItems as $key => $item) {
        $qty = isset($_POST[$key]) ? (int)$_POST[$key] : 0;
        $quantities[$key] = $qty;
        $itemTotal = $qty * $item['price'];
        $totalAmount += $itemTotal;
        if ($qty > 0) {
            $orderDetails .= "{$item['name']} x $qty: $" . number_format($itemTotal, 2) . "<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ms India Restaurant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f0e1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 600px;
        }
        h2 {
            color: #B13F3B;
            text-align: center;
        }
        .menu-item {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }
        input[type="number"] {
            width: 60px;
            padding: 5px;
        }
        .order-btn, .payment-btn {
            background: #B13F3B;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
        }
        .order-btn:hover, .payment-btn:hover {
            background: #6A1B1B;
        }
        .summary {
            margin-top: 20px;
        }
        .summary p {
            margin: 5px 0;
        }
        select, input[disabled] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome to Ms India Restaurant</h2>
    <form method="POST">
        <h3>Our Menu</h3>
        <?php foreach ($menuItems as $key => $item): ?>
            <div class="menu-item">
                <span><?php echo htmlspecialchars($item['name']); ?> - $<?php echo number_format($item['price'], 2); ?></span>
                <input type="number" name="<?php echo $key; ?>" min="0" value="<?php echo isset($quantities[$key]) ? $quantities[$key] : 0; ?>">
            </div>
        <?php endforeach; ?>
        <button type="submit" class="order-btn">Generate Order Summary</button>
    </form>

    <?php if ($orderDetails): ?>
        <div class="summary">
            <h3>Order Summary</h3>
            <p><?php echo $orderDetails; ?></p>
            <p><strong>Total: $<?php echo number_format($totalAmount, 2); ?></strong></p>

            <h4>Payment Method</h4>
            <select>
                <option>Credit/Debit Card</option>
                <option>PayPal</option>
            </select>
            <input type="number" value="<?php echo $totalAmount; ?>" disabled>
            <button class="payment-btn" onclick="alert('Payment Processed!')">Proceed to Payment</button>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
