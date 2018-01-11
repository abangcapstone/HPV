<?php
    include "../../../dbconnect.php";
    if(isset($_POST['comp_code'])){
    
    $query = "SELECT * FROM branches WHERE branchcode = '".$_POST['comp_code']."'";
    $result = mysqli_query($dbcon, $query);  

      $output= '<option value="">Please select a branch.</option>';
    while($row = mysqli_fetch_array($result))
    {
      $output .= '<option value="'.$row["branchid"].'">'.$row["branchloc"]."-".$row["branchaddr"].'</option>';
    }
echo $output;
    }
?>