<?php
session_start();
include '../../../dbconnect.php';

date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;
  if(!empty($_POST)) {

      $EmpCode = mysqli_real_escape_string($dbcon,$_POST['Emp_Code']);
    $comp_name = mysqli_real_escape_string($dbcon,$_POST['update_comp']);
    $comp_branch = mysqli_real_escape_string($dbcon,$_POST['update_branch']);
    $userfname = mysqli_real_escape_string($dbcon,$_POST['update_fname']);
    $userlname = mysqli_real_escape_string($dbcon,$_POST['update_lname']);
    $userpos = mysqli_real_escape_string($dbcon,$_POST['update_position']);
    $userlevel = mysqli_real_escape_string($dbcon,$_POST['update_userlevel']);
    $useremail = mysqli_real_escape_string($dbcon,$_POST['update_email']);
    $userstatus = mysqli_real_escape_string($dbcon,$_POST['update_status']);
    $id_holder = mysqli_real_escape_string($dbcon,$_POST['id_holder']);
  
      $sql = "UPDATE users 
      SET userstatus='$userstatus'
      WHERE id = '$id_holder' ";
      mysqli_query($dbcon,$sql);
      
      $sql1 = "UPDATE employees 
      SET 
      empfname='$userfname',
      emplname='$userlname',
      empemail='$useremail',
      empcompany='$comp_name',
      empbranch='$comp_branch',
      emppos='$userpos',
      emplevel='$userlevel',
      empstatus='$userstatus' 
      WHERE id = '$id_holder' ";
      mysqli_query($dbcon,$sql1);

      $getIP = $c_info->get_ip();
      $getBrowser = $c_info->get_Browser();
      $emp_code = $_SESSION['empcode'];
      $today = date("Y-m-d H:i:s");
      $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
      $ActivityTemp = 'Updated User - '.$EmpCode;
      $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
      mysqli_query($dbcon,$sql);
      
       
  }

    



?>