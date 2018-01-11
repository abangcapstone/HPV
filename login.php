<?php
    session_start();
   date_default_timezone_set('Asia/Manila');
    require_once 'dbconnect.php';
    require('user_info.php');
    $c_info = new UserInfo;
    $adminSession="";

    if(isset($_SESSION['emplevel'])!=""){
        header("Location: users/ADMIN/home.php");
        exit;
    }
     $min_number = 1;
	$max_number = 10;

	$random_number1 = mt_rand($min_number, $max_number);
	$random_number2 = mt_rand($min_number, $max_number);
    if(isset($_POST['login'])) {
        
        $captchaResult = $_POST["captchaResult"];
		$firstNumber = $_POST["firstNumber"];
		$secondNumber = $_POST["secondNumber"];

		$checkTotal = $firstNumber + $secondNumber;
        if ($captchaResult == $checkTotal){
        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);
        
        
        
        $username = $dbcon->real_escape_string($username);
        $password = $dbcon->real_escape_string($password);
        $password = md5($password);
    
     
        $query = $dbcon->query("SELECT * FROM users WHERE username = '$username' AND userpass = '$password'");
        $row = $query->fetch_array();
        $userCode = $row['usercode'];
        $count = $query->num_rows;
 
        if($count == 1)  
        {
            $getIP = $c_info->get_ip();
            $getBrowser = $c_info->get_Browser();
            $userlevel = $dbcon->query("SELECT * FROM employees WHERE empcode = '$userCode'");
            $rows = $userlevel->fetch_array();
            if(!strcmp("ADMIN", $rows['emplevel'])) {
              if(!strcmp("AC", $rows['empstatus'])) {
                $_SESSION = $rows;
                $emp_code = $_SESSION['empcode'];
                  $today = date("Y-m-d H:i:s");
                  $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
                $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','Logged In','$getIP','$getBrowser','$timeTemp')";
                mysqli_query($dbcon,$sql);
                header ('Location: users/ADMIN/home.php');
              }
              else
              {
                $msg =  '<div class="alert alert-danger text-center">
                        <strong>User is inactive!</strong>
                    </div>';
              }
            }
            else if(!strcmp("Accounting", $rows['emplevel'])) {
              if(!strcmp("AC", $rows['empstatus'])) {
                $_SESSION = $rows;
                  $emp_code = $_SESSION['empcode'];
                  $today = date("Y-m-d H:i:s");
                  $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
                  $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','Logged In','$getIP','$getBrowser','$timeTemp')";
                  mysqli_query($dbcon,$sql);
                header ('Location: users/ACCOUNTING/home.php');
              }
              else
              {
                $msg =  '<div class="alert alert-danger text-center">
                        <strong>User is inactive!</strong>
                    </div>';
              }
            }
            else if(!strcmp("Generalist", $rows['emplevel'])) {
                if(!strcmp("AC", $rows['empstatus'])) {
                    $_SESSION = $rows;
                    $emp_code = $_SESSION['empcode'];
                    $today = date("Y-m-d H:i:s");
                    $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
                    $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','Logged In','$getIP','$getBrowser','$timeTemp')";
                    mysqli_query($dbcon,$sql);
                    header ('Location: users/GENERALIST/home.php');
                }
                else
                {
                    $msg =  '<div class="alert alert-danger text-center">
                        <strong>User is inactive!</strong>
                    </div>';
                }
            }
            else if(!strcmp("User", $rows['emplevel'])) {
                if(!strcmp("AC", $rows['empstatus'])) {
                    $_SESSION = $rows;
                    $emp_code = $_SESSION['empcode'];
                    $today = date("Y-m-d H:i:s");
                    $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
                    $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','Logged In','$getIP','$getBrowser','$timeTemp')";
                    mysqli_query($dbcon,$sql);
                    header ('Location: users/USER/home.php');
                }
                else
                {
                    $msg =  '<div class="alert alert-danger text-center">
                        <strong>User is inactive!</strong>
                    </div>';
                }
            }
        }
        else
        {
            $msg =  '<div class="alert alert-danger text-center">
                        <strong>Invalid username or password</strong>
                    </div>';
        }
        }else if($captchaResult == '') {
			 $msg =  '<div class="alert alert-danger text-center">
                        <strong>Please Input Captcha</strong>
                    </div>';
		}
		else{
            $msg =  '<div class="alert alert-danger text-center">
                        <strong>Incorrect Captcha</strong>
                    </div>';
        }
        $dbcon->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
     <title>HP Ventures Inc. | Accounts Payable System  </title>
      <link rel="shortcut icon" href="users/images/HeaderLogo.png">

    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="users/css/style.css" rel="stylesheet">
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">
    
<!--      <script src='https://www.google.com/recaptcha/api.js'></script>-->
  </head>
  <body>
    <div class="container">
   
            <form class="form-signin" method="post" action="login.php">
                    <div class="page-header"><img id="headerImage" src="users/images/HPLogo.png " alt="HPHeaderLogo" class ="img-responsive animated fadeInRight" align="middle" ></div>
                    <!-- Display validation error here -->
                    <?php
                        if(isset($msg))
                            echo $msg
                    ?>
                    <div><input type="text" id="inputEmail" name="username" class="form-control" placeholder="Username" required autofocus class="fa fa-user-o"></div>
                    <div><input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required></div>
                   
                     <div>
                        <h4> <span class="label label-info"> Resolve the simple captcha below: </span></h4>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <?php
                                    echo '<h5>'.$random_number1 . ' + ' . $random_number2 . ' = </h5>';
                                ?>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <input name="captchaResult" class="form-control" style="width:50px;height:30px;margin:5px 0px 10px -10px" size="2" />
                            </div>
                         </div>
                         
                        <input name="firstNumber" type="hidden" value="<?php echo $random_number1; ?>" />
                        <input name="secondNumber" type="hidden" value="<?php echo $random_number2; ?>" />
                     </div>
                 <br />
              <button id="SignInButton" class="btn btn-lg btn-primary btn-block" name="login" type="submit" >Log in </button>
               
            </form>
         
       

      </div>
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="documentation/js/bootstrap.min.js"></script>
  </body>
</html>