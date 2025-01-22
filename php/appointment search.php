<?php
include 'contact_con.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Doctors</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="my-4 text-center">Search Results for Doctors</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sl no</th>
                <th>Patient Name</th>
                <th>Age</th>
                <th>Doctor</th>
                <th>Specialization</th>
                <th>Consultancy Fees</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['query'])) {
                $search = mysqli_real_escape_string($con, $_POST['query']);
                $sql = "SELECT * FROM `book_appointment` WHERE Patient_Name LIKE '%$search%'";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $p_id = $row['p_id'];
                        $Patient_Name = htmlspecialchars($row['Patient_Name']);
                        $Age = htmlspecialchars($row['Age']);
                        $Doctor = htmlspecialchars($row['Doctor']);
                        $Specialization = htmlspecialchars($row['Specialization']);
                        $Consultancy_Fees = htmlspecialchars($row['Consultancy_Fees']);
                        $Appointment_Date = htmlspecialchars($row['Appointment_Date']);
                        $Appointment_Time = htmlspecialchars($row['Appointment_Time']);
                        echo "<tr>
                            <th scope='row'>{$p_id}</th>
                            <td>{$Patient_Name}</td>
                            <td>{$Age}</td>
                            <td>{$Doctor}</td>
                            <td>{$Specialization}</td>
                            <td>{$Consultancy_Fees}</td>
                            <td>{$Appointment_Date}</td>
                            <td>{$Appointment_Time}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No Record Found</td></tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Please enter a search query</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="text-center mt-4">
        <a href="admin view_appointment.php" class="btn btn-primary">Back to Dashboard</a>
    </div>
</div>
</body>
</html>
