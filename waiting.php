<?php
session_start();
// Debugging: Check session data
if (!isset($_SESSION['student_data'])) {
    echo "<script>alert('No student data found in session!');</script>";
    // Optionally redirect to a page where user can input their data
    header("Location: register.html");
    exit();
} else {
    // Debug output to see what's in the session
    echo '<pre>';
    print_r($_SESSION['student_data']);
    echo '</pre>';
}

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "project";

// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if RFID card is scanned (this is just a placeholder, implement your RFID logic)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rfid_card = trim($_POST['rfid_card']); // Assuming RFID card input from form or scanner

    // Check if RFID card is already registered
    $stmt = $conn->prepare("SELECT * FROM login WHERE rfid_card = ?");
    $stmt->bind_param("s", $rfid_card);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // RFID card already registered
        echo "<script>alert('RFID card is already registered. Registration denied.');</script>";
        header("Location: register.html");
        exit();
    } else {
        // RFID card not registered, proceed with registration
        if (isset($_SESSION['student_data'])) {
            $student_data = $_SESSION['student_data'];

            // Hash the password for security
            $hashed_password = password_hash($student_data['password'], PASSWORD_DEFAULT);

            // Insert student details with RFID card into the database
            $stmt = $conn->prepare("INSERT INTO login (fullname, id, email, password, address, address2, faculty, department, year, rfid_card) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param(
                "ssssssssss", 
                $student_data['fullname'], 
                $student_data['id'], 
                $student_data['email'], 
                $hashed_password, 
                $student_data['address'], 
                $student_data['address2'], 
                $student_data['faculty'], 
                $student_data['department'], 
                $student_data['year'], 
                $rfid_card
            );

            if ($stmt->execute()) {
                echo "<script>alert('Registration successful!');</script>";
                header("Location: /evolve/index.html");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "No student data found!";
            header("Location: register.html"); // Redirect to registration if no session data
            exit();
        }
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>waiting Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style8.css"/>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-info-subtle sticky-top" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="rfid (1).png" alt="card" width="70" height="60">
            </a>
            <a class="logo navbar-brand py-4 fs-3" href="#">AttendEase</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-uppercase gap-4">
                    <li class="nav-item"><a class="nav-link active" href="/evolve/index.html"> 🏠︎ Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/evolve/attendance.html">🔴 Attendance</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/evolve/register.html">Register</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/evolve/login.html">Login</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#contact">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section>
        <div class="card-reader">
            <h2>Scan Your RFID Card Below</h2>
            <p>Place your RFID card on the scanner to mark your attendance.</p>
            
           
        </div>
    </section>
    <section>
        <div class="wbody col-md-12">
            <div class="status-container">
                <!-- Loader Icon (hidden initially) -->
                <div id="loader" class="loader"></div>

                <!-- Message (waiting for card or result message) -->
                <div id="message" class="message">Waiting for RFID card. Please scan...</div>

                <!-- Result Icon (hidden initially, shows success/fail) -->
                <div id="result-icon" class="icon" style="display: none;"></div>
            </div>
        </div>
    </section>


   

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="wait.js"></script>
</body>
</html>




