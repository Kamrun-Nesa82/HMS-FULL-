<?php
include 'contact_con.php'; 

$id=$_GET['updateid'];
$sql="Select * from prescription where id=$pr_id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$doctor_name=$row['doctor_name'];
$patient_name=$row['patient_name'];
$patient_age=$row['patient_age'];
$disease=$row['disease'];
$medication=$row['medication'];
$Appointment_Date=$row['Appointment_Date'];
$Appointment_Time=$row['Appointment_Time'];

if (isset($_POST['submit'])) {
    $doctor_name= $_POST['doctor_name']; 
    $patient_name = $_POST['patient_name'];
    $patient_age = $_POST['patient_age'];
    $disease = $_POST['disease'];
    $medication = $_POST['medication'];
    $Appointment_Date = $_POST['Appointment_Date'];
    $Appointment_Time = $_POST['Appointment_Time'];

    $sql = "update prescription set id=$pr_id,doctor_name='$doctor_name', patient_name='$patient_name' , patient_age='$patient_age' , disease='$disease', medication='$medication', Appointment_Date='$Appointment_Date',Appointment_Time='$Appointment_Time',
    where id=$pr_id";
    $result = mysqli_query($con, $sql);
    
    if ($result) {
       //echo "updated successfully";
       header('location:doctor view_prescription');
    } else {
        die(mysqli_error($con));
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
</head>
<body>

<h2>Write Prescription</h2>

<form method="POST" action="update prescription.php">
    <label for="doctor_name">Doctor Name:</label>
    <input type="text" name="doctor_name" id="doctor_name" value="<?php echo $doctor_name; ?>" placeholder="Enter doctor Name" required>

    <label for="patient_name">Patient Name:</label>
    <input type="text" name="patient_name" id="patient_name" value="<?php echo $patient_name; ?>" placeholder="Enter patient name" required>

    <label for="patient_age">Patient Age:</label>
    <input type="number" name="patient_age" id="patient_age" value="<?php echo $patient_age; ?>" placeholder="Enter patient age" required>

    <label for="disease">Disease:</label>
    <input type="text" name="disease" id="disease" value="<?php echo $disease; ?>" placeholder="Enter disease" required>

    <label for="medication">Medication:</label>
    <input type="text" name="medication" id="medication" value="<?php echo $medication; ?>" placeholder="Enter Medication" required>

    <label for="Appointment_Date">Appointment Date:</label>
    <input type="date" name="Appointment_Date" id="Appointment_Date" value="<?php echo $Appointment_Date; ?>" required>

    <label for="Appointment_Time">Appointment Time:</label>
    <input type="time" name="Appointment_Time" id="Appointment_Time" value="<?php echo $Appointment_Time; ?>" required>

    <button type="submit" name="submit">Update Prescription</button>
</form>

</body>
</html>
