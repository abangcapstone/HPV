<?php
session_start();
include '../../../dbconnect.php';
date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;



if( $_SERVER['REQUEST_METHOD'] == 'POST') {
      
      
     $compcode = mysqli_real_escape_string($dbcon,$_POST['compcode']); 
      $sql = $dbcon->query("SELECT  * FROM companies where compno = '$compcode'");
      $count = $sql->num_rows;
      if($count == 0)
      {

          $cname = mysqli_real_escape_string($dbcon,$_POST['compname']);

          $sql = "INSERT INTO companies (compno,compname,compstatus) VALUES('$compcode','$cname','AC')";
          mysqli_query($dbcon,$sql);



          $getIP = $c_info->get_ip();
          $getBrowser = $c_info->get_Browser();
          $emp_code = $_SESSION['empcode'];
          $today = date("Y-m-d H:i:s");
          $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
          $ActivityTemp = 'Added a Company - '.$cname;
          $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
          mysqli_query($dbcon,$sql);

      }
      else{
          header('HTTP/1.1 500 Internal Server Booboo');
          header('Content-Type: application/json; charset=UTF-8');
        
      }
      
         

  }


?>