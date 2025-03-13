<?php
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "project";        

// Set correct timezone
date_default_timezone_set('Asia/Colombo');

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Check if 'rfid_card' is provided in the POST request
    if (isset($_POST['rfid']) && !empty($_POST['rfid'])) {
        
        $rfidCardNumber = $conn->real_escape_string($_POST['rfid']); // Sanitize input

        // Fetch student based on RFID card number
        $studentQuery = "SELECT * FROM register WHERE rfid_card = '$rfidCardNumber'";
        $studentResult = $conn->query($studentQuery);

        // Check if RFID card is found
        if ($studentResult && $studentResult->num_rows > 0) {
            $student = $studentResult->fetch_assoc();
            $studentId = $student['id'];

            // Check if the student already has an attendance record for today
            $attendanceQuery = "SELECT * FROM input WHERE student_id = '$studentId' AND DATE(in_time) = CURDATE()";
            $attendanceResult = $conn->query($attendanceQuery);

            if ($attendanceResult->num_rows == 0) {
                // No record found, insert in-time
                $inTime = date('Y-m-d H:i:s');
                $insertQuery = "INSERT INTO input (student_id, in_time) VALUES ('$studentId', '$inTime')";
                
                if ($conn->query($insertQuery) === TRUE) {
                    echo json_encode([
                         "in"
                       
                    ]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Error inserting in-time: " . $conn->error]);
                }
            } else {
                // If an attendance record exists, update out-time
                $attendanceRecord = $attendanceResult->fetch_assoc();
                
                // Check if out-time is already set
                if (!empty($attendanceRecord['out_time'])) {
                    $outTime = date('Y-m-d H:i:s');
                    $inTime = $attendanceRecord['in_time'];
                    $timeDifference = (strtotime($outTime) - strtotime($inTime)) / 1; // Time difference in hours

                    // Determine attendance status based on time difference
                    $attendanceStatus = $timeDifference >= 1 ? 'Present' : 'Absent';
                    $updateQuery = "UPDATE input SET out_time='$outTime', attendance_status='$attendanceStatus' WHERE Student_id='" . $attendanceRecord['Student_id'] . "'";

                    if ($conn->query($updateQuery) === TRUE) {
                        echo json_encode([
                            "out",
                            
                        ]);
                    } else {
                        echo json_encode(["message" => "Error updating out-time: " . $conn->error]);
                    }
                } else {
                    // If out-time is already set, they have already checked out
                    echo json_encode([ "message" => "Already checked out"]);
                }
            }
        } else {
            echo json_encode([$rfidCardNumber]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "No RFID card provided"]);
    }
}

$conn->close();
?>
