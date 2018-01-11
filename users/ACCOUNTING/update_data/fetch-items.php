
<?php
include "../../../dbconnect.php";
if(isset($_POST["item_name"])){
  $query = "SELECT * FROM podetails WHERE poitemname = '".$_POST["item_name"]."'"; 
  $result = mysqli_query($dbcon, $query);  
  $row = mysqli_fetch_array($result);  
  
  echo json_encode($row);
}

?>