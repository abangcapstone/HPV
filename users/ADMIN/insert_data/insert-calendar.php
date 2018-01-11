<?php
session_start();
include '../../../dbconnect.php';
date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;

if(!empty($_POST)) {

    $OccName = mysqli_real_escape_string($dbcon,$_POST['OccName']);
    $Day = mysqli_real_escape_string($dbcon,$_POST['Day']);
    $Month = mysqli_real_escape_string($dbcon,$_POST['Month']);


    $Get = $dbcon->query("SELECT  * FROM calendar WHERE holidayDay = '$Day' AND holidayMonth = '$Month' ");
    $count = $Get->num_rows;

    if($count==0){
        $sql = "INSERT INTO calendar (holidayname,holidayDay,holidayMonth,holidaystatus) VALUES('$OccName','$Day','$Month','AC')";
        mysqli_query($dbcon,$sql);

        $getIP = $c_info->get_ip();
        $getBrowser = $c_info->get_Browser();
        $emp_code = $_SESSION['empcode'];
        $today = date("Y-m-d H:i:s");
        $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
        $ActivityTemp = 'Added a Holiday ' .$Month.' '.$Day.' - ('.$OccName.')';
        $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
        mysqli_query($dbcon,$sql);
    }
    else{
        header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
    }
}
?>