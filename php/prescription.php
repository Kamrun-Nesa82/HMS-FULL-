<?php
include 'contact_con.php'; // Include the database connection file

// Initialize variables
$success_message = "";
$is_success = false;

if (isset($_POST['submit'])) {
    $doctor_name = $_POST['doctor_name'];
    $patient_name = $_POST['patient_name'];
    $patient_age = $_POST['patient_age']; 
    $disease = $_POST['disease'];
    $medication = $_POST['medication'];
    $Appointment_Date = $_POST['Appointment_Date'];
    $Appointment_Time = $_POST['Appointment_Time'];

    // Correct SQL query to insert prescription data
    $sql = "INSERT INTO prescription(doctor_name ,patient_name , patient_age , disease ,medication , Appointment_Date ,Appointment_Time  ) 
            VALUES ('$doctor_name', '$patient_name', '$patient_age', '$disease', '$medication', '$Appointment_Date', '$Appointment_Time')";
    
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
    <title>Prescription</title>
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

<h2>Write Prescription</h2>

<form method="POST" action="prescription.php">
    <label for="doctor_name">Doctor Name:</label>
    <input type="text" name="doctor_name" id="doctor_name" value="<?php echo isset($_GET['doctor_name']) ? $_GET['doctor_name'] : ''; ?>" placeholder="Enter doctor Name" required>

    <label for="patient_name">Patient Name:</label>
    <input type="text" name="patient_name" id="patient_name" placeholder="Enter patient name" required>

    <label for="patient_age">Patient Age:</label>
    <input type="number" name="patient_age" id="patient_age" placeholder="Enter patient age" required>

    <label for="disease">Disease:</label>
    <input type="text" name="disease" id="disease" placeholder="Enter disease" required>

    <label for="Medication">Medication:</label>
    <input type="text" name="medication" id="medication" placeholder="Enter Medication" required>

    <label for="Appointment_Date">Appointment Date:</label>
    <input type="date" name="Appointment_Date" id="Appointment_Date" required>

    <label for="Appointment_Time">Appointment Time:</label>
    <input type="time" name="Appointment_Time" id="Appointment_Time" required>

    <button type="submit" name="submit">Add Prescription</button>
</form>

</body>
</html>