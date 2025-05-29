<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Please log in to see your orders.");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT id, order_details, total_amount, created_at FROM orders WHERE user_id = ? ORDER BY created_at DESC");
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Your Orders</title>
<style>
  /* Background image */
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 20px;
    background: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
  }

  /* Overlay to darken background for readability */
  body::before {
    content: "";
    position: fixed;
    top:0; left:0; right:0; bottom:0;
    background: rgba(0,0,0,0.55);
    z-index: -1;
  }

  h1 {
    color: #fff;
    text-align: center;
    margin-bottom: 40px;
    text-shadow: 1px 1px 6px rgba(0,0,0,0.7);
  }

  .orders-container {
    max-width: 900px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 25px;
  }

  .order-card {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    transition: transform 0.2s ease-in-out;
  }

  .order-card:hover {
    transform: scale(1.03);
    box-shadow: 0 12px 28px rgba(0,0,0,0.25);
  }

  .order-date {
    font-weight: 600;
    font-size: 1.1rem;
    color: #333;
    margin-bottom: 15px;
  }

  .order-items {
    margin-bottom: 15px;
  }

  .order-items ul {
    list-style-type: none;
    padding-left: 0;
    margin: 0;
  }

  .order-items li {
    padding: 8px 0;
    border-bottom: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    font-size: 1rem;
  }

  .order-items li:last-child {
    border-bottom: none;
  }

  .order-total {
    font-weight: 700;
    font-size: 1.15rem;
    text-align: right;
    color: #1a73e8;
  }

  @media (max-width: 400px) {
    .order-card {
      padding: 15px;
    }
  }
</style>
</head>
<body>

<h1>Your Orders</h1>

<div class="orders-container">
<?php
if ($result->num_rows === 0) {
    echo '<p style="color:#fff; text-align:center; font-size:1.2rem;">No orders found.</p>';
} else {
    while ($row = $result->fetch_assoc()) {
        $orderDetails = json_decode($row['order_details'], true);
        $createdAt = date("F j, Y, g:i A", strtotime($row['created_at']));
        echo '<div class="order-card">';
        echo '<div class="order-date">Order Date: ' . htmlspecialchars($createdAt) . '</div>';
        echo '<div class="order-items"><ul>';
        foreach ($orderDetails as $item) {
            echo '<li><span>' . htmlspecialchars($item['item']) . '</span><span>$' . number_format($item['price'], 2) . '</span></li>';
        }
        echo '</ul></div>';
        echo '<div class="order-total">Total: $' . number_format($row['total_amount'], 2) . '</div>';
        echo '</div>';
    }
}
$stmt->close();
$conn->close();
?>
</div>

</body>
</html>
