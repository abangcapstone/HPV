<?php
session_start();
include_once "../../dbconnect.php";

//if (!isset($_SESSION['adminSession']))
if($_SESSION['emplevel'] != 'Accounting'){
    header ('Location: /HPV/login.php');
}

$query = $dbcon->query("SELECT count(*) as total FROM users");
$values = mysqli_fetch_assoc($query);
$numUsers = $values['total'];

$query = $dbcon->query("SELECT * FROM users");
$users = mysqli_fetch_object($query);

$result = $dbcon->query("SELECT * FROM users");
$result1 = $dbcon->query("SELECT * FROM users");

$query = $dbcon->query("SELECT count(id) as total FROM clients");
$values = mysqli_fetch_assoc($query);
$numClients = $values['total'];

$query = $dbcon->query("SELECT count(id) as total FROM companies");
$values = mysqli_fetch_assoc($query);
$numComp = $values['total'];

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

$result1 = $dbcon->query("SELECT * FROM overheads oh  JOIN  overheaddetails ohd ON oh.overheadcode = overheaddetailscode WHERE (ohdaysrem BETWEEN 1 AND 3)   ");
$result2 = $dbcon->query("SELECT * FROM  purchaseorder po  JOIN podetails pod ON po.ponumber = pod.poitemcode  WHERE (podaysrem BETWEEN 1 AND 3) AND postatus = 'APPROVED' ");
$payables = $result1->num_rows + $result2->num_rows;

$result3 = $dbcon->query("SELECT * FROM overheads oh  JOIN  overheaddetails ohd ON oh.overheadcode = overheaddetailscode WHERE overheadstatus = 'OVERDUE'");
$result4 = $dbcon->query("SELECT * FROM  purchaseorder po  JOIN podetails pod ON po.ponumber = pod.poitemcode JOIN clients c ON po.poclient = clientcode  WHERE popaymentstatus = 'OVERDUE'");
$overdues = $result3->num_rows + $result4->num_rows;

$result5 = $dbcon->query("SELECT * FROM overheads oh  JOIN  overheaddetails ohd ON oh.overheadcode = overheaddetailscode WHERE overheadstatus = 'DUE'");
$result6 = $dbcon->query("SELECT * FROM  purchaseorder po  JOIN podetails pod ON po.ponumber = pod.poitemcode  WHERE popaymentstatus = 'DUE' ");
$dues = $result5->num_rows + $result6->num_rows;

$result7 = $dbcon->query("SELECT * FROM budgetrequests WHERE brstatus = 'PENDING' ");
$result9 = $dbcon->query("SELECT * FROM paymentrequests WHERE prstatus = 'PENDING' ");
$result8 = $dbcon->query("SELECT * FROM purchaseorder po  JOIN podetails pod ON po.ponumber = pod.poitemcode WHERE postatus = 'PENDING' ");
$pendings = $result7->num_rows + $result8->num_rows + $result9->num_rows;

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

    <!-- bootstrap-progressbar -->
    <link href="/HPV/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="/HPV/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="/HPV/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/HPV/build/css/custom.min.css" rel="stylesheet">
    <link href="/HPV/build/css/added_style.css" rel="stylesheet">


</head>

<body class="nav-md">

