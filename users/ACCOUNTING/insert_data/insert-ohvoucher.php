<?php

include '../../../dbconnect.php';


if(!empty($_POST)) {

    $voucherno = mysqli_real_escape_string($dbcon, $_POST['voucherNo']);
    $voucheridentifier = mysqli_real_escape_string($dbcon, $_POST['ohNo']);
    $voucherdate = mysqli_real_escape_string($dbcon, $_POST['single_call']);
    $voucherpreparedby = mysqli_real_escape_string($dbcon, $_POST['voucherPreparedBy']);
    $vouchertype = mysqli_real_escape_string($dbcon, $_POST['type']);
    $voucherrefno = mysqli_real_escape_string($dbcon, $_POST['refno']);
    $vouchercomp = mysqli_real_escape_string($dbcon, $_POST['voucherComp']);
    $voucherClient = mysqli_real_escape_string($dbcon, $_POST['voucherClient']);
    $voucherAddr = mysqli_real_escape_string($dbcon, $_POST['voucherAddr']);
    $ohchno = mysqli_real_escape_string($dbcon, $_POST['voucherType']);

    $sql = "INSERT INTO vouchers (voucherno,voucheridentifier,voucherdate,voucherpreparedby,vouchertype,voucherstatus,voucherrefno,vouchercomp, voucherclient,voucherchno,voucheraddr) VALUES('$voucherno','$voucheridentifier','$voucherdate','$voucherpreparedby','$vouchertype','PRINT','$voucherrefno','$vouchercomp','$voucherClient','$ohchno','$voucherAddr')";
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
            "','REPRINT')
              ";

        $insert = $dbcon->query($query);
        if(!$insert){
            echo $dbcon->error;
        }
        else{

            header ('Location: /HPV/users/ACCOUNTING/viewoverheads.php');

        }


    }
    $dbcon->close();
}
?>