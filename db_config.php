<?php
$servername = "localhost";
$username = "root"; // use your DB username
$password = "";     // use your DB password
$dbname = "restaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
