<?php

session_start();
include '../../../dbconnect.php';
date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;


  if(!empty($_POST)) {
      
    $catname = mysqli_real_escape_string($dbcon,$_POST['categoryname']);
   
    // CAT-CODE Generate 
      
    $sql = $dbcon->query("SELECT * FROM categories");
    $NumRows = $sql->num_rows; 
    $NumRows++; 
    $Check = true;  
    do{
        $count = 0;
        $temp = str_pad($NumRows, 4, "0", STR_PAD_LEFT);
        $CheckCode = "CAT-".$temp;
        $query = $dbcon->query("SELECT * FROM categories WHERE categorycode = '$CheckCode'");
        $count = $query->num_rows;
            if($count == 1)
                {
                    $Check = true;
                    $NumRows+=1;
                }
            else{
                 $Check = false;
                 $CategoryCode = $CheckCode;
            }
        
    }while($Check == true);
    // END CAT-CODE Generate 
      
     $sql = $dbcon->query("SELECT  * FROM categories WHERE categoryname = '$catname'");  
      $count = $sql->num_rows;
      
      if($count==0){
      
      
      $sql = "INSERT INTO categories (categorycode,categoryname) VALUES('$CategoryCode','$catname')";
      mysqli_query($dbcon,$sql);

          $getIP = $c_info->get_ip();
          $getBrowser = $c_info->get_Browser();
          $emp_code = $_SESSION['empcode'];
          $today = date("Y-m-d H:i:s");
          $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
          $ActivityTemp = 'Added a Category - '.$catname;
          $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
          mysqli_query($dbcon,$sql);
      }
       else{
          header('HTTP/1.1 500 Internal Server Booboo');
          header('Content-Type: application/json; charset=UTF-8');
        
      }
  }
    



?>