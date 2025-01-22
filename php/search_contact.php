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
    <h2 class="my-4 text-center">Search Results for Contacts</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sl no</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Message</th>
               
            </tr>
        </thead>
        <tbody>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['query'])) {
                $search = mysqli_real_escape_string($con, $_POST['query']);
                $sql = "SELECT * FROM contact WHERE fullname LIKE '%$search%'";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $fullname = htmlspecialchars($row['fullname']);
    
                        $email = htmlspecialchars($row['email']);
                        $message = htmlspecialchars($row['message']);
                        echo "<tr>
                            <th scope='row'>{$id}</th>
                            <td>{$fullname}</td>
                    
                            <td>{$email}</td>
                            <td>{$message}</td>
                            
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No Record Found</td></tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Please enter a search query</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="text-center mt-4">
        <a href="contact_dash.php" class="btn btn-primary">Back to Dashboard</a>
    </div>
</div>
</body>
</html>
