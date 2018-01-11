<?php
include '../../../dbconnect.php';
    
if(isset($_POST["po_number"])){
    $query = "SELECT * FROM purchaseorder, clients, companies WHERE ponumber = '".$_POST["po_number"]."' AND poclient = clientcode AND pocompany = compno";
    $result = mysqli_query($dbcon,$query);
    $row = mysqli_fetch_array($result);
    
    echo json_encode($row);
    
}

if(isset($_POST["comp_code"])){
    $query = "SELECT * FROM companies WHERE compno = '".$_POST["comp_code"]."'";
    $result = mysqli_query($dbcon,$query);
    $row = mysqli_fetch_array($result);
    
    echo json_encode($row);
    
}
?>

