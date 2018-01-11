<?php
session_start();
  include 'dbconnect.php';

  if(!empty($_POST)) {
      $EmpCode = $_SESSION['empcode'];

    $id_holder = mysqli_real_escape_string($dbcon,$_POST['id_holder']);
    $password = mysqli_real_escape_string($dbcon,$_POST['password2']);

    $password = md5($password);
      $sql = "UPDATE users 
      SET userpass='$password'
      WHERE usercode = '$EmpCode' ";
      mysqli_query($dbcon,$sql);
  }
?>