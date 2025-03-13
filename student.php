<?php
session_start(); // Start or resume the session


// Debug: Check if session data is set
if (!isset($_SESSION['student'])) {
    echo "No student data in session.";
    exit(); // Stop further execution
}

$student = $_SESSION['student']; // Retrieve the student data from session
$profile_image = $student['profile_img'] ?? 'sibo.jpg'; // Use a default image if not set
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($student['fullname']); ?>'s Profile</title>
    <link rel="stylesheet" href="style7.css">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <a class="nav-link active" href="/evolve/attendance.html">🔴   Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/evolve/register.html">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/evolve/login.html">Login</a>
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

        <div class="student col-md-12">
        
        
                <div class="card col-md-3">
                    
                
                    <img src="uploads/<?php echo htmlspecialchars($profile_image); ?>" alt="Profile Picture" style="width: 100%; height: auto;">
    
                            
                    
    
                    </div>

        


        </div>
        

   
    </section>
    <section>
        <div class="heading col-md-12">
            <h2 class="pb-4 fb-3">Student Details</h2>
        </div>

        <div class="student col-md-12">
            <div class="card col-md-6">
                <div class="card-body">
                <h5 class="card-title">Name: <?php echo htmlspecialchars($student['fullname'] ?? 'N/A'); ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Student ID: <?php echo htmlspecialchars($student['id'] ?? 'N/A'); ?></h6>
                <p class="card-text">Email: <?php echo htmlspecialchars($student['email'] ?? 'N/A'); ?></p>
                <p class="card-text">Address: <?php echo htmlspecialchars(($student['address'] ?? '') . ', ' . ($student['address2'] ?? '')); ?></p>
                <p class="card-text">Faculty: <?php echo htmlspecialchars($student['faculty'] ?? 'N/A'); ?></p>
                <p class="card-text">Department: <?php echo htmlspecialchars($student['department'] ?? 'N/A'); ?></p>
                <p class="card-text">Year: <?php echo htmlspecialchars($student['year'] ?? 'N/A'); ?></p>
                

                </div>
            </div>
        </div>
    </section>


    <section >
        <div class="calender col-md-12">
            <div id="calendar"></div>
            <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
            <script src="/student.js"></script>
           
        
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
   
  
    
</body>
</html>
