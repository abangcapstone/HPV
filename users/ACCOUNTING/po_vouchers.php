<?php 
  session_start();
  include '../../dbconnect.php';

   //if (!isset($_SESSION['adminSession'])) 
    if($_SESSION['emplevel'] != 'Accounting'){
        header ('Location: /HPV/login.php');
    }
// VOUCHER CODE Generate

$sql = $dbcon->query("SELECT  * FROM vouchers");
$NumRows = $sql->num_rows;
$NumRows++;
$Check = true;
do{
    $count = 0;
    $temp = str_pad($NumRows, 4, "0", STR_PAD_LEFT);
    $CheckCode = "CV-".$temp;
    $query = $dbcon->query("SELECT * FROM vouchers WHERE voucherno = '$CheckCode'");
    $count = $query->num_rows;
    if($count == 1)
    {
        $Check = true;
        $NumRows+=1;
    }
    else{
        $Check = false;
        $VoucherCode = $CheckCode;
    }

}while($Check == true);
// END VOUCHER CODE Generate

  $result = $dbcon->query("SELECT * FROM purchaseorder");
  $sql5 = $dbcon->query("SELECT * FROM purchaseorder WHERE postatus LIKE 'APPROVED' AND ponumber NOT IN (SELECT voucheridentifier FROM vouchers)");


$query = $dbcon->query("SELECT count(*) as total FROM vouchers");
$values = mysqli_fetch_assoc($query);
$numVouchers = $values['total'];

$query = $dbcon->query("SELECT count(*) as total FROM overheads");
$values = mysqli_fetch_assoc($query);
$numOverheads = $values['total'];

$query = $dbcon->query("SELECT count(id) as totalappr FROM purchaseorder WHERE postatus LIKE 'APPROVED' ");
$values = mysqli_fetch_assoc($query);
$numofAppr = $values['totalappr'];

$query2 = $dbcon->query("SELECT count(id) as totalpending FROM purchaseorder WHERE postatus LIKE 'PENDING' ");
$values2 = mysqli_fetch_assoc($query2);
$numofPending = $values2['totalpending'];

$query = $dbcon->query("SELECT count(id) as brPending FROM budgetrequests WHERE brstatus LIKE 'PENDING'");
$values = mysqli_fetch_assoc($query);
$brPending = $values['brPending'];

$query = $dbcon->query("SELECT count(id) as brApproved FROM budgetrequests WHERE brstatus LIKE 'APPROVED'");
$values = mysqli_fetch_assoc($query);
$brApproved = $values['brApproved'];

$query = $dbcon->query("SELECT count(id) as prApproved FROM paymentrequests WHERE prstatus LIKE 'APPROVED'");
$values = mysqli_fetch_assoc($query);
$prApproved = $values['prApproved'];

$query = $dbcon->query("SELECT count(id) as prPending FROM paymentrequests WHERE prstatus LIKE 'PENDING'");
$values = mysqli_fetch_assoc($query);
$prPending = $values['prPending'];

$query = $dbcon->query("SELECT count(id) as poVoucher FROM purchaseorder WHERE postatus LIKE 'APPROVED' AND ponumber NOT IN (SELECT voucheridentifier FROM vouchers)");
$values = mysqli_fetch_assoc($query);
$poVoucher = $values['poVoucher'];

$query = $dbcon->query("SELECT count(id) as brVoucher FROM budgetrequests WHERE brstatus LIKE 'APPROVED' AND brno NOT IN (SELECT voucheridentifier FROM vouchers)");
$values = mysqli_fetch_assoc($query);
$brVoucher = $values['brVoucher'];

