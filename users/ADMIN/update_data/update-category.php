<?php

session_start();
include '../../../dbconnect.php';
date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;

  
  if(!empty($_POST)) {



    $catname = mysqli_real_escape_string($dbcon,$_POST['update_catname']);

    $id_holder = mysqli_real_escape_string($dbcon,$_POST['id_holder']);

      $sql = $dbcon->query("SELECT  * FROM categories where id = '$id_holder'");
      $getName = $sql->fetch_object();
      $oldName = $getName->categoryname;


      $sql = "UPDATE categories SET 
      categoryname = '$catname' 
      WHERE id = '$id_holder' ";
      mysqli_query($dbcon,$sql);


      $getIP = $c_info->get_ip();
      $getBrowser = $c_info->get_Browser();
      $emp_code = $_SESSION['empcode'];
      $today = date("Y-m-d H:i:s");
      $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
      $ActivityTemp = 'Updated Category '.$oldName.' to '.$catname;
      $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
      mysqli_query($dbcon,$sql);
          
      }
      
      


?>