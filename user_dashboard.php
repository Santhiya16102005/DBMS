<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>User Dashboard</title>
<style>
  body, html {
    height: 100%;
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1470&q=80') no-repeat center center fixed;
    background-size: cover;
    color: #222;
  }
  .overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: rgba(255,255,255,0.7);
    z-index: 1;
  }
  .content {
    position: relative;
    z-index: 2;
    max-width: 400px;
    margin: 100px auto;
    background: rgba(255,255,255,0.9);
    padding: 40px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
  }
  h1 {
    margin-bottom: 20px;
    font-size: 2.8rem;
  }
  p {
    font-size: 1.25rem;
    margin-bottom: 35px;
  }
  .button-panel {
    display: flex;
    flex-direction: column;  /* vertical stack */
    gap: 20px;
    align-items: center;
  }
  .btn {
    background-color: #007acc;
    color: white;
    padding: 14px 28px;
    text-decoration: none;
    font-weight: bold;
    border-radius: 8px;
    transition: background-color 0.3s ease;
    width: 100%;   /* full width inside container */
    max-width: 280px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
  }
  .btn:hover {
    background-color: #005f99;
  }
  .logout-btn {
    background-color: #d32f2f;
  }
  .logout-btn:hover {
    background-color: #b71c1c;
  }
</style>
</head>
<body>

<div class="overlay"></div>

<div class="content">
  <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
  <p>Explore our delicious menu and manage your orders.</p>

  <div class="button-panel">
    <a href="menu.html" class="btn">View Menu</a>
    <a href="orders.php" class="btn">My Orders</a>
    <a href="logout.php" class="btn logout-btn">Logout</a>
  </div>
</div>

</body>
</html>
