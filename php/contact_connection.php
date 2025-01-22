<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    $connection = mysqli_connect('localhost','root','','hms');

if(!$connection){
    
    die("Not Connected".mysqli_error($connection));
}
  $query = "INSERT INTO contact(fullname,email,message) VALUES ('$fullname', '$email','$message')";
  $result = mysqli_query($connection,$query);
}
?>
 