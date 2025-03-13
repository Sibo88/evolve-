<?php

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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and validate
    $fullname = trim($_POST['fullname']);
    $id = trim($_POST['id']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $address = trim($_POST['address']);
    $address2 = trim($_POST['address2']);
    $faculty = trim($_POST['faculty']);
    $department = trim($_POST['department']);
    $year = trim($_POST['year']);
    $rfid = $_POST['rfid_card'];

    // Check if all required fields are filled
    if (empty($fullname) || empty($id) || empty($email) || empty($password) || empty($address) || empty($faculty) || empty($department) || empty($year) || empty($rfid)) {
        echo "Please fill in all required fields.";
        exit();
    }

   

   // Handle file upload
   if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] == 0) {
    $targetDir = "uploads/"; // Make sure this directory exists and is writable
    $fileName = basename($_FILES['profile_img']['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow only certain file formats
        $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowedTypes)) {
            // Move the file to the uploads directory
            if (move_uploaded_file($_FILES['profile_img']['tmp_name'], $targetFilePath)) {
                // Prepare an SQL statement to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO register (fullname, id, email, password, address, address2, faculty, department, year, rfid_card, profile_img) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                
                // Bind parameters
                $stmt->bind_param("sssssssssss", $fullname, $id, $email, $password, $address, $address2, $faculty, $department, $year, $rfid, $fileName);

                // Execute the query
                if ($stmt->execute()) {
                    header("Location: /evolve/index.html?status=success");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
            } else {
                echo "Error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
     } else {
        echo "Error uploading file.";
   }
    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
