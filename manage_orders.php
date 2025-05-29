<?php
// Database connection info
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders
$sql = "SELECT id, order_details, total_amount, created_at FROM orders ORDER BY created_at DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Manage Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        /* Background with overlay */
        body {
            background: 
                linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1470&q=80') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* Scroll for large tables */
        .table-container {
            max-width: 90vw;
            overflow-x: auto;
            margin: auto;
        }
        /* Header shadow */
        h1 {
            text-shadow: 2px 2px 6px rgba(0,0,0,0.8);
        }
        /* Table row hover */
        table tbody tr:hover {
            background-color: rgba(59, 130, 246, 0.2);
            cursor: pointer;
        }
        /* Table header bg */
        thead th {
            background-color: rgba(29, 78, 216, 0.9);
            color: white;
        }
    </style>
</head>
<body class="p-8 flex flex-col items-center">

    <h1 class="text-4xl font-extrabold mb-10 text-white">Manage Orders</h1>

    <div class="table-container bg-white bg-opacity-90 rounded-lg shadow-lg p-4">
        <table class="min-w-full rounded overflow-hidden">
            <thead>
                <tr>
                    <th class="py-3 px-6 border-b">Order ID</th>
                    <th class="py-3 px-6 border-b">Order Details</th>
                    <th class="py-3 px-6 border-b">Total Amount (₹)</th>
                    <th class="py-3 px-6 border-b">Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="text-center border-b text-gray-800">
                        <td class="py-3 px-6"><?php echo htmlspecialchars($row['id']); ?></td>
                        <td class="py-3 px-6"><?php echo htmlspecialchars($row['order_details']); ?></td>
                        <td class="py-3 px-6 font-semibold">₹<?php echo number_format($row['total_amount'], 2); ?></td>
                        <td class="py-3 px-6"><?php echo htmlspecialchars($row['created_at']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<?php
$conn->close();
?>