<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col ">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="home.php" class="site_title"><img src="../images/HeaderLogo.png"><img src="../images/APsystemHeader.png"></a>
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
                            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
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
                                    <li ><a href="viewoverheads.php">View Overheads</a></li>
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
                                    <li><a href="view_voucher.php">View Voucher</a></li>
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
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-spin fa-circle-o-notch"></i> Activities</a>
                            <ul class="dropdown-menu scrollable-menu"  role="menu">
                                <li><a href="#">Create Budget Request</a>
                                </li>
                                <li><a href="#">Create Payment Request</a>
                                </li>
                                <li><a href="#">View Purchase Order</a>
                                </li>
                                <li><a href="#">View Reports</a>
                                </li>
                                <li><a href="#">View Purchase Order</a>
                                </li>
                                <li><a href="#">View Reports</a>
                                </li>
                                <li><a href="#">View Purchase Order</a>
                                </li>
                                <li><a href="#">View Reports</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel" style="height: 100%;">
                        <div class="x_title">
                            <h2>User Profile</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <?php echo '<img src="'.$_SESSION['empimage'].'" alt="Avatar" class="img-responsive avatar-view">' ?>
                                    </div>
                                </div>
                                <h3> <?php echo $_SESSION['empfname'].' '.$_SESSION['emplname']; ?></h3>

                                <ul class="list-unstyled user_data">
                                    <li><i class="fa fa-building user-profile-icon"></i> <?php echo ' '.$_SESSION['empcompany']; ?>
                                    </li>

                                    <li>
                                        <i class="fa fa-briefcase user-profile-icon"></i><?php echo ' '.$_SESSION['emppos']; ?>
                                    </li>

                                    <li class="m-top-xs">
                                        <i class="fa fa-envelope-o user-profile-icon"></i>
                                        <a href="http://www.kimlabs.com/profile/"><?php echo ' '.$_SESSION['empemail']; ?></a>
                                    </li>
                                </ul>



                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                        <li role="presentation" class=""><a href="#tab_changepassword" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Change Password</a>
                                        </li>

                                    </ul>
                                    <div id="myTabContent" class="tab-content">

                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_changepassword" aria-labelledby="profile-tab" style="height:600px">

                                            <div>

                                                <form class="form-horizontal form-label-left" method="post" id="ChangePasswordForm" data-parsley-validate>

                                                    <div id="Notification" class="alert alert-success text-center alert-dismissible fade in" role="alert" style="width:200px; margin:0 auto; margin-bottom:5px; display:none" > <p style="color:#fff; font-size:120%; text-align:center" id="Message"></p>
                                                    </div>
                                                    <div class="item form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1" for="currentPassword">Current Password
                                                        </label>
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <input id="curr_pass" name="curr_pass" class="form-control col-md-4 col-xs-12" data-validate-length-range="6" type="password">
                                                        </div>
                                                    </div>

                                                    <div class="item form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1" for="newPassword">New Password <span class="required"></span>
                                                        </label>
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <input id="password" name="password" class="form-control col-md-4 col-xs-12" data-validate-length-range="6" required="required" type="password">
                                                        </div>
                                                    </div>

                                                    <div class="item form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1" for="newPassword1">Confirm Password <span class="required"></span>
                                                        </label>
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <input id="confirm_password" name="confirm_password" class="form-control col-md-4 col-xs-12" data-validate-length-range="6" required="required" type="password">
                                                        </div>
                                                        <span id='message'></span>
                                                    </div>




                                                    <div class="modal-footer">

                                                        <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-6 col-sm-offet-6" >
                                                            <button name="change_password" id="change_password" type="submit" class="btn btn-success" disabled>
                                                                Change
                                                            </button>

                                                        </div>

                                                    </div>



                                                </form>



                                            </div>


                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer content -->

    </div>

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
<!-- Chart.js -->
<script src="/HPV/vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="/HPV/vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="/HPV/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="/HPV/vendors/iCheck/icheck.min.js"></script>
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



<script src="../../update-pass.js">


</script>



<script>
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()){
            if($('#password').val() != "" && $('#confirm_password').val()!="") {
                $('#message').removeClass("fa fa-close");
                $('#message').addClass("fa fa-check").css('color', 'green');
                $('#message').html('');

                $('#message').show();



                $('#change_password').removeAttr("disabled");
            }

            else if($('#password').val() == "" && $('#confirm_password').val()==""){
                $('#message').hide();
            }

        } else if($('#password').val() !="" && $('#confirm_password').val() !=""){
            $('#message').show();
            $('#message').html('Confirm Password does not match').css('color', 'red');
            $('#message').addClass("fa fa-close").css('color', 'red');
            $("#change_password").attr("disabled", true);
        }
    });
</script>





</body>
</html>



