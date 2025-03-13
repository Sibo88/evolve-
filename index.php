<!DOCTYPE html>
<html>
<head>
    <title>Student Attendance</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@100..700&family=DM+Serif+Text:ital@0;1&family=Tiro+Tamil:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css"/>
</head>
<body>
    <?php include 'db_connection.php'; ?> <!-- Include your database connection -->

    <nav class="navbar navbar-expand-lg bg-body-tertiary border-info-subtle sticky-top" data-bs-theme="dark">
        <div class="container">
            <a class="logo navbar-brand py-4 fs-3" href="#">அகரன் 📖</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-uppercase gap-4">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#Home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#about-us">STUDENTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/login.html">ATTENDANCE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#contact">about-us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/register.html">register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/category.html">login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section id="Home" class="ban text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-uppercase text-white">
                    <div class="w-75 m-auto"></div>
                    <p class="pb-4 fs-1">"</p>
                    <p class="dis pb-3 fs-3">Do it again and again. Consistency makes the rain drops to create holes in the rock. Whatever is difficult can be done easily with regular attendance, attention, and action.</p>
                    <p class="pb-4 fs-1">"</p>
                    <h4 class="oth pb-3 fs-4">Israelmore Ayivor, The Great Hand Book of Quotes</h4>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
