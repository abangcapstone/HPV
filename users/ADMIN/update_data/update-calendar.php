<?php

session_start();
include '../../../dbconnect.php';
date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;

if(!empty($_POST)) {

    $Day = mysqli_real_escape_string($dbcon,$_POST['updateDay']);
    $Month = mysqli_real_escape_string($dbcon,$_POST['updateMonth']);
    $OccName = mysqli_real_escape_string($dbcon,$_POST['updateOccName']);
    $Status = mysqli_real_escape_string($dbcon,$_POST['update_calendarstatus']);
    $id_holder = mysqli_real_escape_string($dbcon,$_POST['id_holder']);

    $getIP = $c_info->get_ip();
    $getBrowser = $c_info->get_Browser();
    $emp_code = $_SESSION['empcode'];
    $today = date("Y-m-d H:i:s");
    $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
    $ActivityTemp = 'Updated Holiday ' .$Month.' '.$Day.' - ('.$OccName.')';

    if($_POST['updateMonth'] == 'April' || $_POST['updateMonth'] == 'June' || $_POST['updateMonth'] == 'September' || $_POST['updateMonth'] == 'November' ){
        if($_POST['updateDay'] == 31){
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
        }
        else{
            $sql = "UPDATE calendar SET 
            holidayDay = '$Day', holidayMonth = '$Month', holidayname ='$OccName', holidaystatus = '$Status' 
            WHERE id = '$id_holder' ";
            mysqli_query($dbcon,$sql);


            $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
            mysqli_query($dbcon,$sql);
        }
    }
    else if($_POST['updateMonth'] == 'February'){
        if($_POST['updateDay'] == 30 || $_POST['updateDay'] == 31){
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
        }
        else{
            $sql = "UPDATE calendar SET 
            holidayDay = '$Day', holidayMonth = '$Month', holidayname ='$OccName', holidaystatus = '$Status' 
            WHERE id = '$id_holder' ";
            mysqli_query($dbcon,$sql);

            $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
            mysqli_query($dbcon,$sql);
        }
    }
    else{
        $sql = "UPDATE calendar SET 
            holidayDay = '$Day', holidayMonth = '$Month', holidayname ='$OccName', holidaystatus = '$Status' 
            WHERE id = '$id_holder' ";
        mysqli_query($dbcon,$sql);

        $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
        mysqli_query($dbcon,$sql);
    }




}




?>