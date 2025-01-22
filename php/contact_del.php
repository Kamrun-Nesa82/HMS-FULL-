<?php
  include 'contact_con.php';
  if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="delete from contact where id=$id";
    $result=mysqli_query($con,$sql);
    if($result){
       // echo "Deleted successfully";
       header('location:contact_dash.php');
    }else{
        die(mysqli_error($con));
    }
  }
?>