<?php
// Database connection details
$servername = "localhost";  // Adjust as per your setup
$username = "root";         // Adjust as per your setup
$password = "";             // Adjust as per your setup
$dbname = "hms";            // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the success message variable
$successMessage = "";

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password =$_POST['password'];
    $contact = $_POST['contact'];

    // Check if the email already exists
    $emailCheckQuery = "SELECT * FROM `registration` WHERE email = ?";
    $stmt = $conn->prepare($emailCheckQuery);
    $stmt->bind_param("s", $email);  // Bind the email parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists, show an error message
        echo "<script>alert('This email is already registered. Please use a different email.');</script>";
    } else {
        // Email does not exist, proceed with registration
        $insertQuery = "INSERT INTO `registration` (`username`, `email`, `password`, `contact`) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssss", $username, $email, $password, $contact);  // Bind parameters
        if ($stmt->execute()) {
            // Set the success message
            $successMessage = "Registration successful! You can now log in.";
        } else {
            // Handle error if insertion fails
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
    }

    // Close the statement
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System - registration</title>
    <link rel="stylesheet" href="../css/registration.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black with opacity */
            padding-top: 60px;
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
            border-radius: 8px;
        }

        /* Close Button */
        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 25px;
            color: black;
        }

        .close:hover,
        .close:focus {
            color: red;
            text-decoration: none;
            cursor: pointer;
        }

        /* Button Styles */
        .modal button {
            background-color: #0188df;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .modal button:hover {
            background-color: #005fa3;
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
                <li><a href="../php/login.php">Login</a></li>
            </ul>
        </nav>
        <div class="fas fa-bars"></div>
    </header>
    <!-- Header navbar section end -->

    <!-- Registration Form -->
    <div class="registration">
        <h1>Registration</h1>
        <form method="POST" id="registrationForm" onsubmit="return validatePassword()">
            <div class="inputbox">
                <input type="text" id="username" name="username" placeholder="User Name" required>
            </div><br>
            <div class="inputbox">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div><br>
            <div class="inputbox">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div><br>
            <div class="input-box">
                <input type="text" id="contact" name="contact" class="input-field" placeholder="Enter your contact number" required>
            </div><br>
            <button type="submit" name="submit">Registration</button><br><br>
            <div style="color:black;font-size: 15px;">Already a member?<a href="../php/login.php"><p style="color:blue">Login Here</p></a></div>
        </form>

        <!-- Popup Modal -->
        <?php
        if (!empty($successMessage)) {
            echo "
                <div id='successModal' class='modal'>
                    <div class='modal-content'>
                        <span class='close'>&times;</span>
                        <p>$successMessage</p>
                        <button onclick='window.location.href=\"../html/login.html\"'>Go to Login</button>
                    </div>
                </div>
            ";
        }
        ?>
    </div>

    <!-- JavaScript to open the modal and close it -->
    <script>
        // Get the modal
        var modal = document.getElementById("successModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // If the registration is successful, show the modal
        <?php if (!empty($successMessage)): ?>
            modal.style.display = "block";
        <?php endif; ?>

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Validate the password before submitting the form
        function validatePassword() {
            var password = document.getElementById("password").value;
            var passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;

            // Check if password matches the pattern
            if (!passwordPattern.test(password)) {
                alert("Password must be at least 8 characters, and include at least one letter, one number, and one special character.");
                return false;
            }
            return true;
        }
    </script>

</body>
</html>
