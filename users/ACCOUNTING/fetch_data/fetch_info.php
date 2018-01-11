<?php
include '../../../dbconnect.php';
    
if(isset($_POST["client_code"])){
    $query = "SELECT * FROM clients WHERE clientcode = '".$_POST["client_code"]."'";
    $result = mysqli_query($dbcon,$query);
    $row = mysqli_fetch_array($result);
    
    echo json_encode($row);
    
}

if(isset($_POST["comp_code"])){
    $query = "SELECT * FROM branches WHERE branchid = '".$_POST["comp_code"]."'";
    $result = mysqli_query($dbcon,$query);
    $row = mysqli_fetch_array($result);
    
    echo json_encode($row);
    
}
?>

