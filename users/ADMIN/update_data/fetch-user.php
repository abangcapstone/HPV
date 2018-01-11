 <?php  
  session_start();
 include "../../../dbconnect.php";
  if(isset($_POST["employee_code"])){
      $query = "SELECT * FROM employees WHERE empcode = '".$_POST["employee_code"]."'";  
      $result = mysqli_query($dbcon, $query);  
      $EmpRow= mysqli_fetch_array($result);

      $compRows = $dbcon->query("SELECT * FROM companies WHERE compstatus = 'AC'");
     /* $comp = mysqli_fetch_array($compRows);*/
      $branchRows = $dbcon->query("SELECT * FROM branches WHERE branchcode = '".$EmpRow['empcompany']."'");

  }

 ?>

 <html>
 <head>
 </head>

 <body>
 <form class="form-horizontal form-label-left" method="post" id="UpdateUserForm" data-parsley-validate>
     <div id="UpdateDiv" class="alert alert-success text-center alert-dismissible fade in" role="alert" style="width:200px; margin:0 auto; margin-bottom:5px; display:none" >
         <p style="color:#fff; font-size:120%; text-align:center" id="UpdateMessage"></p>
     </div>
     <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empcode">Employee Code
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="Emp_Code" name="Emp_Code" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" value="<?php echo $EmpRow['empcode']; ?>"type="text" readonly>
         </div>
     </div>

     <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="userCompany">Company
             <span class="required"></span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <select id="update_comp" name="update_comp" class="selectpicker form-control" required >
                 <option value="">Please select company.</option>
                 <?php


                 if ($compRows->num_rows > 0)
                 {
                     while ($row = $compRows->fetch_object())
                     {
                         if($row->compno == $EmpRow['empcompany']){
                            echo  '<option value="'.$row->compno.'" selected>'.$row->compname.'</option>';
                         }
                         else{
                             echo  '<option value="'.$row->compno.'">'.$row->compname.'</option>';
                         }
                     }
                 }

                 ?>
             </select>
         </div>
     </div>
     <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="userBranch">Branch
             <span class="required"></span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <select id="update_branch" name="update_branch" class="selectpicker form-control" required>

                 <?php
                        while($row = $branchRows->fetch_object())
                        {
                              $temp = $row->branchloc.' - '. $row->branchaddr;

                                if($temp== $EmpRow['empbranch']){
                                echo  '<option value="'.$temp.'"selected>'.$temp.'</option>';
                            }
                            else{
                                echo  '<option value="'.$temp.'">'.$temp.'</option>';
                            }
                        }
                 ?>
             </select>
         </div>
     </div>
     <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="userFName">Firstname
             <span class="required"></span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="update_fname" name="update_fname" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" required="required" type="text" value="<?php echo $EmpRow['empfname']; ?>">
         </div>
     </div>
     <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lastname
             <span class="required"></span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="update_lname" name="update_lname" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" required="required" type="text" value="<?php echo $EmpRow['emplname']; ?>">
         </div>
     </div>
     <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="userPos">Position
             <span class="required"></span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="update_position" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="update_position"  required="required" type="text" value="<?php echo $EmpRow['emppos']; ?>">
         </div>
     </div>
     <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="userlevel">User Level
             <span class="required"></span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">

             <select id= "update_userlevel" name="update_userlevel" class="selectpicker form-control" required >
                 <option value="">Please select user level.</option>
                 <?php
                 $userlevel = array("ADMIN","Accounting","Generalist","Finance","CEO","COO","User");
                 $length = count($userlevel);

                 for($i=0;$i < $length; $i++){
                     if($userlevel[$i] == $EmpRow['emplevel']){
                         echo '<option value="'.$userlevel[$i].'" selected>'.$userlevel[$i].'</option>';
                     }
                     else{
                         echo '<option value="'.$userlevel[$i].'" >'.$userlevel[$i].'</option>';
                     }
                 }

                ?>
             </select>
         </div>
     </div>
     <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
             <span class="required"></span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input type="email" id="update_email" name="update_email"  required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $EmpRow['empemail']; ?>">
         </div>
     </div>
     <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="userBranch">Status
             <span class="required"></span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <select id="update_status" name="update_status" class="selectpicker form-control"required >
                 <?php

                     if("AC"==$EmpRow['empstatus']) {
                         echo '<option value="'.AC.'"selected>'.Active.'</option>';
                         echo '<option value="'.IN.'">'.Inactive.'</option>';
                     }
                     else{
                         echo '<option value="'.AC.'">'.Active.'</option>';
                         echo '<option value="'.IN.'"selected>'.Inactive.'</option>';
                     }



                 ?>
             </select>
         </div>
     </div>
     <div class="modal-footer">
         <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-7 col-sm-offset-7" >
             <input type="hidden" name="id_holder" id="id_holder" value="<?php echo $EmpRow["id"] ?>"/>
             <button name="update" id="update" type="submit" class="btn btn-success">
                 Update
             </button>
         </div>
     </div>
 </form>
 </body>
 <script>

         $('#update_comp').change (function(){
             var comp_code = $(this).val();
             $.ajax({
                 url:"../ADMIN/update_data/fetch-branch.php",
                 method:"POST",
                 data:{comp_code:comp_code},
                 dataType:"text",
                 success:function(data){
                     $('#update_branch').html(data);
                 }
             });
         });
 </script>

 <script>

     $('#UpdateUserForm').on("submit",function(event) {
         event.preventDefault();

         $.ajax({
             url:"../ADMIN/update_data/update-user.php",
             method:"POST",
             data:$('#UpdateUserForm').serialize(),
             beforeSend:function(){
                 $('#update').val("Updating");
             },
             success:function(data){
                 $("#UpdateDiv").show();
                 $("#UpdateMessage").text("Data Updated");
                 $("UpdateUserModal").modal('hide');

                 setTimeout(function(){
                     location.reload();
                 }, 500);

             }
         });

     });
 </script>
 </html>
