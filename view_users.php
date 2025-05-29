<?php
// Connect to DB
$conn = new mysqli("localhost", "root", "", "restaurant");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users
$sql = "SELECT id, name, email, role FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>View Users</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <style>
    body {
      background: 
        linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
        url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1470&q=80') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #f3f4f6; /* light text */
    }
    .table-container {
      max-width: 90vw;
      margin: auto;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 0.5rem;
      box-shadow: 0 10px 15px rgba(0,0,0,0.3);
      overflow-x: auto;
      padding: 1.5rem;
    }
    thead th {
      background-color: #2563eb; /* Tailwind blue-600 */
      color: white;
      padding: 0.75rem 1rem;
    }
    tbody tr:hover {
      background-color: #bfdbfe; /* Tailwind blue-200 */
      cursor: pointer;
    }
  </style>
</head>
<body class="p-6 flex flex-col items-center">

  <h1 class="text-4xl font-extrabold mb-8 text-white" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">Users List</h1>

  <div class="table-container">
    <table class="min-w-full rounded">
      <thead>
        <tr>
          <th class="border-b border-gray-300 text-left">ID</th>
          <th class="border-b border-gray-300 text-left">Name</th>
          <th class="border-b border-gray-300 text-left">Email</th>
          <th class="border-b border-gray-300 text-left">Role</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
          <?php while ($user = $result->fetch_assoc()): ?>
            <tr class="border-b border-gray-300 text-gray-900">
              <td class="py-2 px-4"><?php echo htmlspecialchars($user['id']); ?></td>
              <td class="py-2 px-4"><?php echo htmlspecialchars($user['name']); ?></td>
              <td class="py-2 px-4"><?php echo htmlspecialchars($user['email']); ?></td>
              <td class="py-2 px-4 capitalize"><?php echo htmlspecialchars($user['role']); ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="4" class="text-center py-4 text-gray-700">No users found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</body>
</html>

<?php
$conn->close();
?>
