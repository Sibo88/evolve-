
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

// Get the RFID card data from the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rfid_card = trim($_POST['rfid_card']);

    // Check if RFID card is already registered
    $stmt = $conn->prepare("SELECT * FROM login WHERE rfid_card = ?");
    
    if ($stmt) {
        $stmt->bind_param("s", $rfid_card);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // RFID card already exists, return failure response
            echo json_encode(['status' => 'fail']);
        } else {
            // RFID card is new, return success response
            echo json_encode(['status' => 'success']);
        }

        // Close statement
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Statement preparation failed.']);
    }
    
    // Close connection
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
