<?php
session_start();
include '../../../dbconnect.php';

date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;

if(!empty($_POST)) {
    $id_holder = mysqli_real_escape_string($dbcon,$_POST['id_holder']);
    $date = mysqli_real_escape_string($dbcon, $_POST['dateDelivered']);
    $name = mysqli_real_escape_string($dbcon, $_POST['nameDeliveree']);



    $sql = "INSERT INTO podelivery (pono,podeliverydate,pocouriername) VALUES ('$id_holder', '$date', '$name')";
    mysqli_query($dbcon,$sql);



        $query = mysqli_query($dbcon, "SELECT * FROM purchaseorder,companies ,podetails 
WHERE  ponumber = '$id_holder' && pocompany = compno && poitemcode= '$id_holder' ");
    $data = mysqli_fetch_array($query);

    $type = 'Purchase Order';
    $payor = $data['compname'];
    $amt = $data['pototal'];


    $sql2 = "INSERT INTO transactions (transaccode, transactype, transacpayor, transacdate, transacamt) VALUES
          ('$id_holder','$type', '$payor', '$date', '$amt')";
    mysqli_query($dbcon,$sql2);

    $getIP = $c_info->get_ip();
    $getBrowser = $c_info->get_Browser();
    $emp_code = $_SESSION['empcode'];
    $today = date("Y-m-d H:i:s");
    $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
    $ActivityTemp = 'Issued Delivery Date of Purchase Order - '.$id_holder;
    $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
    mysqli_query($dbcon,$sql);
    $dbcon->close();
}
?>

