<?php
$host = "localhost"; // Your database host
$dbusername = "root"; // Your database username
$dbpassword = ""; // Your database password
$dbname = "project; // Your database name

// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
