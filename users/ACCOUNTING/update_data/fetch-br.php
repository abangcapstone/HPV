<?php
include '../../../dbconnect.php';

if(isset($_POST["br_number"])){
        $query = "SELECT * FROM budgetrequests, companies WHERE brno = '".$_POST["br_number"]."' AND brcomp = compno";
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

