<?php
include 'contact_con.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../images/fav_icon.jpg">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../css/admin dashboard.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    #sidebar .nav-link span {
      display: inline-block;
    }
    #sidebar.collapsed .nav-link span {
      display: none;
    }
    #sidebar.collapsed {
      width: 60px;
    }
    .content {
      margin-left: 250px;
      background-position: center;
      background-size: cover;
      height: 100vh;
      transition: 0.5s;
    }
    #check:checked ~ .content {
      margin-left: 60px;
    }
    #check {
      display: none;
    }
    .custom-btn-spacing {
      margin-top: 3.4rem;
      margin-bottom: 3.4rem;
    }
    .navbar .ml-auto {
      display: flex;
      align-items: center;
    }
    .search-box {
      display: flex;
      align-items: center;
      margin-right: 1rem;
    }
    .logout-btn {
      margin-left: 1rem;
    }
    .table {
      border-collapse: collapse;
      width: 100%;
      margin-top: -3rem;
    }
    table.table th, table.table td {
      padding: 15px;
      text-align: left;
    }
    table.table td {
      border: none !important;
    }
    table.table {
      border: none !important;
    }
    table.table thead th {
      border: none !important;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
    Admin Dashboard
    <i class="fas fa-bars" id="menuToggle" onclick="toggleSidebar()"></i>
  </a>

  <!-- Move search box and logout button here -->
  <div class="ml-auto">
    <form id="searchForm" class="search-box" action="search_doctor.php" method="POST">
      <input class="form-control mr-2" type="search" name="query" placeholder="Search by Doctor Name" aria-label="Search" required>
      <button class="btn btn-outline-light" type="submit" form="searchForm">
        <i class="fas fa-search"></i>
      </button>
    </form>
    <button class="btn btn-outline-light logout-btn" onclick="confirmLogout()">
      Logout
    </button>
  </div>
  <script>
    function confirmLogout() {
      alert("Logout successfully.");
      window.location.href = "../html/home page.html"; // Add your logout functionality here
    }
  </script>
</nav>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item"><a class="nav-link active" href="../html/admin dashboard.html"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
          <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-user-injured"></i> <span>Manage Patients</span></a></li>
          <li class="nav-item"><a class="nav-link" href="doctor_dash.php"><i class="fas fa-user-md"></i> <span>Manage Doctors</span></a></li>
          <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-calendar-alt"></i> <span>Appointments</span></a></li>
          <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-prescription-bottle-alt"></i> <span>Prescriptions</span></a></li>
          <li class="nav-item"><a class="nav-link" href="contact_dash.php"><i class="fas fa-question-circle"></i> <span>Queries</span></a></li>
        </ul>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="content">
      <div class="container">
        <br>
        <button class="btn btn-primary custom-btn-spacing"><a href="add_doctor.php" class="text-light">Add Doctor</a></button>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Sl no</th>
              <th scope="col">Doctor Name</th>
              <th scope="col">Username</th>
              <th scope="col">Specialization</th>
              <th scope="col">Email</th>

              <th scope="col">Fees</th>
              <th scope="col">Operation</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "Select * from doctor";
            $result = mysqli_query($con, $sql);
            if ($result) {
              while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $username = $row['username'];
                $specialization = $row['specialization'];
                $email = $row['email'];

                $consultancyfees = $row['consultancyfees'];
                echo '<tr>
                  <th scope="row">' . $id . '</th>
                  <td>' . $name . '</td>
                  <td>' . $username . '</td>
                  <td>' . $specialization . '</td>
                  <td>' . $email . '</td>

                  <td>' . $consultancyfees . '</td>
                  <td>
                    <button class="btn btn-primary"><a href="edit_doctor.php?updateid=' . $id . '" class="text-light">Edit</a></button>
                    <button class="btn btn-danger"><a href="delete_doctor.php?deleteid=' . $id . '" class="text-light">Delete</a></button>
                  </td>
                </tr>';
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
  function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("collapsed");
  }
</script>
</body>
</html>
