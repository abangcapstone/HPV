<?php
 session_start();
date_default_timezone_set('Asia/Manila');
require_once 'dbconnect.php';
require('user_info.php');
$c_info = new UserInfo;

 if(!isset($_SESSION['emplevel'])){
     header("Location: login.php");
     
 }else if(isset($_SESSION['emplevel'])!="" && $_SESSION['emplevel'] == "ADMIN"){
     header("Location: /HPV/user/ADMIN/home.php");
 }
 else if(isset($_SESSION['emplevel'])!="" && $_SESSION['emplevel'] == "Accounting"){
     header("Location: /HPV/user/ACCOUNTING/home.php");
 }

 if(isset($_GET['logout'])){
     session_destroy();
     unset($_SESSION['emplevel']);
     $getIP = $c_info->get_ip();
     $getBrowser = $c_info->get_Browser();
     $emp_code = $_SESSION['empcode'];
     $today = date("Y-m-d H:i:s");
     $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
     $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','Logged Out','$getIP','$getBrowser','$timeTemp')";
     mysqli_query($dbcon,$sql);
     header("Location: login.php");
 }

?>