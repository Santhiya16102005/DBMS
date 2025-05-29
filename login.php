<?php
session_start();
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
        exit();
    } else {
        $error = "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login - Restaurant</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap');

  * {
    box-sizing: border-box;
  }

  body, html {
    height: 100%;
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: url('https://cdn.pixabay.com/photo/2017/05/07/08/56/food-2291908_1280.jpg') no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .login-container {
    background: rgba(0, 0, 0, 0.7);
    padding: 40px 50px;
    border-radius: 12px;
    width: 350px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.5);
    color: #fff;
  }

  .login-container h2 {
    margin-bottom: 25px;
    font-weight: 600;
    text-align: center;
    letter-spacing: 1.2px;
  }

  input[type="email"], input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    margin: 12px 0 20px;
    border-radius: 6px;
    border: none;
    outline: none;
    font-size: 16px;
  }

  input[type="submit"] {
    width: 100%;
    padding: 12px;
    background: #ff6f00;
    border: none;
    border-radius: 6px;
    color: white;
    font-size: 18px;
    cursor: pointer;
    transition: background 0.3s ease;
  }

  input[type="submit"]:hover {
    background: #ff8f00;
  }

  .error {
    background: #ff4c4c;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px;
    text-align: center;
    font-weight: 600;
  }

  .signup-link {
    margin-top: 15px;
    text-align: center;
    font-size: 14px;
  }

  .signup-link a {
    color: #ffb74d;
    text-decoration: none;
  }

  .signup-link a:hover {
    text-decoration: underline;
  }
</style>
</head>
<body>

<div class="login-container">
  <h2>Login to Restaurant</h2>
  <?php if (!empty($error)) { echo '<div class="error">'.htmlspecialchars($error).'</div>'; } ?>
  <form method="POST" action="">
    <input type="email" name="email" placeholder="Email Address" required />
    <input type="password" name="password" placeholder="Password" required />
    <input type="submit" value="Login" />
  </form>
  <div class="signup-link">
    Don't have an account? <a href="signup.php">Sign Up</a>
  </div>
</div>

</body>
</html>
