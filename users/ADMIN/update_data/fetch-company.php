 <?php  
  
 include "../../../dbconnect.php";
  if(isset($_POST["company_code"])) {
      /* $query = "SELECT * FROM branches WHERE branchcode = '".$_POST["company_code"]."'";
       $result = mysqli_query($dbcon, $query);*/
      $query = "SELECT * FROM companies WHERE compno = '" . $_POST["company_code"] . "'";

      $result1 = mysqli_query($dbcon, $query);
      /* $row = mysqli_fetch_array($result);*/
      $row1 = mysqli_fetch_array($result1);
      echo json_encode($row1);



  }

 ?>
 