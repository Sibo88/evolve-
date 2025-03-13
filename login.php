<?php
// Database connection details
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
    
    // Get the submitted username, password, and category
    $fullname = $_POST['uname'];
    $password = $_POST['password'];


    // SQL query to select user from the database based on username and category
    $sql = "SELECT * FROM register WHERE fullname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fullname);
    $stmt->execute();
    $result = $stmt->get_result();

     // Check if the user exists
     if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the result as an associative array
        $hashed_password = $row['password'];
        $category = $row['department'];
      
        //password_verify($password, $hashed_password)
        // Verify the password
        if ($password==$row['password']) {
            if ($category === 'Teacher') {
                session_start();
                $_SESSION['teacher'] = $row;  // Store teacher info in session
                header("Location: teacher.php");
                exit();
               
            } elseif ($category === 'Student') {
                 session_start();
                    
                $_SESSION['student'] = $row;
                header("Location: student.php");
            } else {
                echo "Unknown category."; // Optional: Handle unexpected categories
            }
            exit();
        } else {
            echo "Invalid password."; // Incorrect password
        }
    } else {
        echo "No user found with that username."; // User does not exist
    }


    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
