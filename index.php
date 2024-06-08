<?php
$serverName = "localhost";
$username = "root";
$password = "";
$dbname = "bishop";

// Create connection
$conn = new mysqli($serverName, $username, $password, $dbname);

// Check connection
if ($conn->connect_errno) {
  echo "Failed to connect to MySQL: " . $conn->connect_error;
  exit;
}

echo "Connected successfully";

// Perform database operations here

$conn->close();
?>