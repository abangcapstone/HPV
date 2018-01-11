 <?php  
  
 include "../../../dbconnect.php";
  if(isset($_POST["category_code"])){
      $query = "SELECT * FROM categories WHERE categorycode = '".$_POST["category_code"]."'";  
      $result = mysqli_query($dbcon, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
  }

 ?>
 