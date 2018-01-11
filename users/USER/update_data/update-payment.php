<?php

include '../../../dbconnect.php';


if(!empty($_POST)) {
    $id_holder = mysqli_real_escape_string($dbcon,$_POST['id_holder']);
    $prdatened = mysqli_real_escape_string($dbcon, $_POST['dateNed']);
    $prrqstdby = mysqli_real_escape_string($dbcon, $_POST['requestedBy']);
    $prattention = mysqli_real_escape_string($dbcon, $_POST['attention']);
    $prtitle = mysqli_real_escape_string($dbcon, $_POST['title']);
    $prdepartment = mysqli_real_escape_string($dbcon, $_POST['department']);


    $sql = "UPDATE paymentrequests SET 
      prdateneeded = '$prdatened',
      prrequestedby = '$prrqstdby',
      prattention = '$prattention',
      prdept = '$prdepartment',
      prtitle = '$prtitle' 
      WHERE prno = '$id_holder'";
    mysqli_query($dbcon,$sql);

    $id = $_POST['id'];
    $description = $_POST['description'];
    $invoice = $_POST['invoiceno'];
    $date = $_POST['date'];
    $amount = $_POST['AMOUNT'];

    foreach ($id as $key => $value) {
        $sql = "UPDATE paymentrequestsdetails SET
        prdesc = '". $dbcon->real_escape_string($description[$key]) ."',
        prinvoiceno = '". $dbcon->real_escape_string($invoice[$key]) ."',
        prduedate = '". $dbcon->real_escape_string($date[$key]) ."',
        pramount = '". $dbcon->real_escape_string($amount[$key]) ."'
        WHERE id = '$value'";
        $dbcon->query($sql);
    }
    $total =  intval($total) + array_sum($amount);
    $sql = $dbcon->query("UPDATE paymentrequests SET prtotal = '$total' WHERE prno = '$id_holder'");

    $dbcon->close();

}


?>