<?php
    session_start();
    include_once "../../dbconnect.php";
    
    //if (!isset($_SESSION['adminSession'])) 
    if($_SESSION['emplevel'] != 'Generalist'){
        header ('Location: /HPV/login.php');
    
    }

    $query = $dbcon->query("SELECT count(id) as total FROM purchaseorder");
    $values = mysqli_fetch_assoc($query);
    $numofPO = $values['total'];
    $clientRows = $dbcon->query("SELECT * FROM clients");
    $companyRows = $dbcon->query("SELECT * FROM companies");
    
    
    $dbcon->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>HP Ventures Inc. | Accounts Payable System  </title>
      <link rel="shortcut icon" href="../images/HeaderLogo.png">

    <!-- Bootstrap -->
    <link href="/HPV/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/HPV/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/HPV/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/HPV/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="/HPV/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="/HPV/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="/HPV/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="/HPV/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="/HPV/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="/HPV/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">



    <!-- Custom Theme Style -->
      <link href="/HPV/build/css/custom.min.css" rel="stylesheet">
<!--      <link href="/HPV/build/css/added_style.css" rel="stylesheet">-->
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
              <div class="navbar nav_title" style="border: 0;">
                  <a href="home.php" class="site_title"><img src="../images/HeaderLogo.png"> <img src="../images/APsystemHeader.png"></a>
              </div>


            <div class="clearfix"></div>

              <div class="ln_solid" style="margin:11px 0 -5px !important; border-top: 1px solid #ffd772"></div>
              <div class="profile clearfix">
                  <div class="profile_pic">
                      <?php echo '<img src="'.$_SESSION['empimage'].'" alt="..." class="img-circle profile_img">' ?>
                  </div>
                  <div class="profile_info">
                      <h5 style="color:#2b2b2b">Welcome,</h5>
                      <h2><?php echo $_SESSION['empfname']; ?></h2>
                  </div>
                  <div class="clearfix"></div>
              </div>

              <div class="ln_solid" style="margin:5px 0 -5px !important; border-top: 1px solid #ffbf00;box-shadow: 0px 1px 1px #2b140e"></div>

            <br />

            <!-- sidebar menu -->
              <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                  <div class="menu_section">
                      <ul class="nav side-menu">
                          <li ><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
                          <li class="active"><a href="purchaseorder.php"><i class="fa fa-building-o"></i> Purchase Order </a></li>
                          <li ><a href="purchaseorder_print.php"><i class="fa fa-print"></i> Print  <span
                                          class="badge bg-green pull-right"><?php echo $numofPO ?></span> </a>
                          </li>
                      </ul>
                  </div>
              </div>
            <!-- /sidebar menu -->

           
          </div>
        </div>

       <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <?php echo '<img src="'.$_SESSION['empimage'].'">' ?> <?php echo $_SESSION['empfname']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                      <li> <a href="/HPV/users/GENERALIST/profile.php">Profile</a></li>
                    <li><a href="/HPV/logout.php?logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>  
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
          <div class="right_col" role="main">
              <div class="">
                  <div class="clearfix"></div>
                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                              <div class="x_title">
                                  <h2>Purchase Order</h2>
                                  <div class="col-md-3" >
                                  </div>
                                  <div class="clearfix"></div>
                              </div>
                         <form class="form-horizontal form-label-left " method="POST" action="insert_data/insert-po.php">

                         
                      <div class=" form-group has-feedback">
                        <label class="control-label col-md-2 col-sm-2 col-xs-9">TO:</label>
                        <div class="col-md-4 col-sm-4 col-xs-9">
                         <select id="client" name="client" class="selectpicker form-control" required >
                                                                  <option value="" selected>Please select client.</option>
                                                                    
                                                                  <?php 
                                                                  
                                                                    if($clientRows->num_rows > 0) {
                                                                      while($row = $clientRows->fetch_object()) {
                                                                      ?>
                                                                        <option value="<?php echo $row->clientcode ?>"> <?php echo $row->clientname ?> </option>
                                                                       
                                                                    <?php 
                                                                        
                                                                      }
                                                                    }
                                                                  ?>
                          </select>
                        </div>
                         <label class="control-label col-md-2 col-sm-2 col-xs-9">Date:</label>
                          <div class="col-md-4 col-sm-4 col-xs-9">

                              <input readonly type="text" class="form-control has-feedback-left" name ="date" id="date" value ="<?php echo date('m/d/Y');?>"  required >
                              <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                          </div>

                      </div>
                         
                         
                       <div class=" form-group has-feedback">
                         <label class="control-label col-md-2 col-sm-2 col-xs-9">Contact #:</label>
                            <div class="col-md-4 col-sm-4 col-xs-9">
                                <input  readonly id="clientContactNum" name="clientContactNum" type="text" class="form-control has-feedback-left" placeholder="Contact Number" required>
                                <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                            </div>   
                           
                        <label class="control-label col-md-2 col-sm-2 col-xs-9">Address:</label>
                        <div class="col-md-4 col-sm-4 col-xs-9">
                          <input readonly id="clientAddr" name="clientAddr" type="text" class="form-control has-feedback-left"
                                 placeholder="Address" required>
                            <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                        </div>
                          
                       
                             
                      </div>
                         

                        <div class="form-group has-feedback">
                             <label class="control-label col-md-2 col-sm-2 col-xs-9">Fax #:</label>
                            <div class="col-md-4 col-sm-4 col-xs-9">
                                <input readonly id="clientFaxNum" name="clientFaxNum" type="text" class="form-control has-feedback-left" placeholder="Fax Number" required>
                                <span class="fa fa-fax form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <label class="control-label col-md-2 col-sm-2 col-xs-9">Terms:</label>
                                <div class="col-md-4 col-sm-4 col-xs-9">
                                <input  readonly id="clientTerms" name="clientTerms" type="text" class="form-control has-feedback-left" placeholder="Terms" required>
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                      </div>

                         
                    <div class="form-group has-feedback">
                            <label class="textsize control-label col-md-2 col-sm-2 col-xs-9">Contact Person:</label>
                            <div class="col-md-4 col-sm-4 col-xs-9">
                                <select id="clientContactPerson" name="clientContactPerson" class="selectpicker form-control" required >
                                    <option value="">Please select a contact person.</option>

                                </select>
                            </div>

                            <label class="control-label col-md-2 col-sm-2 col-xs-9">Reference:</label>
                                <div class="col-md-4 col-sm-4 col-xs-9">
                                  <input id="ref" name="ref" type="text" class="form-control has-feedback-left" placeholder="Reference" required>
                                  <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>
                      </div>
                         

                     <div class="form-group has-feedback">
                            <label class="textsize control-label col-md-2 col-sm-2 col-xs-9 ">Requesting Entity:</label >
                            <div class="col-md-4 col-sm-4 col-xs-9">
                               <select id="company" name="company" class="selectpicker form-control" required >
                                                                  <option value="" selected>Please select client.</option>
                                                                    
                                                                  <?php 
                                                                  
                                                                    if($companyRows->num_rows > 0) {
                                                                      while($row = $companyRows->fetch_object()) {
                                                                      ?>
                                                                        <option value="<?php echo $row->compno ?>"> <?php echo $row->compname ?> </option>
                                                                       
                                                                    <?php 
                                                                        
                                                                      }
                                                                    }
                                                                  ?>
                             </select>
                            </div>
                         <label class="textsize control-label col-md-2 col-sm-2 col-xs-9 ">Please deliver not later than:</label>
                             <div class="col-md-4 col-sm-4 col-xs-9">
                                 <fieldset>
                                     <div class="control-group">
                                         <div class="controls">

                                                 <input type="text" class="form-control has-feedback-left" name ="single_cal3" id="single_cal3"  aria-describedby="inputSuccess2Status3">
                                                 <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                                 <span id="inputSuccess2Status3" class="sr-only">(success)</span>

                                         </div>
                                     </div>
                                 </fieldset>
                             </div>
                     </div>
                             <div class="form-group has-feedback">
                                 <label class="textsize control-label col-md-2 col-sm-2 col-xs-9 ">Branch:</label >
                                 <div class="col-md-4 col-sm-4 col-xs-9">
                                     <select id="compbranch" name="compbranch" class="selectpicker form-control" required >
                                         <option value="" selected>Please select branch.</option>

                                     </select>
                                 </div>
                                 <label class="control-label col-md-2 col-sm-2 col-xs-9">Tel #:</label>
                                 <div class="col-md-4 col-sm-4 col-xs-9">
                                     <input  readonly id="companyTelNo" name="companyTelNo" type="text" class="form-control has-feedback-left" placeholder="Telephone Number" required>
                                     <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                 </div>
                             </div>
                         <div class="ln_solid"></div>
                           <div class="form-group ">
                               
                                <div class="col-md-2 col-sm-2 col-xs-9">
                                    <h2 >ITEM</h2>
                                </div>

                                <div class="col-md-2 col-sm-2 col-xs-9">
                                 <h2 >QUANTITY</h2>
                                </div>

                                <div class="col-md-3 col-sm-3 col-xs-9 ">
                                <h2  >DESCRIPTION</h2>
                                </div>


                              <div class="col-md-2 col-sm-2 col-xs-9">
                                <h2 >UNIT PRICE</h2>
                                </div>
                              <div class="col-md-2 col-sm-2 col-xs-9">
                              <h2 >AMOUNT</h2>
                              </div>
                         </div>
                          <div class="ln_solid"></div>
                         
                    <div id="container">
                     <div class="container ">
                            <div class="col-md-2 col-sm-2 col-xs-9">
                             <input type="text" class=" form-control" id="item" name="item[]" placeholder="Item" required>
                            </div>
                            
                            <div class="col-md-2 col-sm-2 col-xs-9">
                             <input type="number" class=" form-control" id="quantity" name="quantity[]" placeholder="Quantity" required>
                            </div>
                            
                            <div class="col-md-3 col-sm-3 col-xs-9">
                             <input type="text" class="form-control " id="description" name="description[]" placeholder="Description" required>
                            </div>

                          <div class="col-md-2 col-sm-2 col-xs-9">
                             <input type="number" class=" form-control " step="any" id="unitprice" name="unitprice[]" placeholder="Unit Price" required>
                            </div>
                          <div class="col-md-2 col-sm-2  col-xs-9">
                             <input type="number" class="form-control " step="any" id="amount" name="amount[]" placeholder="Amount" readonly>
                          </div>
                          <div class="col-md-1 col-sm-1 col-xs-9">
                             <a id= "add" name="add" type="button" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-plus"></span></a>
                          </div>

                     </div>
                    </div>
                         
             
                      <div class="ln_solid"></div>
                         
                         
                       <div class="form-group has-feedback">
                            <label class="control-label col-md-2 col-sm-2 col-xs-9">Prepared by:</label >
                            <div class="col-md-4 col-sm-4 col-xs-9">
                                <input id="preparedBy" name="preparedBy" type="text" class="form-control has-feedback-left" placeholder="Default Input" value="<?php echo $_SESSION['empfname']; echo " "; echo $_SESSION['emplname'] ?>" required readonly>
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
  
                         </div>
                         
                      
                         
                         
                    <div class="ln_solid"></div>
                         
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						   <button class="btn btn-danger" type="reset">Reset</button>
                           <button type="submit" class="btn btn-success pull-right">Submit</button>
                        </div>
                          
                        
                      </div>

                             </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        <!-- /page content -->

        <!-- footer content -->
          <footer>

              <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
                  <?php include '../../footer.php'; ?>
              </div>

          </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="/HPV/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/HPV/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="/HPV/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/HPV/vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="/HPV/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="/HPV/vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="/HPV/vendors/moment/min/moment.min.js"></script>
    <script src="/HPV/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="/HPV/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="/HPV/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="/HPV/vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="/HPV/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="/HPV/vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="/HPV/vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="/HPV/vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="/HPV/vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="/HPV/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="/HPV/vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="/HPV/build/js/custom.min.js"></script>
     <!-- bootstrap-datetimepicker -->    
    <script src="/HPV/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#company').change (function(){
                var comp_code = $(this).val();
                $.ajax({
                    url:"../GENERALIST/update_data/fetch-branch.php",
                    method:"POST",
                    data:{comp_code:comp_code},
                    dataType:"text",
                    success:function(data){
                        $('#compbranch').html(data);
                    }
                });
            });
        });
    </script>
      
      <script>

         $(document).ready(function(e){

        $('#client').change (function(){
                                var client_code = $(this).val();

                                    $.ajax({
                                      url:"../GENERALIST/fetch_data/fetch_contacts.php",
                                      method:"POST",
                                      data:{client_code:client_code},
                                      dataType:"text",
                                      success:function(data){
                                        $('#clientContactPerson').html(data);

                                      }
                                    });
                                  });
              });


      </script>

        <script>
            
     
              $(document).ready(function(e){
                  
                   
                  
                  
               $('#client').change (function(){
                                       var client_code = $(this).val();
                                      
                                        $.ajax({
                                          url:"../GENERALIST/fetch_data/fetch_info.php",
                                            method:"POST",
                                            data:{client_code:client_code},
                                            dataType:"json",
                                            success:function(data){
                                            
                                            $('#clientAddr').val(data.clientaddr);
                                            $('#clientContactNum').val(data.clienttelno);
                                            $('#clientFaxNum').val(data.clientfaxno);
                                            $('#clientTerms').val(data.clientterms);
                                            
                                            }
                                        });

                                    });   
                  
                $('#compbranch').change (function(){
                                       let comp_code = $('#company').val();
                                       let branch_name = $('#compbranch').val();
                                        $.ajax({
                                          url:"../GENERALIST/fetch_data/fetch_info.php",
                                            method:"POST",
                                            data:{'comp_code':comp_code, 'branch_name':branch_name},
                                            dataType:"json",
                                            success:function(data){
                                            $('#companyTelNo').val(data.branchtelno);
                                            }
                                        });

                                    });   
                  
                    });   
      
      </script>

          <script>
                  $(document).ready(function(e){

                                                                                //variables
                      let html= '<div class="container"><div class="col-md-2 col-sm-2 col-xs-9" ' +
                                        'id="added"><input type="text" class="form-control " placeholder="Item" ' +
                                        'id="item" name="item[]" required></div><div class="col-md-2 col-sm-2 ' +
                                        'col-xs-9" id="added"> <input type="number" class="form-control " ' +
                                        'placeholder="Quantity" onkeydown="GetQuantity()" id="quantity" name="quantity[]" '+
                                        'required></div> <div class="col-md-3 col-sm-3 col-xs-9" id="added"><input type="text" class="form-control " placeholder="Description" id="description" name="description[]" required>  </div>  <div class="col-md-2 col-sm-2 col-xs-9" id="added"><input type="number" class="form-control " step="any" placeholder="Unit Price" id="unitprice" name="unitprice[]" required></div> <div class="col-md-2 col-sm-2 col-xs-9" id="added"> <input type="number"  class="form-control " placeholder="Amount" step="any" id="amount" name="amount[]" readonly> </div> <div class="col-md-1 col-sm-1 col-xs-12" id="added"><a id= "remove" name="remove" type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-minus"></span></a> </div>  </div>';
                                    
                                    //add rows to the form
                                    
                                     $("#add").click(function(e){
                                       $("#container").append(html);

                                     });
 

                                    //remove rows from the form
                                    
                                   $("#container").on('click','#remove',function(e){
                                        
                                        $('#added').last().remove();
                                        $('#added').last().remove();
                                        $('#added').last().remove();
                                        $('#added').last().remove();
                                        $('#added').last().remove();
                                        $('#added').last().remove();
                                       
                                    });
                                    
                                    //populate values from the first row
                                    $("#container").on('dblclick','#childItem',function(e){           
                                        $(this).val($('#item').val());
                                          });
                                        
                                     $("#container").on('dblclick','#childQuantity',function(e){           
                                         $(this).val($('#quantity').val());
                                               });
                                      $("#container").on('dblclick','#childDesc',function(e){           
                                        $(this).val($('#description').val());
                                                  
                                    });
                                    
                                     $("#container").on('dblclick','#childUnitPrc',function(e){           
                                        $(this).val($('#unitprice').val());
                                                  
                                    });
                                    
                                     $("#container").on('dblclick','#childAmount',function(e){           
                                        $(this).val($('#amount').val());
                                                  
                                    });

                      /*calculate AMOUNT start*/
                      let n = $('input[name="item[]"]').length;
                      let quanArray = $('input[name="quantity[]"]');
                      let priceArray = $('input[name="unitprice[]"]');
                      let amtArray = $('input[name="amount[]"]');
                      for(let k = 0; k < n; k++) {
                          (function () {
                              $(quanArray[k]).keyup(function(){
                                  let val = 0;
                                  let price = 0;
                                  let quantity = 0;
                                  quantity = Number($(quanArray.eq(k)).val());
                                  price = Number($(priceArray.eq(k)).val());
                                  val = price * quantity;
                                  $(amtArray[k]).val(val);
                              });

                              $(priceArray[k]).keyup(function(){
                                  let val = 0;
                                  let price = 0;
                                  let quantity = 0;
                                  quantity = Number($(quanArray.eq(k)).val());
                                  price = Number($(priceArray.eq(k)).val());
                                  val = price * quantity;
                                  $(amtArray[k]).val(val);
                              });
                          })(k);

                      }
                      /*calculater AMOUNT end*/




                  });
      </script>
    <script>
        function GetQuantity() {
            let inps = document.getElementsByName('quantity[]');
            let quanArray = $('input[name="quantity[]"]');
            let priceArray = $('input[name="unitprice[]"]');
            let amtArray = $('input[name="amount[]"]');
            for(let k = 0; k < inps.length; k++) {
                (function () {
                    $(quanArray[k]).keyup(function(){
                        let val = 0;
                        let price = 0;
                        let quantity = 0;
                        quantity = Number($(quanArray.eq(k)).val());
                        price = Number($(priceArray.eq(k)).val());
                        val = price * quantity;
                        $(amtArray[k]).val(val);
                    });

                    $(priceArray[k]).keyup(function(){
                        let val = 0;
                        let price = 0;
                        let quantity = 0;
                        quantity = Number($(quanArray.eq(k)).val());
                        price = Number($(priceArray.eq(k)).val());
                        val = price * quantity;
                        $(amtArray[k]).val(val);
                    });
                })(k);

            }
        }
    </script>

            
  </body>
</html>
