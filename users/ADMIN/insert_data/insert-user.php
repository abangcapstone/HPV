<?php
session_start();
  include '../../../dbconnect.php';
date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;

  
  if(!empty($_POST)) {
      
      
    $username = mysqli_real_escape_string($dbcon,$_POST['username']);
    $comp_name = mysqli_real_escape_string($dbcon,$_POST['userCompany']);
    $comp_branch = mysqli_real_escape_string($dbcon,$_POST['userBranch']);
    $userfname = mysqli_real_escape_string($dbcon,$_POST['userFName']);
    $userlname = mysqli_real_escape_string($dbcon,$_POST['userLName']);
    $userpos = mysqli_real_escape_string($dbcon,$_POST['userPos']);
     $userlevel = mysqli_real_escape_string($dbcon,$_POST['userlevel']);
    $useremail = mysqli_real_escape_string($dbcon,$_POST['email']);
   
    // EMP-CODE Generate 
      
    $sql = $dbcon->query("SELECT  * FROM users");
    $NumRows = $sql->num_rows; 
    $NumRows++; 
    $Check = true;  
    do{
        $count = 0;
        $temp = str_pad($NumRows, 4, "0", STR_PAD_LEFT);
        $CheckCode = "EMP-".$temp;
        $query = $dbcon->query("SELECT * FROM users WHERE usercode = '$CheckCode'");
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
 
     $sql = $dbcon->query("SELECT  * FROM users where username = '$username'");
      $count = $sql->num_rows;
    
      if($count==0){
    
     $password = md5("p@ss");
      $sql = "INSERT INTO users (usercode,username,userpass,userstatus) VALUES('$EmpCode','$username','$password','AC')";
      mysqli_query($dbcon,$sql);



      $sql1 = "INSERT INTO employees (empcode,empfname,emplname,empemail,empcompany,empbranch,emppos,emplevel,empimage,empstatus) VALUES('$EmpCode','$userfname','$userlname','$useremail','$comp_name','$comp_branch','$userpos','$userlevel','/HPV/users/uploads/default-avatar.jpg','AC')";
      mysqli_query($dbcon,$sql1);


          $getIP = $c_info->get_ip();
          $getBrowser = $c_info->get_Browser();
          $emp_code = $_SESSION['empcode'];
          $today = date("Y-m-d H:i:s");
          $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
          $ActivityTemp = 'Created User - '.$EmpCode;
          $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
          mysqli_query($dbcon,$sql);





      }
      else{
          header('HTTP/1.1 500 Internal Server Booboo');
          header('Content-Type: application/json; charset=UTF-8');
        
      }
      
    

  }
    



?>