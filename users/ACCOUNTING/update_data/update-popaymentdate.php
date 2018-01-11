<?php
session_start();
include '../../../dbconnect.php';
date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;

if(!empty($_POST)) {
    $code = mysqli_real_escape_string($dbcon,$_POST['id_holder']);
    $date = mysqli_real_escape_string($dbcon,$_POST['date']);
    $or = mysqli_real_escape_string($dbcon,$_POST['orno']);
    $ref = mysqli_real_escape_string($dbcon,$_POST['refno']);



    $sql = "UPDATE podetails SET 
      podatepaid = '$date',
      porefno = '$ref',
      poorno = '$or'
      
      WHERE poitemcode = '$code'";
    mysqli_query($dbcon,$sql);




    $query = mysqli_query($dbcon, "SELECT * FROM purchaseorder,companies ,podetails 
WHERE  ponumber = '$code' && ponumber = compno && poitemcode= '$code' ");
    $data = mysqli_fetch_array($query);

    $type = 'Purchase Order';
    $payor = $data['compno'];
    $amt = $data['pototal'];



    $sql2 = "INSERT INTO transactions (transaccode, transactype, transacpayor, transacdate, transacamt) VALUES
          ('$code','$type', '$payor', '$date', '$amt')";
    mysqli_query($dbcon,$sql2);

    $getIP = $c_info->get_ip();
    $getBrowser = $c_info->get_Browser();
    $emp_code = $_SESSION['empcode'];
    $today = date("Y-m-d H:i:s");
    $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
    $ActivityTemp = 'Updated Payment of Purchase Order - '.$code;
    $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
    mysqli_query($dbcon,$sql);


    $dbcon->close();

}


?>