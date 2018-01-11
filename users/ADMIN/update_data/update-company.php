<?php

session_start();
include '../../../dbconnect.php';
date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;



if(!empty($_POST)) {
    $Code = mysqli_real_escape_string($dbcon,$_POST['Comp_Code']);
    $cname = mysqli_real_escape_string($dbcon,$_POST['update_compname']);
    $cstatus = mysqli_real_escape_string($dbcon,$_POST['update_status']); 
    $id_holder = mysqli_real_escape_string($dbcon,$_POST['id_holder']);


    $sql = $dbcon->query("SELECT  * FROM companies where id = '$id_holder'");
    $getComp = $sql->fetch_object();
    $oldName = $getComp->compname;



    $sql = "UPDATE companies SET 
      compname = '$cname',
      compstatus = '$cstatus' 
      WHERE id = '$id_holder'";
      mysqli_query($dbcon,$sql);

    $getIP = $c_info->get_ip();
    $getBrowser = $c_info->get_Browser();
    $emp_code = $_SESSION['empcode'];
    $today = date("Y-m-d H:i:s");
    $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
    $ActivityTemp = 'Updated '.$oldName.' company to '.$cname;
    $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
    mysqli_query($dbcon,$sql);
          
      }
      if($cstatus=="IN"){
          $sql = "UPDATE branches SET 
                  
                  branchstatus = '$cstatus' 
                  WHERE branchcode = '$Code'";
                      mysqli_query($dbcon,$sql);




      }

      
      


?>