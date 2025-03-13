<?php
// Start the session and check if the user is logged in as a teacher
session_start();
if (!isset($_SESSION['teacher'])) {
    header("Location: login.php");
    exit();
}

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

// Fetch all students from the database
$sql = "SELECT fullname, id FROM register WHERE department = 'Student'";
$result = $conn->query($sql);

$teacher = $_SESSION['teacher']; // Retrieve the student data from session
$profile_image = $teacher['profile_img'] ?? 'sibo.jpg'; // Use a default image if not set
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($teacher['fullname']); ?>'s Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@100..700&family=DM+Serif+Text:ital@0;1&family=Tiro+Tamil:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style6.css"/>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-info-subtle sticky-top" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="rfid (1).png" alt="card" width="70" height="60">
              </a>
            <a class="logo navbar-brand py-4 fs-3" href="#">AttendEase </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-uppercase gap-4">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/evolve/index.html"> 🏠︎ Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/evolve/attendance.html"> 🔴  Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/evolve/register.html">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/evolve/category.html">Login</a>
                    </li>
                
                    
                    <li class="nav-item">
                        <a class="nav-link active" href="/evolve/contact.html">Contact Us</a>
                    </li>
                   
                   
                </ul>
            </div>
        </div>
    </nav> 

    <section>

   
            <div class="heading col-md-12">
                <h2 class="pb-4 fb-3">12 B physics class</h2>

            </div>

           
                   

            <div class="teacher col-md-12">
        
        
                <div class="card col-md-3">
            
        
                  <img src="uploads/<?php echo htmlspecialchars($profile_image); ?>" alt="Profile Picture" style="width: 80%; height: auto;">
                </div>  

                    
            

            </div>




</div>
            

       
    </section>

    <section id="records" class="summary">
        <div class="container">
            <h2 class="sum pb-4 fs-3">Students List</h2>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Student ID</th>
                                <th scope="col">Student Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                // Output data for each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["fullname"]. "</td></tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2'>No students found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

   
   
    
    <footer>
        <div class="footer-container">
          <div class="footer-content">
            <div class="footer-section about">
              <h3>About Us</h3>
              <p>
                "Empowering solutions, connecting possibilities. "
              </p>
            </div>
      
           
      
            <div class="footer-section social">
              <h3>Follow Us</h3>
              <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f">ⓕ</i></a>
                <a href="#"><i class="fab fa-twitter"> 𝕏 </i></a>
                <a href="#"><i class="fab fa-instagram">
                    ✆
                   </i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
              </div>
            </div>
          </div>
      
          <div class="footer-bottom">
            <p>&copy; 2024 AttendEase. All rights reserved.</p>
          </div>
        </div>
      </footer>


   

    <script>
        // Get category from localStorage and set it in the hidden input
        document.getElementById('categoryField').value = localStorage.getItem('category');
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
