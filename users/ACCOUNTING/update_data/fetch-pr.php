<?php
include '../../../dbconnect.php';

if(isset($_POST["pr_number"])){
    $query = "SELECT * FROM paymentrequests, companies WHERE prno = '".$_POST["pr_number"]."' AND prcomp = compno";
    $result = mysqli_query($dbcon,$query);
    $row = mysqli_fetch_array($result);

    echo json_encode($row);

}

if(isset($_POST["content"])){
    $query = "SELECT * FROM clients WHERE clientname = '".$_POST["content"]."'";
    $result = mysqli_query($dbcon,$query);
    $row = mysqli_fetch_array($result);

    echo json_encode($row);

}

?>

