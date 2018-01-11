<?php

session_start();
include '../../../dbconnect.php';
date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;



if(!empty($_POST)) {
    $code = mysqli_real_escape_string($dbcon,$_POST['clientcode']);
    $cname = mysqli_real_escape_string($dbcon,$_POST['clientCompName']); 
   
    $sql = $dbcon->query("SELECT * FROM clients where clientname = '$cname'");
    $count = $sql->num_rows;
    
    if($count==0){
    
   
    $cbranch = mysqli_real_escape_string($dbcon,$_POST['clientCompBranch']);
    $caddr = mysqli_real_escape_string($dbcon,$_POST['clientCompAddr']);
    $cemail = mysqli_real_escape_string($dbcon,$_POST['clientCompEmail']);
    $ctelno=mysqli_real_escape_string($dbcon,$_POST['clientCompTel']);
    $cfxno = mysqli_real_escape_string($dbcon,$_POST['clientCompFax']);
    $ccategory = mysqli_real_escape_string($dbcon,$_POST['clientcategory']);
    $cterms = mysqli_real_escape_string($dbcon,$_POST['clientTerms']);
    $cbusiness = mysqli_real_escape_string($dbcon,$_POST['clientbusiness']);
      
       
       
        
       $query = $dbcon->query("SELECT count(id) as total FROM clients");
       $values = mysqli_fetch_assoc($query);
       $numClients = $values['total'];
       $numClients++;
      
       $clientcode = $code.'-'.$numClients.''.date("y");  // Concat Client Code
      
      
      
      $sql = "INSERT INTO clients (clientcode,clientname,clientbranch,clientaddr,clientemail,clienttelno,clientfaxno,clientcategory,clientterms,clientbusiness,clientstatus) VALUES('$clientcode','$cname','$cbranch','$caddr','$cemail','$ctelno','$cfxno','$ccategory','$cterms','$cbusiness','AC')";
      mysqli_query($dbcon,$sql);
      
      $contactName = $_POST['contactName'];
      $contactPos = $_POST['contactPos'];
      $contactNumber = $_POST['contactNumber'];
      
      foreach($contactName AS $key => $value){
       
              $query = "INSERT INTO contacts(contactcode,contactname,contactpos,contactnum)
              VALUES ('$clientcode','"
                  . $dbcon->real_escape_string($contactName[$key]) .
                  "','"
                  . $dbcon->real_escape_string($contactPos[$key]) .
                  "','"
                  . $dbcon->real_escape_string($contactNumber[$key]) .
                  "')
              ";
              
              $insert = $dbcon->query($query);
              
              if(!$insert){
                  echo $dbcon->error;
              }
              else{
                  $output .= "<p> Successfully added" . $contactNumber[$key] . "</p>";
              }
              
        
         }

        $getIP = $c_info->get_ip();
        $getBrowser = $c_info->get_Browser();
        $emp_code = $_SESSION['empcode'];
        $today = date("Y-m-d H:i:s");
        $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
        $ActivityTemp = 'Created a Client - '.$clientcode.' '.$cname;
        $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
        mysqli_query($dbcon,$sql);
      }
     else{
          header('HTTP/1.1 500 Internal Server Booboo');
          header('Content-Type: application/json; charset=UTF-8');
        
      }
    $dbcon->close();

  }
    

?>