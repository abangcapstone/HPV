<?php

session_start();
include '../../../dbconnect.php';
date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;


if(!empty($_POST)) {

    $voucherno = mysqli_real_escape_string($dbcon, $_POST['voucherNo']);
    $voucheridentifier = mysqli_real_escape_string($dbcon, $_POST['brnumber']);
    $voucherdate = mysqli_real_escape_string($dbcon, $_POST['single_call']);
    $voucherpreparedby = mysqli_real_escape_string($dbcon, $_POST['voucherPreparedBy']);
    $vouchertype = mysqli_real_escape_string($dbcon, $_POST['type']);
    $voucherrefno = mysqli_real_escape_string($dbcon, $_POST['refno']);
    $vouchercomp = mysqli_real_escape_string($dbcon, $_POST['voucherComp']);
    $voucherClient = mysqli_real_escape_string($dbcon, $_POST['voucherClient']);
    $voucheraddr = mysqli_real_escape_string($dbcon,$_POST['voucherAddr']);
    $brchno = mysqli_real_escape_string($dbcon, $_POST['voucherType']);

    $sql = "INSERT INTO vouchers (voucherno,voucheridentifier,voucherdate,voucherpreparedby,vouchertype,voucherstatus,voucherrefno,vouchercomp,voucherclient,voucheraddr,voucherchno) VALUES('$voucherno','$voucheridentifier','$voucherdate','$voucherpreparedby','$vouchertype','PRINT', '$voucherrefno','$vouchercomp','$voucherClient','$voucheraddr','$brchno')";
    mysqli_query($dbcon,$sql);


    $getIP = $c_info->get_ip();
    $getBrowser = $c_info->get_Browser();
    $emp_code = $_SESSION['empcode'];
    $today = date("Y-m-d H:i:s");
    $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
    $ActivityTemp = 'Created a Budget Request Voucher'.' '.$voucheridentifier;
    $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
    mysqli_query($dbcon,$sql);
    
    
    
    
    $invoiceNo = $_POST['invoiceno'];
    $desc = $_POST['description'];
    $amt = $_POST['amount'];

    foreach($invoiceNo AS $key => $value) {

        $query = "INSERT INTO voucherdetails(voucherno,voucherinvoiceno,voucherdesc,voucheramount,voucherstatus)
              VALUES ('$voucherno','"
            . $dbcon->real_escape_string($invoiceNo[$key]) .
            "','"
            . $dbcon->real_escape_string($desc[$key]) .
            "','"
            . $dbcon->real_escape_string($amt[$key]) .
            "','PRINT')
              ";

        $insert = $dbcon->query($query);
        if(!$insert){
            echo $dbcon->error;
        }
        else{

            header ('Location: /HPV/users/ACCOUNTING/br_vouchers.php');

        }


    }
    $dbcon->close();
}
?>