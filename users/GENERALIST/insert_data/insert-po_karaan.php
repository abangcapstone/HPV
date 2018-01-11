<?php
  session_start();
  include '../../../dbconnect.php';
  if($dbcon)
  {
      echo 'connected';
  }

   
    if(!empty($_POST)) {
       
        $TO = mysqli_real_escape_string($dbcon,$_POST['client']);
        $PODate = mysqli_real_escape_string($dbcon,$_POST['date']);
        $PODaterequest = mysqli_real_escape_string($dbcon,$_POST['single_cal3']);
        $refs = mysqli_real_escape_string($dbcon,$_POST['ref']);
        $contact = mysqli_real_escape_string($dbcon,$_POST['clientContactPerson']);
        $requesting = mysqli_real_escape_string($dbcon,$_POST['company']);
        $prepared = mysqli_real_escape_string($dbcon,$_POST['preparedBy']);

        
        
        
        //generated PO
        $query = $dbcon->query("SELECT count(id) as total FROM purchaseorder");
        $values = mysqli_fetch_assoc($query);
        $numofPO = $values['total'];
        $numofPO++;  
        $numofPO  = str_pad($numofPO, 3, '0', STR_PAD_LEFT);
        $PONumber = 'PO#'. date("m") .$numofPO . date("y");
       
        
        
       
        
        
        
        $itemCode = $_POST['client'];
        $itemName = $_POST['item'];
        $itemQty = $_POST['quantity'];
        $itemdesc = $_POST['description'];
        $itemPrice = $_POST['unitprice'];
        $itemAmount = $_POST['amount'];
        $total = 0;
       
      foreach($itemName AS $key => $value){
       
              $query = "INSERT INTO podetails(poitemcode,poitemname,poitemquantity,poitemdesc,poitemprice,poitemtotal)
              VALUES ('$PONumber','"
                  . $dbcon->real_escape_string($itemName[$key]) .
                  "','"
                  . $dbcon->real_escape_string($itemQty[$key]) .
                  "','"
                  . $dbcon->real_escape_string($itemdesc[$key]) .
                  "','"
                  . $dbcon->real_escape_string($itemPrice[$key]) .
                  "','"
                  . $dbcon->real_escape_string($itemAmount[$key]) .
                  "'
                    )
              ";
              
              $insert = $dbcon->query($query);
              
              if(!$insert){
                  echo $dbcon->error;
              }
              else{

                   header ('Location: /HPV/users/GENERALIST/purchaseorder.php');

              }
            
         }

         $total =  intval($total) + array_sum($itemAmount);

         $sql = "INSERT INTO purchaseorder (ponumber,poclient,poclientcontact,pocompany,poreference,popreparedby,pototal,podate,podaterqst,postatus)
                VALUES ('$PONumber','$TO','$contact','$requesting','$refs','$prepared','$total','$PODate','$PODaterequest','PENDING')";
        
                mysqli_query($dbcon,$sql);
                $user = $_SESSION['empcode'];
                $today = date("Y-m-d H:i:s");
        $sql1 = "INSERT INTO activitylogs (alcode,alempno,altype,alaction,aldate) VALUES ('$PONumber','$user','PO','created','$today')";
                mysqli_query($dbcon,$sql1);
              
        
    }
?>