

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Dashboard</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: 'Poppins', sans-serif;
        background: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1470&q=80') no-repeat center center fixed;
        background-size: cover;
        position: relative;
    }

    body::before {
        content: "";
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 0;
    }

    .dashboard-container {
        position: relative;
        z-index: 1;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        padding: 50px 40px;
        border-radius: 20px;
        max-width: 400px;
        margin: 100px auto;
        box-shadow: 0 8px 32px rgba(0,0,0,0.4);
        text-align: center;
        color: #fff;
    }

    .dashboard-container h1 {
        font-size: 2.5rem;
        margin-bottom: 40px;
    }

    .button {
        display: block;
        width: 100%;
        margin: 15px 0;
        padding: 15px;
        font-size: 1.1rem;
        font-weight: 600;
        color: #fff;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        border-radius: 30px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .button:hover {
        background: linear-gradient(135deg, #764ba2, #667eea);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.4);
    }
</style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Admin Dashboard</h1>
        <a href="view_users.php" class="button">View Users</a>
        <a href="manage_orders.php" class="button">View Orders</a>
        <a href="logout.php" class="button">Logout</a>
    </div>
</body>
</html>
