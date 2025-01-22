<?php
include 'contact_con.php'; // Include the database connection file

// Initialize variables
$success_message = "";
$is_success = false;

if (isset($_POST['submit'])) {
    $Patient_Name = $_POST['Patient_Name'];
    $Age = $_POST['Age'];
    $Doctor = $_POST['Doctor'];
    $Specialization = $_POST['Specialization'];
    $Consultancy_Fees = $_POST['Consultancy_Fees'];
    $Appointment_Date = $_POST['Appointment_Date'];
    $Appointment_Time = $_POST['Appointment_Time'];

    // Correct SQL query
    $sql = "INSERT INTO `book appointment` (Patient_Name, Age, Doctor, Specialization, Consultancy_Fees, Appointment_Date, Appointment_Time) 
            VALUES ('$Patient_Name', '$Age', '$Doctor', '$Specialization', '$Consultancy_Fees', '$Appointment_Date', '$Appointment_Time')";
    
    // Execute the query
    if (mysqli_query($con, $sql)) {
        $success_message = "Appointment booked successfully!";
        $is_success = true;
    } else {
        $success_message = "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Appointment</title>
    <link rel="stylesheet" href="../css/book app.css"> <!-- Link to external CSS -->
    <script>
        // Success alert
        const isSuccess = <?php echo json_encode($is_success); ?>;
        const successMessage = <?php echo json_encode($success_message); ?>;

        if (isSuccess) {
            alert(successMessage);
        }
    </script>
</head>
<body>

<h2>Add Appointment</h2>

<form method="POST" action="book appointment.php">
    <label for="Patient_Name">Patient Name:</label>
    <input type="text" name="Patient_Name" id="Patient_Name" placeholder="Enter Patient Name" required>
    <label for="Age">Age:</label>
    <input type="number" name="Age" id="Age" placeholder="Enter Age" required>

    <label for="Doctor">Doctor:</label>
    <input type="text" name="Doctor" id="Doctor" placeholder="Enter Doctor Name" required>

    <label for="Specialization">Specialization:</label>
    <input type="text" name="Specialization" id="Specialization" placeholder="Enter Specialization" required>

    <label for="Consultancy_Fees">Consultancy Fees:</label>
    <input type="number" name="Consultancy_Fees" id="Consultancy_Fees" placeholder="Enter Consultancy Fees" required>

    <label for="Appointment_Date">Appointment Date:</label>
    <input type="date" name="Appointment_Date" id="Appointment_Date" required>

    <label for="Appointment_Time">Appointment Time:</label>
    <input type="time" name="Appointment_Time" id="Appointment_Time" required>

    <button type="submit" name="submit">Add Appointment</button>
</form>

</body>
</html>


