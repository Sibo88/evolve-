<?php
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "project";        

// Set correct timezone
date_default_timezone_set('Asia/Colombo');  // Set to your timezone, e.g., 'Asia/Kolkata'

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get today's attendance records
$sql = "SELECT r.id, r.fullname, i.in_time, i.out_time, i.attendance_status 
        FROM register r
        JOIN input i ON r.id = i.Student_id
        WHERE DATE(i.in_time) = CURDATE()";


$result = $conn->query($sql);

$attendanceRecords = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $attendanceRecords[] = $row;
    }
}



echo json_encode($attendanceRecords);

$conn->close();
?>
