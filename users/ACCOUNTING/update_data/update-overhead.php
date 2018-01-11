<?php

include '../../../dbconnect.php';


if(!empty($_POST)) {
    $code = mysqli_real_escape_string($dbcon,$_POST['id_holder']);
    $name =  mysqli_real_escape_string($dbcon,$_POST['businessname']);
    $addr = mysqli_real_escape_string($dbcon,$_POST['address']);
    $contact = mysqli_real_escape_string($dbcon,$_POST['contactdetails']);
    $room = mysqli_real_escape_string($dbcon,$_POST['unit']);
    $amt = mysqli_real_escape_string($dbcon,$_POST['amount']);
    $due = mysqli_real_escape_string($dbcon,$_POST['duedate']);

    $duedate = date('Y-m-d', strtotime(date('Y-m-').date($due)));




    $sql = "UPDATE overheaddetails SET 
      overheadname = '$name',
      overheadaddr = '$addr',
      overheadcontact = '$contact',
      overheadunit = '$room',
      overheadamount = '$amt',
      overheadduedate = '$duedate'
      
      WHERE overheaddetailscode = '$code'";
    mysqli_query($dbcon,$sql);




    $dbcon->close();

}


?>