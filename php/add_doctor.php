<?php
include 'contact_con.php'; // Ensure the correct file name

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $specialization = $_POST['specialization'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $consultancyfees = $_POST['consultancyfees'];
   

    $sql = "INSERT INTO doctor (name,username,specialization, email,password, consultancyfees) VALUES ( '$name','$username', '$specialization','$email', '$password','$consultancyfees')";
    $result = mysqli_query($con, $sql);
    
    if ($result) {
       // echo "Data inserted successfully";
       header('location:doctor_dash.php');
    } else {
        die(mysqli_error($con));
    }
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <title>Add Doctor</title>
  </head>
  <body>
    <div class="container my-5">
      <form method="post">
      <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" placeholder="Enter Doctoe Name" name="name" autocomplete="off">
        </div>
        <br>
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" placeholder="Enter Username" name="username" autocomplete="off">
        </div>
        <br>
        <div class="form-group">
          <label>Specialization</label>
          <input type="text" class="form-control" placeholder="Enter Specialization" name="specialization" autocomplete="off">
        </div>
        <br>

        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" placeholder="Enter Email" name="email" autocomplete="off">
        </div>
        <br>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" placeholder="Enter Password" name="password" autocomplete="off">
        </div>
        <br>
        <div class="form-group">
          <label>Consultancy Fees</label>
          <input type="number" class="form-control" placeholder="Enter Consultancy Fees" name="consultancyfees" autocomplete="off">
        </div>
        <br>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>
    </div>
  </body>
</html>
