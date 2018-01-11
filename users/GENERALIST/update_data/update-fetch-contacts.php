<?php
    include '../../../dbconnect.php';
    if(isset($_POST['client_code'])){



    $query = "SELECT * FROM contacts WHERE contactcode = '".$_POST['client_code']."'";
    $result = mysqli_query($dbcon, $query);

    while($row = mysqli_fetch_array($result))
    {
      $output .= '<option value="'.$row["contactname"].'">'.$row["contactname"].'</option>';
    }
        echo $output;
    }
?>