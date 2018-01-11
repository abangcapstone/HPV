<?php

session_start();
include '../../../dbconnect.php';
date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;


if(!empty($_POST)) {
      
    $clientcode = mysqli_real_escape_string($dbcon,$_POST['Client_Code']);
    $cname = mysqli_real_escape_string($dbcon,$_POST['update_clientCompName']);
    $cbranch = mysqli_real_escape_string($dbcon,$_POST['update_clientCompBranch']);
    $caddr = mysqli_real_escape_string($dbcon,$_POST['update_clientCompAddr']);
    $cemail = mysqli_real_escape_string($dbcon,$_POST['update_clientCompEmail']);
    $ctelno=mysqli_real_escape_string($dbcon,$_POST['update_clientCompTel']);
    $cfxno = mysqli_real_escape_string($dbcon,$_POST['update_clientCompFax']);
    $ccategory = mysqli_real_escape_string($dbcon,$_POST['update_clientcategory']);
    $cterms = mysqli_real_escape_string($dbcon,$_POST['update_clientTerms']);
    $cbusiness = mysqli_real_escape_string($dbcon,$_POST['update_clientbusiness']);
     $cstatus = mysqli_real_escape_string($dbcon,$_POST['update_status']); 
    $id_holder = mysqli_real_escape_string($dbcon,$_POST['id_holder']); 
       
       
      
      $sql = "UPDATE clients SET 
      clientname = '$cname',
      clientbranch = '$cbranch',
      clientemail = '$cemail',
      clienttelno = '$ctelno',
      clientfaxno = '$cfxno',
      clientcategory = '$ccategory',
      clientterms = '$cterms',
      clientbusiness = '$cbusiness',
      clientstatus = '$cstatus'
      WHERE id = '$id_holder'";
      mysqli_query($dbcon,$sql);
        
      
      $contactname = mysqli_real_escape_string($dbcon,$_POST['update_contactName']); 
      $contactpos = mysqli_real_escape_string($dbcon,$_POST['update_contactPos']); 
      $contactnum = mysqli_real_escape_string($dbcon,$_POST['update_contactNumber']);
      $getContactID = mysqli_real_escape_string($dbcon,$_POST['getContactID']);
    
      $sqq = "UPDATE contacts SET 
      contactname = '$contactname',
      contactpos = '$contactpos',
      contactnum = '$contactnum'
      WHERE id = '$getContactID'";
      mysqli_query($dbcon,$sqq);





    $getIP = $c_info->get_ip();
    $getBrowser = $c_info->get_Browser();
    $emp_code = $_SESSION['empcode'];
    $today = date("Y-m-d H:i:s");
    $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
    $ActivityTemp = 'Updated Client - '.$clientcode.' '.$cname;
    $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
    mysqli_query($dbcon,$sql);
      
      
    
   
    $dbcon->close();

  }
    

?>