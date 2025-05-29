<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            /* Tested reliable HTTPS image from Unsplash */
            background-image: url('images/pay.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            /* Fix to ensure it takes full height */
            height: 100vh;
        }
    </style>
</head>
<body class="flex items-center justify-center h-full text-white">
    <div class="bg-gray-900 bg-opacity-75 p-10 rounded-xl shadow-2xl text-center max-w-lg w-full">
        <h1 class="text-4xl font-bold mb-6">Scan to Pay</h1>
        <p class="mb-4 text-lg">Please scan the QR code to complete your payment.</p>
        <img src="images/payment.jpeg" alt="QR Code" class="mx-auto w-60 h-60 mb-6 rounded-lg shadow-lg">
        <form action="confirm_order.php" method="POST">
            <input type="hidden" name="order_summary" value="<?php echo htmlspecialchars($_SESSION['order_summary'] ?? '', ENT_QUOTES); ?>">
            <input type="hidden" name="total_amount" value="<?php echo htmlspecialchars($_SESSION['total_amount'] ?? 0, ENT_QUOTES); ?>">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-full text-lg">Confirm Order</button>
        </form>
    </div>
</body>
</html>
