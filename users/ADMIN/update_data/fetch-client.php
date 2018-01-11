 <?php  
  session_start();
 include "../../../dbconnect.php";
  if(isset($_POST["client_code"])){
      $query = "SELECT * FROM clients WHERE clientcode = '".$_POST["client_code"]."'";  
      $result = mysqli_query($dbcon, $query); 
      $clientrow = mysqli_fetch_array($result); 
      
      $namerow= $dbcon->query("SELECT * FROM contacts ");
      
      $queryRow = $dbcon->query("SELECT * FROM contacts WHERE contactcode = '".$_POST["client_code"]."'");
                      $contactrow = mysqli_fetch_array($queryRow);

      $categoryRow =$dbcon->query("SELECT * FROM categories");
    }

 ?>
<html>
<head>
</head>

<body>
<form id="UpdateClientForm" method="POST" class="form-horizontal form-label-left" data-parsley-validate >
                 <div id="UpdateDiv" class="col-md-3 col-md-offset-5 alert alert-success text-center alert-dismissible fade in" role="alert" style="width:200px; display:none"  > <p style="color:#fff; font-size:120%; text-align:center" id="UpdateMessage"></p> </div>  
                <div class="col-md-12 col-sm-12">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="empcode">Client Code 
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                         
                          <input id="Client_Code" name="Client_Code" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" type="text" value="<?php echo $clientrow['clientcode'] ?>" readonly>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="clientNature">Category<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                           <select id="update_clientcategory" name = "update_clientcategory" class="selectpicker form-control" required value="<?php echo  $clientrow['clientcode'] ?>">
                               <?php


                               if ($categoryRow->num_rows > 0)
                               {
                                   while ($row = $categoryRow->fetch_object())
                                   {
                                       if($row->categoryname == $clientrow['clientcategory']){
                                           echo  '<option value="'.$row->categoryname.'" selected>'.$row->categoryname.'</option>';
                                       }
                                       else{
                                           echo  '<option value="'.$row->categoryname.'">'.$row->categoryname.'</option>';
                                       }
                                   }
                               }

                               ?>

                                    </select>

                            </div>
                      </div>

                        <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="clientbusiness">Nature of Business<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input id="update_clientbusiness" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="update_clientbusiness" placeholder="Nature of Business" required="required" type="text" value="<?php echo $clientrow['clientbusiness'] ?>">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="clientCompName">Company<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input id="update_clientCompName" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="update_clientCompName" placeholder="Company Name" required="required" type="text" value="<?php echo $clientrow['clientname'] ?>">
                        </div>
                      </div>



                      <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="clientCompBranch">Branch<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input id="update_clientCompBranch" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="update_clientCompBranch" placeholder="Company Branch" required="required" type="text" value="<?php echo $clientrow['clientbranch'] ?>">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="clientCompAddr">Address<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input id="update_clientCompAddr" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="update_clientCompAddr" placeholder="Address" required="required" type="text" value="<?php echo $clientrow['clientaddr'] ?>">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="clientCompEmail">Contact Email 
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="email" id="update_clientCompEmail" name="update_clientCompEmail"  placeholder="Contact Email" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $clientrow['clientemail'] ?>">
                        </div>
                      </div>


                     <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="clientCompTel">Telephone 
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="tel" id="update_clientCompTel" name="update_clientCompTel"  placeholder="Telephone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12" value="<?php echo $clientrow['clienttelno'] ?>">
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="clientCompFax">Fax Number 
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input id="update_clientCompFax" type="text" name="update_clientCompFax"  placeholder="Fax Number" data-validate-length-range="5,20" class="optional form-control col-md-8 col-xs-12" value="<?php echo $clientrow['clientfaxno'] ?>">
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cleintTerms">Terms<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                           <select name="update_clientTerms" id="update_clientTerms" class="selectpicker form-control" required>
                               
                                        <?php
                                                  for($days = 30; $days <= 150; $days+=30){
                                                        $days= $days.' days';
                                                      if($days ==  $clientrow['clientterms'] )
                                                      {
                                                          echo '<option value="'.$days.'" selected>'. $clientrow['clientterms'].'</option>';
                                                      }
                                                      else
                                                      {
                                                           echo '<option value="'.$days.'">'.$days.'</option>';
                                                      }
                                                  }                  
    
    
                                        ?>
                               
                                    
                           </select>

                            </div>
                      </div>

                     <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="userBranch">Status <span class="required"></span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                           <select id="update_status" name="update_status" class="selectpicker form-control"required >
                               <?php

                               if("AC"== $clientrow['clientstatus']) {
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



             </div>

                  <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="item form-group">

                          <div class="col-md-7 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4">
                              <h4><i class="glyphicon glyphicon-user"></i> Contact Person(s)</h4>
                           
                          </div>
                   </div>


                  <div class="item form-group">

                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">
                           <select id="updateContacts" name="updateContacts" class="selectpicker form-control" required>
                                     

                                      <?php 


                                        if($namerow->num_rows > 0) {
                                          while($rows = $namerow->fetch_object()) {
                                          
                                            if($rows->contactcode == @$_POST["client_code"]){
                                                
                                                  
                                                    echo '<option value="'.$rows->contactname.'">'.$rows->contactname.' </option>';
                                                 
                                                
                                              }
                                              
                                            }

                                        }
                                      ?>
                            </select>

                         </div>
                       <div class="ln_solid col-md-12 col-sm-12 col-xs-12"></div>
                   </div>


                      
               <div id="container">
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contactName">Name <span class="required">*</span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input id="update_contactName" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="update_contactName" placeholder="Fullname" required="required" type="text" value="<?php echo $contactrow['contactname']; ?>">
                    </div>
                  </div>


                   <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contactPos">Position <span class="required">*</span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                         
                      <input id="update_contactPos" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="update_contactPos" placeholder="Position" required="required" type="text" value="<?php echo $contactrow['contactpos']; ?>">
                    </div>
                  </div>



                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contactNumber">Contact Number <span class="required">*</span>
                        </label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input type="tel" id="update_contactNumber" name="update_contactNumber" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12"  placeholder="Contact Number" value="<?php echo $contactrow['contactnum']; ?>">
                        </div>

                      </div>

                  </div>
                  </div>


            </div>

                    <div class="form-group">
                        <div class="ln_solid col-md-12 col-sm-12 col-xs-12"></div>
                        <div class="col-md-4 col-sm-4 col-xs-3 col-md-offset-4 col-sm-offset-4 col-xs-offset-5 ">
                          <input type="hidden" name="id_holder" id="id_holder" value="<?php echo $clientrow["id"] ?>" />
                          <input type="hidden" name="getContactID" id="getContactID" value="<?php echo $contactrow['id']; ?>" />   

                         <button type ="submit" name ="update" id="update" class="btn btn-success" style="width:100%; height:50px">
                          <h4>Update</h4>
                        </button>

                        </div>

                     </div>
            </form> 

  </body>
  <script > 
$('#updateContacts').change (function(){
                  var contact_name = $(this).val();
                         
        $.ajax({
         url:"../ADMIN/update_data/fetch-contacts.php",  
          method:"POST",
          data:{contact_name:contact_name},
          dataType:"json",
          success:function(data){
            $('#update_contactName').val(data.contactname);
            $('#update_contactPos').val(data.contactpos);
            $('#update_contactNumber').val(data.contactnum);
            $('#getContactID').val(data.id);
           
            
          }
        });
      });
    </script> 
  
  
  
  <script>
  $('#UpdateClientForm').on("submit",function(event) {  
  event.preventDefault();  
    
    
   $.ajax({  
    url:"../ADMIN/update_data/update-client.php",  
    method:"POST",  
    data:$('#UpdateClientForm').serialize(),  
    beforeSend:function(){  
     $('#update').val("Inserting");  
    },  
    success:function(data){  
    $("#UpdateDiv").show(); 
    $("#UpdateMessage").text("Data Updated");
     setTimeout(function(){
                   location.reload(); 
                }, 500);
               
    
        
    }  
   });  
   
 });
    </script>
 </html>