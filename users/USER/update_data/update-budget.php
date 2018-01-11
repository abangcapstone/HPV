<?php

include '../../../dbconnect.php';


if(!empty($_POST)) {
    $id_holder = mysqli_real_escape_string($dbcon,$_POST['id_holder']);
    $brdatened = mysqli_real_escape_string($dbcon, $_POST['dateNeeded']);
    $brrqstdby = mysqli_real_escape_string($dbcon, $_POST['brRequestedBy']);
    $brattention = mysqli_real_escape_string($dbcon, $_POST['brAttention']);
    $brtitle = mysqli_real_escape_string($dbcon, $_POST['brTitle']);
    $brdepartment = mysqli_real_escape_string($dbcon, $_POST['brDepartment']);



    $sql = "UPDATE budgetrequests SET 
      brrequestedby = '$brrqstdby',
      brtitle = '$brtitle',
      brattention = '$brattention',
      brdept = '$brdepartment',
      brdateneeded = '$brdatened'
      WHERE brno = '$id_holder'";
    mysqli_query($dbcon,$sql);

    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $amount = $_POST['AMOUNT'];

    foreach ($id as $key => $value) {
        $query = "UPDATE budgetrequestsdetails SET
        brquantity = '". $dbcon->real_escape_string($quantity[$key]) ."',
        brdescription = '". $dbcon->real_escape_string($description[$key]) ."',
        bramount = '". $dbcon->real_escape_string($amount[$key]) ."'
        WHERE id = '$value'";
        $dbcon->query($query);
    }
    $total =  intval($total) + array_sum($amount);
    $sql = $dbcon->query("UPDATE budgetrequests SET brtotal = '$total' WHERE brno = '$id_holder'");




    $dbcon->close();

}


?>