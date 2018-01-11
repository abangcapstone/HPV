<?php


session_start();
include '../../../dbconnect.php';
date_default_timezone_set('Asia/Manila');
require('../../../user_info.php');
$c_info = new UserInfo;



  if(!empty($_POST)) {

      $id_holder = mysqli_real_escape_string($dbcon,$_POST['id_holder']);
      $update_poclient = mysqli_real_escape_string($dbcon, $_POST['update_client']);
      $update_podate = mysqli_real_escape_string($dbcon,$_POST['PODate']);
      $update_prepared = mysqli_real_escape_string($dbcon,$_POST['preparedBy']);
      $update_contactPerson = mysqli_real_escape_string($dbcon,$_POST['update_contactPerson']);
      $update_pocomp = mysqli_real_escape_string($dbcon,$_POST['update_company']);
      $update_pobranch = mysqli_real_escape_string($dbcon, $_POST['compbranch']);
      $update_reference = mysqli_real_escape_string($dbcon,$_POST['ref']);
      $update_podatereqst = mysqli_real_escape_string($dbcon, $_POST['PODateRqst']);


      $sql = $dbcon->query("SELECT * FROM podetails WHERE poitemcode = '$id_holder'");
      $row = $sql->num_rows;
      $id = $_POST['id'];
      $item = $_POST['item'];
      $quantity = $_POST['quantity'];
      $description = $_POST['description'];
      $unitprice = $_POST['unitprice'];
      $amount = $_POST['amount'];
      $count = count($item);
      if($count != $sql->num_rows) {
          for($i = $row; $i < $count; $i++) {
              $query = $dbcon->query("INSERT INTO podetails(poitemcode,poitemname,poitemquantity,poitemdesc,poitemprice,poitemtotal)
              VALUES ('$id_holder','"
                  . $dbcon->real_escape_string($item[$i]) .
                  "','"
                  . $dbcon->real_escape_string($quantity[$i]) .
                  "','"
                  . $dbcon->real_escape_string($description[$i]) .
                  "','"
                  . $dbcon->real_escape_string($unitprice[$i]) .
                  "','"
                  . $dbcon->real_escape_string($amount[$i]) .
                  "')
              ");
          }
      }
      else if ($count == $sql->num_rows){
          foreach($id as $key => $value) {
              $query2 = "UPDATE podetails SET 
            poitemname = '". $dbcon->real_escape_string($item[$key]) . "',
            poitemquantity = '" . $dbcon->real_escape_string($quantity[$key]) . "',
            poitemdesc = '" . $dbcon->real_escape_string($description[$key]) . "',
            poitemprice = '" . $dbcon->real_escape_string($unitprice[$key]) . "',
            poitemtotal = '" . $dbcon->real_escape_string($amount[$key]) . "'
                  WHERE id = '$value'";
          $dbcon->query($query2);
        }
      }


      $total = 0;
      $total = intval($total) + array_sum($amount);
      $sql = "UPDATE purchaseorder SET 
      poclient = '$update_poclient',
      poclientcontact = '$update_contactPerson',
      podate = '$update_podate',
      pocompany = '$update_pocomp',
      pobranch = '$update_pobranch',
      poreference = '$update_reference',
      podaterqst = '$update_podatereqst',
      popreparedby = '$update_prepared',
      pototal = '$total'
      WHERE ponumber = '$id_holder'";
      mysqli_query($dbcon,$sql);



      $getIP = $c_info->get_ip();
      $getBrowser = $c_info->get_Browser();
      $emp_code = $_SESSION['empcode'];
      $today = date("Y-m-d H:i:s");
      $timeTemp = date('F d, Y \a\t h:ia ',strtotime($today));
      $ActivityTemp = 'Updated PO - '.$id_holder;
      $sql = "INSERT INTO activitylogs (alempno,alactivity,alipaddress,albrowser,aldate) VALUES('$emp_code','$ActivityTemp','$getIP','$getBrowser','$timeTemp')";
      mysqli_query($dbcon,$sql);

      $dbcon->close();

  }


?>



