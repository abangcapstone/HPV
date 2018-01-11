<?php

session_start();
include '../../../dbconnect.php';
date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;
  
  if(!empty($_POST)) {



    $branchcode = mysqli_real_escape_string($dbcon,$_POST['branchcode']);
    $bloc = mysqli_real_escape_string($dbcon,$_POST['update_branchloc']);
    $baddr = mysqli_real_escape_string($dbcon,$_POST['update_branchaddr']);
    $bemail = mysqli_real_escape_string($dbcon,$_POST['update_branchemail']);
    $btelno=mysqli_real_escape_string($dbcon,$_POST['update_branchtelno']);
    $bfxno = mysqli_real_escape_string($dbcon,$_POST['update_branchfaxno']); 
    $bstatus = mysqli_real_escape_string($dbcon,$_POST['update_branchstatus']); 
    $id_holder = mysqli_real_escape_string($dbcon,$_POST['id_holder']);
      $sql = "UPDATE branches SET 
      branchloc = '$bloc',
      branchaddr = '$baddr',
      branchemail = '$bemail',
      branchtelno = '$btelno',
      branchfaxno = '$bfxno',
      branchstatus = '$bstatus'
      WHERE id = '$id_holder'";
      mysqli_query($dbcon,$sql);



      $getCompName = $dbcon->query("SELECT compname FROM companies WHERE compno = '$branchcode'") ;
      $name = $getCompName->fetch_object();


      $CompName = $name->compname;
      $getIP = $c_info->get_ip();
      $getBrowser = $c_info->get_Browser();
      $emp_code = $_SESSION['empcode'];
      $today = date("Y-m-d H:i:s");
      $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
      $ActivityTemp = 'Updated '.$CompName.' Branch in '.$bloc.' - '.$baddr;
      $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
      mysqli_query($dbcon,$sql);
      }
      
      


?>