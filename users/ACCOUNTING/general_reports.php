<?php
session_start();
include_once "../../dbconnect.php";

//if (!isset($_SESSION['adminSession']))
if($_SESSION['emplevel'] != 'Accounting'){
    header ('Location: /HPV/login.php');

}
$i = 0;
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

    <!-- Datatables -->
    <link href="/HPV/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
                                <h2>General Reports</h2>
                                <div class="col-md-3" >
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div style="padding-left: 425px">
                                <div id="ErrDiv"  class="alert alert-danger text-center alert-dismissible fade in"
                                     role="alert" style="width:200px; display:none; text-align: center" > <p style="color:#fff; font-size:120%; text-align:center" id="UpdateMessage">Input all fields</p>
                                </div>
                            </div>
                            <form class="form-horizontal form-label-left" method="post" action="update_data/viewgeneralreports.php">

                                <div class="form-group has-feedback">
                                    <label class="textsize control-label col-md-1 col-sm-2 col-xs-9 ">Company:</label >
                                    <div class="col-md-3 col-sm-4 col-xs-9">
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
                                               for="compBranch">Year:
                                        </label>
                                        <div class="col-md-3 col-sm-4 col-xs-9">
                                            <select name="year" id="year" class="selectpicker form-control" required>
                                                <option value="" selected>Please select year.</option>
                                                <?php
                                                for($i = date('Y'); $i >= 2015; $i--){
                                                ?>
                                                    <option value="<?php echo $i ?>"> <?php echo $i ?> </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="item form-group">
                                            <div class="col-md-2 col-sm-4 col-xs-9 col-md-offset-1">
                                                <a type="submit" id="edit" class="btn btn-primary btn-md edit_data">  View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="x_content">
                                    <div id="Result" >

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
</body>
</html>

<script>
    $(document).ready(function(){
        $(document).on('click', '.edit_data', function(ev){
            ev.preventDefault();
            var company_code = $('#company').val();
            var year_code = $('#year').val();
            if(company_code != "" && year_code != "") {
                $.ajax({
                    url:"../ACCOUNTING/update_data/viewgeneralreports.php",
                    method:"POST",
                    data:{'company_code':company_code, 'year_code':year_code},
                    success:function(data){
                        $('#Result').html(data);
                    }
                });
            }
            else {
                $("#ErrDiv").show();
                setTimeout(function(){
                    location.reload();
                }, 1000);
            }
        });
    });

</script>