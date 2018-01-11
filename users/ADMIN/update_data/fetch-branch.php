 <?php  
  
 include "../../../dbconnect.php";
  if(isset($_POST["branch_code"])){
      $query = "SELECT * FROM branches WHERE id = '".$_POST["branch_code"]."'";
      $result = mysqli_query($dbcon, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);
  }
 else if(isset($_POST['comp_code'])){

     $query = "SELECT * FROM branches WHERE branchcode = '".$_POST['comp_code']."'";
     $result = mysqli_query($dbcon, $query);

     $output="";
     $output = '<option value="">Please select a branch.</option>';
     while($row = mysqli_fetch_array($result))
     {
         if($row["branchstatus"] == "AC")
         {
             $temp = $row["branchloc"].' - '.$row["branchaddr"];
             $output .= '<option value="'.$row["branchid"].'">'.$temp.'</option>';
         }
     }
       echo $output;
 }
 ?>
