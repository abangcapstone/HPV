<?php

session_start();
include '../../../dbconnect.php';
date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;

  if($dbcon)
  {
      echo 'connected';
  }
  if(!empty($_POST)) {
  
    $compno = mysqli_real_escape_string($dbcon,$_POST['compname']);
    $cbranch = mysqli_real_escape_string($dbcon,$_POST['compbranch']);
    $caddr = mysqli_real_escape_string($dbcon,$_POST['compaddr']);
    $cemail = mysqli_real_escape_string($dbcon,$_POST['compemail']);
    $ctelno=mysqli_real_escape_string($dbcon,$_POST['comptelno']);
    $cfxno = mysqli_real_escape_string($dbcon,$_POST['compfaxno']);

      // EMP-CODE Generate

      $sql = $dbcon->query("SELECT  * FROM branches WHERE branchcode = '$compno'");
      $NumRows = $sql->num_rows;
      $NumRows++;
      $Check = true;
      do{
          $count = 0;
          $temp = str_pad($NumRows, 4, "0", STR_PAD_LEFT);
          $CheckCode = $compno."-".$temp;
          $query = $dbcon->query("SELECT * FROM branches WHERE branchid = '$CheckCode'");
          $count = $query->num_rows;
          if($count == 1)
          {
              $Check = true;
              $NumRows+=1;
          }
          else{
              $Check = false;
              $EmpCode = $CheckCode;
          }

      }while($Check == true);
      // END EMP-CODE Generate

    
    $sql = $dbcon->query("SELECT  * FROM branches WHERE branchcode = '$compno' AND branchaddr = '$caddr'");
    $count = $sql->num_rows;
    
    if($count==0){
      $sql = "INSERT INTO branches (branchcode,branchid,branchloc,branchaddr,branchemail,branchtelno,branchfaxno,branchstatus) VALUES('$compno','$EmpCode','$cbranch','$caddr','$cemail','$ctelno','$cfxno','AC')";
      mysqli_query($dbcon,$sql);


        $getCompName = $dbcon->query("SELECT compname FROM companies WHERE compno = '$compno'") ;
        $name = $getCompName->fetch_object();


        $CompName = $name->compname;
        $getIP = $c_info->get_ip();
        $getBrowser = $c_info->get_Browser();
        $emp_code = $_SESSION['empcode'];
        $today = date("Y-m-d H:i:s");
        $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
        $ActivityTemp = 'Added '.$CompName.' Branch in '.$cbranch.' - '.$caddr;
        $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
        mysqli_query($dbcon,$sql);
    }
    else{
        header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
    }
  }
?>