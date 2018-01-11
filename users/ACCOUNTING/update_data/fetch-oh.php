<?php
include_once "../../../dbconnect.php";
if(isset($_POST['oh_type'])){

    $query = "SELECT * FROM overheads WHERE overheadtype = '".$_POST['oh_type']."'";
    $result = mysqli_query($dbcon, $query);


    $output = '<option value="">Please select OH#.</option>';
    while($row = mysqli_fetch_array($result))
    {
        if($row["overheadstatus"] != "PAID" && $row["overheadstatus"] != "PROCESSING") {
            $output .= '<option value="' . $row["overheadcode"] . '">' . $row["overheadcode"] . '</option>';
        }
    }
    echo $output;
}

if(isset($_POST["oh_no"])){
    $query = "SELECT * FROM overheads, companies, overheaddetails WHERE overheadcode = '".$_POST["oh_no"]."' AND overheadcomp = compno AND overheaddetailscode = '".$_POST["oh_no"]."'";
    $result = mysqli_query($dbcon,$query);
    $row = mysqli_fetch_array($result);

    echo json_encode($row);

}

?>