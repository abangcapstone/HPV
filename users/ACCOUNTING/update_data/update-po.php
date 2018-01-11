<?php
session_start();
include '../../../dbconnect.php';
date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;

  if(!empty($_POST)) {
    $id_holder = mysqli_real_escape_string($dbcon,$_POST['id_holder']); 
       
       
      
      $sql = "UPDATE purchaseorder SET 
      postatus = 'APPROVED'
      WHERE ponumber = '$id_holder'";
      mysqli_query($dbcon,$sql);


      $getIP = $c_info->get_ip();
      $getBrowser = $c_info->get_Browser();
      $emp_code = $_SESSION['empcode'];
      $today = date("Y-m-d H:i:s");
      $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
      $ActivityTemp = 'Approved Purchase Order - '.$id_holder;
      $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
      mysqli_query($dbcon,$sql);
        
      
    
   
    $dbcon->close();

  }
    

?>