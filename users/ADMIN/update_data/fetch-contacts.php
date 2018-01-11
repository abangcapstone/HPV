
<?php
include "../../../dbconnect.php";
if(isset($_POST["contact_name"])){
  $query = "SELECT * FROM contacts WHERE contactname = '".$_POST["contact_name"]."'"; 
  $result = mysqli_query($dbcon, $query);  
  $row = mysqli_fetch_array($result);  
  
  echo json_encode($row);
}

?>