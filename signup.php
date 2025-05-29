<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Signup successful! Please login.'); window.location='login.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1540189549336-e6e99c3679fe');
            background-size: cover;
            font-family: Arial;
            color: white;
        }
        .form-box {
            background-color: rgba(0,0,0,0.6);
            width: 300px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 10px;
        }
        input {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: none;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: orange;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Signup</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Signup">
        </form>
        <p>Already have an account? <a href="login.php" style="color:lightblue;">Login</a></p>
    </div>
</body>
</html>
