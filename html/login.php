<?php
// Database connection
$con = new mysqli('localhost', 'root', '', 'hms');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$alertMessage = ""; // Variable to store alert messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $con->real_escape_string($_POST['username']);
    $password = $con->real_escape_string($_POST['password']);

    // Admin credentials check
    if ($username === "admin" && $password === "admin") {
        // Redirect to Admin Dashboard
        header("Location: ../html/admin dashboard.html");
        exit;
    } else {
        // Query to check if username and password match in the doctor table
        $query = "SELECT * FROM doctor WHERE username = '$username' AND password = '$password'";
        $result = $con->query($query);

        if ($result->num_rows > 0) {
            // Success - Redirect to Doctor Dashboard
            header("Location: ../html/doctor dashboard.html");
            exit;
        } else {
            // Failure - Set the alert message to display on the same page
            $alertMessage = "Login failed! Please check your username and password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System - Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .alert {
            color: red;
            text-align: center;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <header>
        <a href="#" class="logo"><span>D</span>octors <span>C</span>ares</a>
        <nav class="navbar">
            <ul>
                <li><a href="../html/home page.html">Home</a></li>
                <li><a href="../html/home page.html">About</a></li>
                <li><a href="../html/home page.html">Contact</a></li>
                <li><a href="../html/home page.html">Login</a></li>
            </ul>
        </nav>
        <div class="fas fa-bars"></div>
    </header>
    <!-- Header navbar section end -->
    <!-- Login Section -->
    <div class="wrapper">
        <h1>LOGIN</h1>
        <!-- Display alert message if it exists -->
        <?php if ($alertMessage): ?>
            <div class="alert"><?php echo $alertMessage; ?></div>
        <?php endif; ?>
        <form id="loginForm" method="POST" action="">
            <div class="input-box">
                <input type="text" id="username" name="username" placeholder="Username" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="input-box">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class="fas fa-lock"></i>
            </div>
            <div class="remember-me">
                <label><input type="checkbox" name="remember"> Remember Me</label>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="../html/registration.html">Register</a></p>
            </div>
        </form>
    </div>
</body>

</html>
