<?php
session_start();
  include 'dbconnect.php';

date_default_timezone_set('Asia/Manila');
require('user_info.php');
$c_info = new UserInfo;

  if(!empty($_POST)) {
      $EmpCode = $_SESSION['empcode'];


      $current_password = mysqli_real_escape_string($dbcon,$_POST['curr_pass']);
      $password = mysqli_real_escape_string($dbcon,$_POST['password']);
      $confirm_password = mysqli_real_escape_string($dbcon,$_POST['confirm_password']);

      $sql = $dbcon->query("SELECT  * FROM users where usercode = '$EmpCode'");
      $getOldPass = $sql->fetch_object();

      $current_password = md5($current_password);
      $DBcurr_pass = $getOldPass->userpass;

     if($current_password == $DBcurr_pass){
         echo 'sud';
         $password = md5($password);
         $sql = "UPDATE users 
              SET userpass='$password'
              WHERE usercode = '$EmpCode' ";
         mysqli_query($dbcon,$sql);


         $getIP = $c_info->get_ip();
         $getBrowser = $c_info->get_Browser();
         $today = date("Y-m-d H:i:s");
         $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
         $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$EmpCode','Password Changed','$getIP','$getBrowser','$timeTemp')";
         mysqli_query($dbcon,$sql);
     }
     else{
         header('HTTP/1.1 500 Internal Server Booboo');
      header('Content-Type: application/json; charset=UTF-8');

  }




         
  }
?>