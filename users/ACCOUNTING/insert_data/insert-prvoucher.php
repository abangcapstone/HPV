<?php

include '../../../dbconnect.php';


if(!empty($_POST)) {

    $voucherno = mysqli_real_escape_string($dbcon, $_POST['voucherNo']);
    $voucheridentifier = mysqli_real_escape_string($dbcon, $_POST['prnumber']);
    $voucherdate = mysqli_real_escape_string($dbcon, $_POST['single_call']);
    $voucherpreparedby = mysqli_real_escape_string($dbcon, $_POST['voucherPreparedBy']);
    $vouchertype = mysqli_real_escape_string($dbcon, $_POST['type']);
    $voucherrefno = mysqli_real_escape_string($dbcon, $_POST['refno']);
    $vouchercomp = mysqli_real_escape_string($dbcon, $_POST['voucherComp']);
    $voucherClient = mysqli_real_escape_string($dbcon, $_POST['voucherClient']);
    $voucheraddr = mysqli_real_escape_string($dbcon,$_POST['voucherAddr']);
    $prchno = mysqli_real_escape_string($dbcon, $_POST['voucherType']);

    $sql = "INSERT INTO vouchers (voucherno,voucheridentifier,voucherdate,voucherpreparedby,vouchertype,voucherstatus,voucherrefno,vouchercomp,voucherclient,voucherchno,voucheraddr) VALUES('$voucherno','$voucheridentifier','$voucherdate','$voucherpreparedby','$vouchertype','PRINT','$voucherrefno','$vouchercomp','$voucherClient','$prchno','$voucheraddr')";
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