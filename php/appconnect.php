<?php
$con = mysqli_connect("localhost", "root", "", "hms"); // Replace with your database name

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
