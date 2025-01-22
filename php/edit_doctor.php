<?php
include 'contact_con.php'; 
$id=$_GET['updateid'];
$sql="Select * from doctor where id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['name'];
$username=$row['username'];
$specialization = $row['specialization'];
$email = $row['email'];
$password = $row['password'];
$consultancyfees = $row['consultancyfees'];


if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $username = $_POST['username'];
  $specialization = $_POST['specialization'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $consultancyfees = $_POST['consultancyfees'];

  $sql = "update doctor set name='$name',username='$username',specialization='$specialization', email='$email', password='$password',consultancyfees='$consultancyfees'
  where id=$id";
  $result = mysqli_query($con, $sql);
  
  if ($result) {
     //echo "updated successfully";
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
    <title>Update Doctor Information</title>
  </head>
  <body>
    <div class="container my-5">
      <form method="post">

      <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" placeholder="Enter Doctor Name" name="name" autocomplete="off"
          value="<?php echo $name;?>">
        </div>
        <br>
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" placeholder="Enter Username" name="username" autocomplete="off"
          value="<?php echo $username;?>">
        </div>
        <br>
        <div class="form-group">
          <label>Specialization</label>
          <input type="text" class="form-control" placeholder="Enter Specialization" name="specialization" autocomplete="off"
          value="<?php echo $specialization;?>">
        </div>
        <br>
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" placeholder="Enter Email" name="email" autocomplete="off"
          value="<?php echo $email;?>">
        </div>
        <br>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" placeholder="Enter password" name="password" autocomplete="off"
          value="<?php echo $password;?>">
        </div>
        <br>
        <div class="form-group">
          <label>Consultancy Fees</label>
          <input type="number" class="form-control" placeholder="Enter Consultancy Fees" name="consultancyfees" autocomplete="off"
          value="<?php echo $consultancyfees;?>">
        </div>  
        <br>
        <button type="submit" class="btn btn-primary" name="submit">Update</button>
      </form>
    </div>
  </body>
</html>


