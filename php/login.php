<?php
// Start session
session_start();

// Database connection
$con = new mysqli('localhost', 'root', '', 'hms');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$alertMessage = ""; // Variable to store alert messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $con->real_escape_string($_POST['username']);
    $password = $con->real_escape_string($_POST['password']);

    // Check if it's admin login
    if ($username === 'admin' && $password === 'admin') {
        // Redirect to Admin Dashboard
        $_SESSION['admin_username'] = $username; // Store the admin username in the session
        header("Location:../html/admin dashboard.html");
        exit;
    } else {
        // Query to check if the username exists in the `register patient` table
        $query = "SELECT * FROM `register patient` WHERE username = '$username'";
        $result = $con->query($query);

        if ($result && $result->num_rows > 0) {
            // Username exists, now check if the password matches
            $row = $result->fetch_assoc();
            if ($row['password'] == $password) {
                // Success - Redirect to Patient Dashboard
                $_SESSION['patient_username'] = $username; // Store the username in session
                header("Location: patient dashboard.php");
                exit;
            } else {
                // Incorrect password
                $alertMessage = "Incorrect password! Please try again.";
            }
        } else {
            // Username doesn't exist - Show the register message
            $alertMessage = "Username not found! Please register first.";
            echo "<script>alert('Username not found! Please register first.'); window.location.href='registration.php';</script>";
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
                <li><a href="login.php">Login</a></li>
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
                <p>Don't have an account? <a href="registration.php">Register</a></p>
            </div>
        </form>
    </div>
</body>

</html>