$query = $dbcon->query("SELECT count(id) as prVoucher FROM paymentrequests WHERE prstatus LIKE 'APPROVED' AND prno NOT IN (SELECT voucheridentifier FROM vouchers)");
$values = mysqli_fetch_assoc($query);
$prVoucher = $values['prVoucher'];

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

     <title>HP Ventures Inc. | Accounts Payable System | </title>
      <link rel="shortcut icon" href="../images/HeaderLogo.png">
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  -->
      <script src="/HPV/documentation/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="/HPV/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/HPV/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/HPV/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="/HPV/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/HPV/build/css/custom.min.css" rel="stylesheet">
      <link href="/HPV/build/css/added_style.css" rel="stylesheet">
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

            <!-- menu profile quick info -->
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
            <!-- /menu profile quick info -->

            <br />

              <!-- sidebar menu -->
              <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                  <div class="menu_section">
                      <ul class="nav side-menu">
                          <li  ><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
                          <li><a> <i class="fa fa-money"></i> Purchase Order <span class="fa fa-chevron-down"></span> </a>
                              <ul class="nav child_menu">
                                  <li><a href="po_approved.php">Approved <span class="badge bg-green pull-right"><?php echo
                                              $numofAppr ?>
                                  </span></a></li>
                                  <li><a href="po_pending.php">Pending <span class="badge bg-red pull-right"><?php echo
                                              $numofPending ?>
                                  </span></a></li>

                              </ul>
                          </li>
                          <li><a> <i class="fa fa-briefcase"></i>Budget Request <span class="fa fa-chevron-down"> </a>
                              <ul class="nav child_menu">
                                  <li><a href="budgetrequestform.php">Create</a></li>
                                  <li><a href="br-approved.php">Approved <span class="badge bg-green pull-right"><?php echo
                                              $brApproved ?>
                                  </span></a></li>
                                  <li><a href="br-pending.php">Pending <span class="badge bg-red pull-right"><?php echo
                                              $brPending ?>
                                  </span></a></li>

                              </ul>
                          </li>
                          <li><a> <i class="fa fa-credit-card"></i>Payment Request <span class="fa fa-chevron-down"> </a>
                              <ul class="nav child_menu">
                                  <li><a href="paymentrequestform.php">Create</a></li>
                                  <li><a href="pr-approved.php">Approved <span class="badge bg-green pull-right"><?php echo
                                              $prApproved ?>
                                  </span></a></li>
                                  <li><a href="pr-pending.php">Pending <span class="badge bg-red pull-right"><?php echo
                                              $prPending ?>
                                  </span></a></li>

                              </ul>
                          </li>
                          <li><a><i class="fa fa-sitemap"></i> Overheads <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                  <li ><a href="viewoverheads.php">View Overheads<span class="badge bg-green pull-right"><?php echo $numOverheads ?>
                                  </span></a></li>
                                  <li ><a href="rentals.php">Rentals</a></li>
                                  <li ><a href="communication.php">Communication</a></li>
                                  <li ><a href="supplier.php">Supplier</a></li>
                                  <li ><a href="electric.php">Electric</a></li>
                                  <li ><a href="services.php">Services</a></li>
                                  <li ><a href="creditcard.php">Credit Card</a></li>
                                  <li ><a href="searesidence.php">SEA Residence</a></li>
                              </ul>
                          </li>
                          <li><a><i class="fa fa-barcode"></i> Vouchers <span class="fa fa-chevron-down">  </span> </a>
                              <ul class="nav child_menu">
                                  <li><a href="view_voucher.php">View Voucher<span class="badge bg-green pull-right"><?php echo $numVouchers ?>
                                  </span></a></li>
                                  <li><a href="po_vouchers.php">Purchase Order<span class="badge bg-green pull-right"><?php echo $poVoucher ?>
                                  </span></a></li>
                                  <li><a href="br_vouchers.php">Budget Request<span class="badge bg-green pull-right"><?php echo $brVoucher ?>
                                  </span></a></li>
                                  <li><a href="pr_vouchers.php">Payment Request<span class="badge bg-green pull-right"><?php echo $prVoucher ?>
                                  </span></a></li>
                                  <li><a href="oh_vouchers.php">Overheads<span class="badge bg-green pull-right"><?php echo $prVoucher ?>
                                  </span></a></li>
                              </ul>
                          </li>
                          <li><a> <i class="fa fa-bar-chart"></i> Reports <span class="fa fa-chevron-down"></span> </a>
                              <ul class="nav child_menu">
                                  <li><a href="general_reports.php">General Reports </a></li>
                                  <li><a href="specific_reports.php">Specific Reports </a></li>
                                  <li><a href="payables.php">Payables </a></li>
                                  <li><a href="paid_account.php">Paid Accounts </a></li>
                                  <li><a href="due_account.php">Due Accounts </a></li>
                                  <li><a href="overdue_account.php">Overdue Accounts</a></li>
                              </ul>
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
                    <?php echo '<img src="'.$_SESSION['empimage'].'">' ?><?php echo $_SESSION['empfname']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                   
                   
                    <li><a href="/HPV/logout.php?logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

              
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
          <!--CONTACT PERSON SCRIPT-->
          <script>
              $(document).ready(function(e){
                  //variables[
                  var html= '  <div class="container "> <div class="col-md-3 col-sm-3 col-xs-9" id="added"> <input type="text" class=" form-control" id="invoiceno" name="invoiceno[]" placeholder="Invoice #" required> </div> <div class="col-md-5 col-sm-5 col-xs-9"  id="added"> <input type="text" class="form-control " id="description" name="description[]" placeholder="Description" required> </div> <div class="col-md-3 col-sm-3  col-xs-9"  id="added"> <input type="number" class=" form-control " id="amount" name="amount[]" placeholder="Amount" required> </div> <div class="col-md-1 col-sm-1 col-xs-9" id="added"> <a id= "remove" name="remove" type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove" ></span></a> </div> </div>  ';

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



                  });
              });

          </script>
          <!--CONTACT PERSON SCRIPT END-->
          <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Purchase Order Vouchers</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form class="form-horizontal form-label-left " method="POST" id="CreatePOVoucherForm" name="CreatePOVoucherForm" action="insert_data/insert-povoucher.php">
                      
                        
                        <div class=" form-group has-feedback">
                        <label class="control-label col-md-1 col-sm-2 col-xs-9">PO#:</label>
                        <div class="col-md-3 col-sm-3 col-xs-9">
                         <select id="ponumber" name="ponumber" class="selectpicker form-control" required >
                                                                  <option value="" selected>Please select PO number.</option>
                                                                    
                                                                  <?php

                                                                    if($sql5->num_rows > 0) {
                                                                        while($po = $sql5->fetch_assoc()) {
                                                                            ?>
                                                                            <option value="<?php echo $po['ponumber'] ?>"> <?php echo $po['ponumber'] ?> </option>

                                                                            <?php
                                                                        }
                                                                    }
                                                                  ?>
                          </select>
                        </div>
                         <label class="control-label col-md-1 col-sm-2 col-xs-9">Type:</label>
                          <div class="col-md-3 col-sm-3 col-xs-9">
                         <select id="type" name="type" class="selectpicker form-control" required >
                                                                  <option value="" selected>Please select type.</option>
                           <option value="CASH">Cash</option>
                           <option value="CHECK">Check</option>
                                                                    
                                                                  
                          </select>
                        </div>
                            <label style="display: none" id="methodLabel" class="control-label col-md-1 col-sm-2 col-xs-9">Method:</label>
                            <div style="display: none" id="methodDiv" class="col-md-3 col-sm-3 col-xs-9">
                                <select id="method" name="methodSelect" class="selectpicker form-control">
                                    <option value="" selected>Please select method of paying</option>
                                    <option value="otp">On date payment</option>
                                    <option value="pdc">Post dated check</option>
                                </select>
                            </div>

                      </div>
                        
                        <div class=" form-group has-feedback">
                          
                          
                         <div style="display: none" id="checkDiv" class="control-label col-md-4 col-sm-4 col-xs-9 col-md-offset-7 col-sm-offset-4"> <h3> CHECK VOUCHER </h3></div>
                          <div style="display: none" id="cashDiv" class="control-label col-md-4 col-sm-4 col-xs-9 col-md-offset-7 col-sm-offset-4"> <h3> CASH VOUCHER </h3></div>
                          

                      </div>
                        
                        <div class="ln_solid"></div>
                        
                      <div class=" form-group has-feedback">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">CHARGE TO:</label>
                        <div class="col-md-4 col-sm-4 col-xs-9">
                         <input id="voucherComp" name="voucherComp" type="text" class="form-control" placeholder="Default Input" readonly>
                        </div>
                         <label class="control-label col-md-2 col-sm-2 col-xs-9">NO:</label>
                          <div class="col-md-3 col-sm-3 col-xs-9">
                         <input id="voucherNo" name="voucherNo" type="text" class="form-control" value="<?php echo $VoucherCode ?>" readonly>
                        </div>

                      </div>
                        
                         <div class=" form-group has-feedback">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">PAY TO:</label>
                        <div class="col-md-4 col-sm-4 col-xs-9">
                         <input id="voucherClient" name="voucherClient" type="text" class="form-control" placeholder="Default Input" readonly>
                        </div>
                         <label class="control-label col-md-2 col-sm-2 col-xs-9">DATE:</label>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                              
                                <input type="text" class="form-control" id="single_cal1" name="single_call" value="<?php echo date('M j, Y') ?>" readonly>

                              </div> 

                      </div>
                        
                          <div class=" form-group has-feedback">
                        
                         <label class="control-label col-md-2 col-sm-2 col-xs-9">ADDRESS:</label>
                          <div class="col-md-4 col-sm-4 col-xs-9">
                         <input id="voucherAddr" name="voucherAddr" type="text" class="form-control" placeholder="Default Input" readonly>
                        </div>

                              <label class="control-label col-md-2 col-sm-2 col-xs-9">REFERENCE NO:</label>
                              <div class="col-md-3 col-sm-3 col-xs-12">

                                  <input type="text" class="form-control" id="refno" name="refno">

                              </div>

                          </div>

                          <div class="ln_solid"></div>
                          <div class="form-group ">

                              <div class="col-md-3 col-sm-3  col-xs-9">
                                  <h2 >INVOICE NO.</h2>
                              </div>



                              <div class="col-md-5 col-sm-5 col-xs-9 ">
                                  <h2  >DESCRIPTION / PARTICULAR</h2>
                              </div>



                              <div class="col-md-3 col-sm-3 col-xs-9">
                                  <h2 >AMOUNT</h2>
                              </div>

                          </div>


                         <div class="ln_solid"></div>


                          <div class="container">
                              <div id="Result">

                              </div>
                          </div>
                          <!--container end-->
                          <div class="ln_solid"></div>

                          <div class=" form-group has-feedback">
                              <div id="tempLabel" class="control-label col-md-2 col-sm-2 col-xs-12"></div>
                              <div style="display: none" id="checkLabel" class="control-label col-md-2 col-sm-2 col-xs-12">CHECK #</div>
                              <div style="display: none" id="givesLabel" class="control-label col-md-2 col-sm-2 col-xs-12">GIVES</div>
                              <div style="display: none" id="cashLabel" class="control-label col-md-2 col-sm-2 col-xs-12">CASH</div>
                              <div style="display: none" id="inputLabel" class="col-md-4 col-sm-4 col-xs-9">
                                  <input id="voucherType" name="voucherType" type="text" class="form-control" placeholder="Default Input">
                              </div>
                              <div style="display: none" id="givesLABEL" class="col-md-4 col-sm-4 col-xs-9">
                                  <input id="gives" name="gives" type="text" class="form-control" placeholder="Default Input">
                              </div>
                              <div style="display: none" id="givesDiv" class="col-md-1 col-sm-1 col-xs-9">
                                  <a id= "add2" name="add2" type="button" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-plus"></span></a>
                                  <a id= "clear" name="clear" type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                              </div>
                              <label class="control-label col-md-2 col-sm-2 col-xs-9">PREPARED BY:</label>
                              <div class="col-md-3 col-sm-3 col-xs-12">
                                  <input type="text" class="form-control" id="voucherPreparedBy" name="voucherPreparedBy" value="<?php echo $_SESSION['empfname']; echo " "; echo $_SESSION['emplname']; ?>" readonly>

                              </div>

                          </div>



                          <div id="container2">
                              <div class="container2">
                              </div>
                          </div>


                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						   <button id="reset"class="btn btn-danger" type="reset">Reset</button>
                           <button type="submit" id="insert" class="btn btn-success pull-right">Create</button>
                        </div> 
                      </div>


                    </form>
                  </div>
                </div>
              </div>
            </div>
            
            
          </div>
        </div>
        <!-- /page content -->
          <!-- footer content -->
        <footer>
           <div class="col-md-6 col-md-offset-3">
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
    <!-- validator -->
    <script src="/HPV/vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- NProgress -->
    <script src="/HPV/vendors/nprogress/nprogress.js"></script>
    <!-- Datatables -->
    <script src="/HPV/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/HPV/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="/HPV/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/HPV/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="/HPV/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="/HPV/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/HPV/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/HPV/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="/HPV/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="/HPV/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/HPV/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="/HPV/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="/HPV/vendors/jszip/dist/jszip.min.js"></script>
    <script src="/HPV/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="/HPV/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="/HPV/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="/HPV/build/js/custom.min.js"></script>
    <!--<script src="../Accounting/insert_data/insert-povoucher.js"></script>-->
    <script>
        $(document).ready(function(){
            $('#ponumber').change(function(){
                var po_number = $(this).val();
                $.ajax({
                    url:"../Accounting/update_data/view-voucherdetails.php",
                    method:"POST",
                    data:{po_number:po_number},
                    success:function(data){
                        $('#Result').html(data);
                    }
                });
            });
        });
    </script>
    <script>
         $(document).ready(function(e){

          $('#ponumber').change (function(){
                                var po_number = $(this).val();

                                    $.ajax({
                                      url:"../Accounting/update_data/fetch-po.php",
                                      method:"POST",
                                      data:{po_number:po_number},
                                      dataType:"json",
                                      success:function(data){
                                        $('#voucherComp').val(data.compname);
                                        $('#voucherClient').val(data.clientname);
                                        $('#voucherAddr').val(data.clientaddr);
                                      }
                                    });
                                  });
              });
      
          
      </script>
    <script>
                             $(document).ready(function(e){
                                 $('#type').change (function(){
                                   var type = $(this).val();
                                   if(type == "CHECK") {
                                          $("#checkDiv").show();
                                          $("#checkLabel").show();
                                          $("#tempLabel").hide();
                                          $("#cashLabel").hide();
                                          $("#cashDiv").hide();
                                          $("#methodLabel").show();
                                          $("#methodDiv").show();
                                   }
                                   if(type == "CASH") {
                                          $("#cashDiv").show();
                                          $("#cashLabel").show();
                                          $("#tempLabel").hide();
                                          $("#checkLabel").hide();
                                          $('#checkDiv').hide();
                                           $("#methodLabel").hide();
                                           $("#methodDiv").hide();
                                           $("#inputLabel").show();
                                           $("#givesLabel").hide();
                                           $("#givesLABEL").hide();
                                           $("#givesDiv").hide();
                                   }
                                      });

                                   $('#reset').click (function(){
                                   var type = $(this).val();
                                       var number = $('#gives').val();
                                           $("#cashDiv").hide();
                                           $('#checkDiv').hide();
                                           $("#cashLabel").hide();
                                           $("#checkLabel").hide();
                                           $("#methodLabel").hide();
                                           $("#methodDiv").hide();
                                           $("#inputLabel").hide();
                                           $("#givesLabel").hide();
                                           $("#givesLABEL").hide();
                                           $("#givesDiv").hide();
                                       for (var i = 0; i < number; i++) {
                                           $('#added').last().remove();
                                           $('#added').last().remove();
                                           $('#added').last().remove();
                                           $('#added').last().remove();
                                           $('#added').last().remove();
                                       }

                                      });

                                   $('#method').change (function() {
                                       var type = $(this).val();
                                       if(type == "otp") {
                                           $("#inputLabel").show();
                                           $("#checkLabel").show();
                                           $('#checkDiv').show();
                                           $("#givesLABEL").hide();
                                           $("#givesLabel").hide();
                                           $("#givesDiv").hide();
                                       }
                                       if(type == "pdc") {
                                           $("#methodLabel").show();
                                           $("#methodDiv").show();
                                           $("#givesLABEL").show();
                                           $("#givesDiv").show();
                                           $("#givesLabel").show();
                                           $("#cashDiv").hide();
                                           $("#cashLabel").hide();
                                           $("#checkLabel").hide();
                                           $('#checkDiv').show();
                                           $("#inputLabel").hide();
                                       }
                                   });



                              });
                          </script>
                          <script>
                              $(document).ready(function(e) {

                                  var html = '<div class="container2"> <div class="col-md-3 col-sm-3 col-xs-9" id="added"> <input type="text" class=" form-control" id="checkno" name="checkno[]" placeholder="Check #" required> </div> <div class="col-md-4 col-sm-4 col-xs-9"  id="added"> <input type="text" class="form-control " id="bank" name="bank[]" placeholder="Bank Name" required> </div> <div class="col-md-2 col-sm-2  col-xs-9"  id="added"> <input type="date" class=" form-control " id="date" name="date[]" placeholder="Date" required> </div> <div class="col-md-2 col-sm-2 col-xs-9" id="added"> <input type="number" class=" form-control " id="Amount" name="Amount[]" placeholder="Amount" required> </div> </div>';
                                  $("#add2").click(function (e) {
                                      var number = $('#gives').val();
                                      $("#container2").text('');
                                      for (var i = 0; i < number; i++) {
                                          $("#container2").append(html);
                                      }

                                  });
                                  $("#clear").click(function (e) {
                                      var number = $('#gives').val();
                                      for (var i = 0; i < number; i++) {
                                          $('#added').last().remove();
                                          $('#added').last().remove();
                                          $('#added').last().remove();
                                          $('#added').last().remove();
                                          $('#added').last().remove();
                                      }
                                  })
                              });
                          </script>
  </body>
</html>
