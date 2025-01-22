<?php
// Create a connection to the database
$con = new mysqli('localhost', 'root', '', 'hms');

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    echo "Connection successful";
}
?>
