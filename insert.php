<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "attendance_system"; // Replace with your actual database name

// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the data is received from ESP32
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $student_name = $_POST['student_name'];
    $in_time = $_POST['in_time'];
    $out_time = $_POST['out_time'];

    // Insert into database
    $sql = "INSERT INTO attendance (student_id, student_name, in_time, out_time)
            VALUES ('$student_id', '$student_name', '$in_time', '$out_time')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
