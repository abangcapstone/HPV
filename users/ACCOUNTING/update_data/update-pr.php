<?php

include '../../../dbconnect.php';


if(!empty($_POST)) {
    $id_holder = mysqli_real_escape_string($dbcon,$_POST['id_holder']);



    $sql = "UPDATE paymentrequests SET 
      prstatus = 'APPROVED'
      WHERE prno = '$id_holder'";
    mysqli_query($dbcon,$sql);




    $dbcon->close();

}


?>