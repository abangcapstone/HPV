<?php

include "../../../dbconnect.php";
if(isset($_POST["ID"])){
    $query = "SELECT * FROM calendar WHERE id = '".$_POST["ID"]."'";
    $result = mysqli_query($dbcon, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);

}

?>
