<?php
session_start();
include_once "../../dbconnect.php";

//if (!isset($_SESSION['adminSession']))
if($_SESSION['emplevel'] != 'Accounting'){
    header ('Location: /HPV/login.php');

}

$companyRows = $dbcon->query("SELECT * FROM companies");
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
    <link href="/HPV/build/css/added_style.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="home.php" class="site_title"><img src="../images/HeaderLogo.png"><img src="../images/APsystemHeader.png"></a>
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
                                <?php echo '<img src="'.$_SESSION['empimage'].'">' ?> <?php echo $_SESSION['empfname']; ?>
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

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Supplier</h2>
                                <div class="col-md-3" >
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <form class="form-horizontal form-label-left " method="POST" id="overheadform"
                                  name="overheadform" action="insert_data/insert-overheads.php">


                                    <label class="textsize control-label col-md-2 col-sm-2 col-xs-9 ">Company:</label >
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <select id="company" name="company" class="selectpicker form-control" required >
                                            <option value="" selected>Please select company.</option>

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
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-9"
                                               for="compBranch">Branch
                                        </label>
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <select id="compBranch" name="compBranch" class="selectpicker form-control"required >
                                                <option value="">Please select a branch.</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-9">Address:</label>
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <input  readonly id="companyAddr" name="companyAddr" type="text" class="form-control has-feedback-left" placeholder="Address" required>
                                            <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                                        </div>

                                        <label class="textsize control-label col-md-2 col-sm-2 col-xs-9 ">Date:</label>
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <input readonly type="text" class="form-control has-feedback-left" name ="date" id="date" value ="<?php echo date('M j, Y');?>"  required >
                                            <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                        </div>

                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-9">Tel #:</label>
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <input  readonly id="companyTelNo" name="companyTelNo" type="text" class="form-control has-feedback-left" placeholder="Telephone Number" required>
                                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                        </div>

                                        <label class="control-label col-md-2 col-sm-2 col-xs-9">Fax #:</label>
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <input  readonly id="companyFaxNo" name="companyFaxNo" type="text"
                                                    class="form-control has-feedback-left" placeholder="Fax Number"
                                                    required>
                                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>


                                    <div class="ln_solid"></div>
                                    <div class="form-group ">

                                        <div class="col-md-2 col-sm-3  col-xs-9">
                                            <h2 >BUSINESS NAME</h2>
                                        </div>



                                        <div class="col-md-3 col-sm-3 col-xs-9 ">
                                            <h2  >ADDRESS</h2>
                                        </div>



                                        <div class="col-md-3 col-sm-3 col-xs-9">
                                            <h2 >CONTACT DETAILS</h2>
                                        </div>

                                        <div class="col-md-2 col-sm-3 col-xs-9">
                                            <h2 >DUE DATE</h2>
                                        </div>

                                        <div class="col-md-2 col-sm-3 col-xs-9">
                                            <h2 >AMOUNT</h2>
                                        </div>

                                    </div>


                                    <div class="ln_solid"></div>


                                    <div id="container">
                                        <div class="container ">
                                            <div class="col-md-2 col-sm-3 col-xs-9">
                                                <input type="text" class=" form-control" id="businessname"
                                                       name="businessname[]" placeholder="Business Name" required>
                                            </div>

                                            <div class="col-md-3 col-sm-3 col-xs-9">
                                                <input type="text" class=" form-control" id="address"
                                                       name="address[]" placeholder="Address" required>
                                            </div>

                                            <div class="col-md-3 col-sm-3  col-xs-9">
                                                <input type="number" class=" form-control " id="contactdetails"
                                                       name="contactdetails[]" placeholder="Contact Details" required>
                                            </div>

                                            <div class="col-md-2 col-sm-2 col-xs-9">
                                                <input type="text" class="form-control " id="duedate" name="duedate[]" placeholder="Due date" required>
                                            </div>

                                            <div class="col-md-2 col-sm-3  col-xs-9">
                                                <input type="number" class=" form-control " step="any" id="amount"
                                                       name="amount[]" placeholder="Amount" required>
                                            </div>



                                        </div>
                                    </div>
                                    <!--container end-->
                                    <div class="ln_solid"></div>


                                    <div class=" form-group has-feedback">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-9">Prepared by:</label>
                                        <div class="col-md-3 col-sm-3 col-xs-12">

                                            <input type="text" class="form-control has-feedback-left" id="preparedBy" name="preparedBy" value="<?php echo $_SESSION['empfname']; echo " "; echo $_SESSION['emplname'] ?>" readonly>

                                        </div>
                                    </div>
                                <div class="col-md-4 col-sm-4 col-xs-9">
                                    <input  style="display: none;" id="overheadtype" name="overheadtype"
                                            type="text" value="Supplier">
                                </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button id="reset"class="btn btn-danger" type="reset">Reset</button>
                                            <button type="submit" name="create" id="create" class="btn btn-success pull-right">Create</button>
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
<!-- NProgress -->
<script src="/HPV/vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="/HPV/vendors/Chart.js/dist/Chart.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="/HPV/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- gauge.js -->
<script src="/HPV/vendors/gauge.js/dist/gauge.min.js"></script>
<!-- iCheck -->
<script src="/HPV/vendors/iCheck/icheck.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="/HPV/vendors/moment/min/moment.min.js"></script>
<script src="/HPV/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Skycons -->
<script src="/HPV/vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="/HPV/vendors/Flot/jquery.flot.js"></script>
<script src="/HPV/vendors/Flot/jquery.flot.pie.js"></script>
<script src="/HPV/vendors/Flot/jquery.flot.time.js"></script>
<script src="/HPV/vendors/Flot/jquery.flot.stack.js"></script>
<script src="/HPV/vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="/HPV/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="/HPV/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="/HPV/vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="/HPV/vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="/HPV/vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="/HPV/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="/HPV/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstradaterangepicker -->
<script src="/HPV/vendors/moment/min/moment.min.js"></script>
<script src="/HPV/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/HPV/vendors/validator/validator.js"></script>
<!-- Custom Theme Scripts -->
<script src="/HPV/build/js/custom.min.js"></script>

