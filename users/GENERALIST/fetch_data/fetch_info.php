<?php
include '../../../dbconnect.php';
    
if(isset($_POST["client_code"])){
    $query = "SELECT * FROM clients WHERE clientcode = '".$_POST["client_code"]."'";
    $result = mysqli_query($dbcon,$query);
    $row = mysqli_fetch_array($result);
    
    echo json_encode($row);
    
}

if(isset($_POST["branch_name"]) && isset($_POST["comp_code"])){
    $query = "SELECT * FROM branches WHERE branchcode = '".$_POST["comp_code"]."' AND branchid = '". $_POST["branch_name"] ."'";
    $result = mysqli_query($dbcon,$query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
    
}
?>