<script>
    $(document).ready(function(e){
        $('#compBranch').change (function(){
            var comp_code = $(this).val();

            $.ajax({
                url:"../ACCOUNTING/fetch_data/fetch_info.php",
                method:"POST",
                data:{comp_code:comp_code},
                dataType:"json",
                success:function(data){
                    $('#companyAddr').val(data.branchaddr);
                    $('#companyTelNo').val(data.branchtelno);
                    $('#companyFaxNo').val(data.branchfaxno);


                }
            });

        });

    });

</script>

<script>
    $(document).ready(function(){


        $('#company').change (function(){
            var comp_code = $(this).val();
            $.ajax({
                url:"../ACCOUNTING/fetch_data/fetch_branch.php",
                method:"POST",
                data:{comp_code:comp_code},
                dataType:"text",
                success:function(data){
                    $('#compBranch').html(data);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function(e){
        /*calculate AMOUNT start*/
        $("#unitprice").keyup(function(){
            var price = Number($(this).val());
            var quantity = Number ($("#quantity").val());
            var total = price * quantity;
            $("#amount").val(total);
        });

        $("#quantity").keyup(function(){
            var quantity = Number($(this).val());
            var price = Number ($("#unitprice").val());
            var total = price * quantity;
            $("#amount").val(total);
        });
        /*calculater AMOUNT end*/


        //variables
        var html= ' <div class="container "> <div class="col-md-3 col-sm-3 col-xs-9" id= "added"> <input type="text" class="form-control" id="businessname"name="businessname[]" placeholder="Business Name" required> </div> <div class="col-md-3 col-sm-3 col-xs-9" id= "added"> <input type="text" class=" form-control" id="address"name="address[]" placeholder="Address" required> </div> <div class="col-md-2 col-sm-2 col-xs-9" id= "added"> <input type="number" class=" form-control "id="contactdetails"name="contactdetails[]" placeholder="Contact Details" required> </div> <div class="col-md-2 col-sm-2 col-xs-9" id= "added"> <input type="text" class="form-control " id="duedate" name="duedate[]" placeholder="Due date" required> </div> <div class="col-md-1 col-sm-1 col-xs-9" id= "added"> <a id= "remove" name="remove" type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-minus"></span></a> </div> </div>';

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

    });
</script>
</body>
</html>
