<?php
session_start();
include_once "../../dbconnect.php";

//if (!isset($_SESSION['adminSession']))
if($_SESSION['emplevel'] != 'Accounting'){
    header ('Location: /HPV/login.php');
}
date_default_timezone_set('Asia/Manila');

$query = $dbcon->query("SELECT count(*) as total FROM users");
$values = mysqli_fetch_assoc($query);
$numUsers = $values['total'];

$query = $dbcon->query("SELECT * FROM users");
$users = mysqli_fetch_object($query);

$result = $dbcon->query("SELECT * FROM users");
$result1 = $dbcon->query("SELECT * FROM users");

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

$holiday = mysqli_query($dbcon, "SELECT * FROM calendar WHERE holidaystatus = 'AC'");

$result = $dbcon->query("SELECT * FROM purchaseorder po INNER JOIN companies ON compno = pocompany INNER JOIN  vouchers v ON po.ponumber = v.voucheridentifier INNER JOIN podelivery podl ON podl.pono = po.ponumber INNER JOIN clients c ON c.clientcode = po.poclient WHERE popaymentstatus !='OVERDUE' && popaymentstatus != 'DUE' && voucherpaymentstatus != 'PAID'");
$view = $dbcon->query ("SELECT * FROM overheads oh INNER JOIN companies ON oh.overheadcomp = compno INNER JOIN overheaddetails  ohd ON oh.overheadcode = ohd.overheaddetailscode INNER JOIN vouchers v ON oh.overheadcode = v.voucheridentifier WHERE  overheadstatus  != 'DUE' && overheadstatus != 'OVERDUE' && voucherpaymentstatus != 'PAID' ");
$result2 = $dbcon->query("SELECT * FROM purchaseorder po INNER JOIN podetails pod ON po.ponumber = pod.poitemcode INNER JOIN vouchers v ON po.ponumber = v.voucheridentifier INNER JOIN podelivery podl ON podl.pono = po.ponumber INNER JOIN clients c ON c.clientcode = po.poclient WHERE popaymentstatus != 'PAID'  && voucherstatus !='PAID'");

$result3 = $dbcon->query("SELECT * FROM purchaseorder po INNER JOIN companies ON compno = pocompany INNER JOIN vouchers v ON po.ponumber = v.voucheridentifier INNER JOIN podelivery podl ON podl.pono = po.ponumber INNER JOIN clients c ON c.clientcode = po.poclient WHERE popaymentstatus != 'PAID' && voucherpaymentstatus !='PAID'");
$view3= $dbcon->query ("SELECT * FROM overheads oh INNER JOIN companies ON oh.overheadcomp = compno INNER JOIN overheaddetails  ohd ON oh.overheadcode = ohd.overheaddetailscode INNER JOIN vouchers v ON oh.overheadcode = v.voucheridentifier WHERE  overheadstatus  != 'PAID' && voucherpaymentstatus != 'PAID' ");
$result4 = $dbcon->query("SELECT * FROM purchaseorder po INNER JOIN companies ON compno = pocompany INNER JOIN vouchers v ON po.ponumber = v.voucheridentifier INNER JOIN podelivery podl ON podl.pono = po.ponumber INNER JOIN clients c ON c.clientcode = po.poclient WHERE popaymentstatus = 'DUE' && voucherpaymentstatus !='PAID'");
$view4 = $dbcon->query ("SELECT * FROM overheads oh INNER JOIN companies ON oh.overheadcomp = compno INNER JOIN overheaddetails  ohd ON oh.overheadcode = ohd.overheaddetailscode INNER JOIN vouchers v ON oh.overheadcode = v.voucheridentifier WHERE  overheadstatus  = 'DUE' && voucherpaymentstatus != 'PAID' ");

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
    <!-- Datatables -->
    <link href="/HPV/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="dashboard_graph">
                        <div class="row x_title">
                            <div class="col-md-6">
                                <h3> Payables </h3>
                            </div>
                            <div style = "display:none" id ="auto">
                            </div>
                        </div>

                        <?php
                        function getWorkingDays($startDate,$endDate,$holidays){

                            $end = strtotime($endDate);
                            $start = strtotime($startDate);

                            $days = ($end - $start) / 86400 + 1;

                            $no_full_weeks = floor($days / 7);
                            $no_remaining_days = fmod($days, 7);

                            $the_first_day_of_week = date("N", $start);
                            $the_last_day_of_week = date("N", $end);

                            if ($the_first_day_of_week <= $the_last_day_of_week) {
                                if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
                            }
                            else {

                                if ($the_first_day_of_week == 7) {
                                    $no_remaining_days--;
                                }
                                else {
                                    $no_remaining_days -= 1;
                                }
                            }

                            $workingDays = $no_full_weeks * 6;
                            if ($no_remaining_days > 0 )
                            {
                                $workingDays += $no_remaining_days;
                            }
                            //if ($startDate <= $time_stamp && $time_stamp <= $endDate  && date("N",$time_stamp) != 7)
                            global $ctr2;
                            for($i = 0; $i<  $ctr2; $i++){
                                $time_stamp = $holidays[$i];
                                if ($startDate <= $time_stamp && $time_stamp <= $endDate)
                                    $workingDays--;
                            }
                            return $workingDays;
                        }
                        $year = date(', Y');
                        $holidaydays = array();
                        $holidaymonths  = array();
                        while($check2 = mysqli_fetch_array($holiday))
                        {
                            array_push($holidaydays,$check2['holidayDay']);
                            array_push($holidaymonths,$check2['holidayMonth']);
                        }
                        global $ctr2;
                        $ctr2 = count($holidaymonths);
                        $holidays = array();
                        for($i = 0; $i< $ctr2 ; $i++){
                            $day = date('Y').date('-m-',strtotime($holidaymonths[$i])). $holidaydays[$i].'<br>';
                            array_push($holidays,$day);
                        }
                        ?>
                        <div class="">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab_content1" id="current-tab" role="tab" data-toggle="tab" aria-expanded="true">Current AP</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="aging-tab" data-toggle="tab" aria-expanded="false">AP Aging</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="total-tab" data-toggle="tab" aria-expanded="false">Total AP</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content4" role="tab" id="due-tab" data-toggle="tab" aria-expanded="false">Due AP</a>
                                        </li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="current-tab">
                                            <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable-buttons" class="table table-striped table-bordered ">
                                                    <thead>
                                                    <tr>
                                                        <th>Identifier</th>
                                                        <th>Payor</th>
                                                        <th>Payee</th>
                                                        <th>Amount </th>
                                                        <th>Due in </th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $total = 0;
                                                    if($result->num_rows > 0) {
                                                        while($row = $result->fetch_object()) {
                                                            $total += $row->pototal;
                                                            ?>
                                                            <tr >
                                                                <td><?php echo $row->ponumber?> | Purchase Order</td>

                                                                <td><?php echo $row->compname?></td>
                                                                <td><?php echo $row->clientname?></td>

                                                                <td><?php echo 'PHP '.number_format($row->pototal,2,'.',',')?></td>

                                                                <?php
                                                                $dlvrdate = strtotime($row->podeliverydate);
                                                                echo 'DELIVER DATE: '. $dlvrdate;
                                                                $next_day = date('F j, Y',$dlvrdate);
                                                                $date = strtotime("+1 day", strtotime($next_day));
                                                                $next_day = date('F j, Y', $date);
                                                                $start_date = $next_day;
                                                                echo 'START DATE: '.$next_day. '<br>';
                                                                $terms = (int)$row->clientterms;
                                                                for($j = 0; $j<$ctr2; $j++) {
                                                                    $next_day = date('F j, Y',$dlvrdate);
                                                                    //echo ' terms : '. $terms;
                                                                    //echo ' J:'.$j. '<br>';
                                                                    for ($i = 0; $i < $terms; $i++) {
                                                                        $year = date(', Y');
                                                                        // echo ' HOLIDAY ' . $holidaymonths[$j] . $holidaydays[$j]. $year.'<br>';
                                                                        $date = strtotime("+1 day", strtotime($next_day));
                                                                        $next_day = date('F j, Y', $date);
                                                                        $sunday  = strtotime($next_day);

                                                                        if(strcmp(date('F j',strtotime($next_day)),"January 1") == 0){
                                                                            $year=date(', Y', strtotime('+1 year'));
                                                                            //echo 'NEW YEAR : '.$futureDate;
                                                                        }

                                                                        if (strcmp($next_day, $holidaymonths[$j] .' '. $holidaydays[$j] . $year) == 0) {
                                                                            $i--;
                                                                            //$terms += 1;
                                                                            // echo 'HOLIDAY : ' . $holidaymonths[$j].' '. $holidaydays[$j] . $year.'<br>';

                                                                        }
                                                                        else if(date ('l',$sunday) == 'Sunday'){
                                                                            $i--;
                                                                            //echo 'SUNDAY : '.date('F j, Y',$sunday).'<br>';
                                                                        }
                                                                        else
                                                                        {
                                                                            //echo ' NEXT DAY  '.$next_day.'<br>';
                                                                        }
                                                                    }
                                                                }
                                                                $end_date = date('Y-m-d',strtotime($next_day));
                                                                echo ' END DATE : '.$end_date.'<br>';
                                                                $today = date('Y-m-d');
                                                                // echo  'TODAY : ' . $today. '<br> ';
                                                                $daystildue = getWorkingDays($today, $end_date , $holidays);
                                                                ?>
                                                                <td><a class="btn btn-info btn-xs" > <?php echo $daystildue .' DAY(S)'?> </a></td>
                                                            </tr>

                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    if($view->num_rows > 0) {
                                                        while($row = $view->fetch_object()) {
                                                            $total += $row->overheadamount;
                                                            ?>
                                                            <tr role="row" class="odd">

                                                                <td> <?php echo $row->overheadcode ?> | Overhead | <?php echo $row->overheadtype ?></td>
                                                                <td><?php echo $row->overheadname ?> </td>
                                                                <td><?php echo $row->compname ?></td>
                                                                <td><?php echo number_format($row->overheadamount,2,'.',','); ?> </td>
                                                                <td><a class="btn btn-info btn-xs" > <?php echo $row->ohdaysrem.' DAY(S)' ?></a></td>

                                                            </tr>
                                                            <?php

                                                        }
                                                    }
                                                    ?>
                                                    <tr >
                                                        <td> </td>
                                                        <td> </td>
                                                        <td><h2>Total:</h2></td>
                                                        <td> <h2><?php echo 'PHP '.number_format($total,'2','.',',') ?></h2> </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="aging-tab">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable-buttons" class="table table-bordered">
                                                    <thead>
                                                    <tr>

                                                        <th>PO Number</th>
                                                        <th>Terms</th>
                                                        <th>Date Delivered</th>
                                                        <th>Amount </th>
                                                        <th>1 - 29 days</th>
                                                        <th>30 days</th>
                                                        <th>60 days</th>
                                                        <th>90 days</th>
                                                        <th>90 days or over</th>
                                                        <th>Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $total_1 = 0;
                                                    $total_30 = 0;
                                                    $total_60 = 0;
                                                    $total_90 = 0;
                                                    $total_more = 0;
                                                    if($result2->num_rows > 0) {
                                                        while($row = $result2->fetch_object()) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row->ponumber?></td>
                                                                <td><?php echo $row->clientterms?></td>
                                                                <td><?php echo $row->podeliverydate?></td>
                                                                <td><?php echo 'PHP'.number_format($row->pototal,2,'.',',')?></td>


                                                                <?php
                                                                $days = $row->podaysrem;
                                                                    if($days > 0){
                                                                        ?>
                                                                        <td> <?php echo 'PHP '.number_format($row->pototal,'2','.',',')?></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td> <a class ="btn btn-info btn-xs"> <?php echo 'Due in '. abs($days). ' day(s)' ?></a></td>
                                                                        <?php
                                                                        $total_1 += $row->pototal;
                                                                    }
                                                                    else if($days == 0 ){
                                                                        ?>
                                                                        <td></td>
                                                                        <td> <?php echo 'PHP '.number_format($row->pototal,'2','.',',')?></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td> <a class ="btn btn-danger btn-xs"> <?php echo 'Due today' ?></a></td>
                                                                        <?php
                                                                        $total_30 += $row->pototal;
                                                                    }

                                                                    else if($days < 0 && $days >= -59){
                                                                        ?>
                                                                        <td></td>
                                                                        <td> <?php echo 'PHP '.number_format($row->pototal,'2','.',',')?></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td> <a class ="btn btn-danger btn-xs"> <?php echo 'Overdue for '. abs($days). ' day(s)' ?></a></td>
                                                                        <?php
                                                                        $total_30 += $row->pototal;
                                                                    }
                                                                    else if($days <= -60 && $days >= -89){
                                                                        ?>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td> <?php echo 'PHP '.number_format($row->pototal,'2','.',',')?></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td> <a class ="btn btn-danger btn-xs"> <?php echo 'Overdue for '. abs($days). ' day(s)' ?></a></td>
                                                                        <?php
                                                                        $total_60 += $row->pototal;
                                                                    }
                                                                    else if($days == -90){
                                                                        ?>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td> <?php echo 'PHP '.number_format($row->pototal,'2','.',',')?></td>
                                                                        <td></td>
                                                                        <td> <a class ="btn btn-danger btn-xs"> <?php echo 'Overdue for '. abs($days). ' day(s)' ?></a></td>

                                                                        <?php
                                                                        $total_90 += $row->pototal;
                                                                    }
                                                                    else if($days < -90){
                                                                        ?>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td> <?php echo 'PHP '.number_format($row->pototal,'2','.',',')?></td>
                                                                        <td> <a class ="btn btn-danger btn-xs"> <?php echo 'Overdue for '. abs($days). ' day(s)' ?></a></td>
                                                                        <?php
                                                                        $total_more += $row->pototal;
                                                                    }
                                                                ?>

                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> <h2>Total:</h2> </td>
                                                        <td> <h2><?php echo 'PHP '.number_format($total_1,'2','.',',') ?></h2> </td>
                                                        <td> <h2><?php echo 'PHP '.number_format($total_30,'2','.',',') ?></h2> </td>
                                                        <td> <h2><?php echo 'PHP '.number_format($total_60,'2','.',',') ?></h2> </td>
                                                        <td> <h2><?php echo 'PHP '.number_format($total_90,'2','.',',') ?></h2> </td>
                                                        <td> <h2><?php echo 'PHP '.number_format($total_more,'2','.',',') ?></h2> </td>


                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="total-tab">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable-buttons" class="table table-bordered">
                                                    <thead>
                                                    <tr>

                                                        <th>Identifier</th>
                                                        <th>Payor</th>
                                                        <th>Payee</th>
                                                        <th>Amount </th>
                                                        <th>Status</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $total = 0;
                                                    if($result3->num_rows > 0) {
                                                        while($row = $result3->fetch_object()) {
                                                            $total += $row->pototal;
                                                            ?>
                                                            <tr>
                                                            <td><?php echo $row->ponumber ?> | Purchase Order</td>
                                                            <td><?php echo $row->clientname ?></td>
                                                            <td><?php echo $row->compname ?></td>
                                                            <td><?php echo 'PHP '.number_format($row->pototal,2,'.',',')?></td>
                                                                <?php
                                                                if ($row->popaymentstatus == 'PROCESSING')
                                                                {
                                                                    ?>
                                                                    <td><a class="btn btn-info btn-xs" > <?php echo $row->popaymentstatus ?></a></td>
                                                                    <?php
                                                                }
                                                                else if ($row->popaymentstatus == 'OVERDUE')
                                                                {
                                                                    ?>
                                                                    <td><a class="btn btn-danger btn-xs" > <?php echo $row->popaymentstatus ?></a></td>
                                                                    <?php
                                                                }
                                                                else if ($row->popaymentstatus == 'DUE')
                                                                {
                                                                    ?>
                                                                    <td><a class="btn btn-warning btn-xs" > <?php echo $row->popaymentstatus ?></a></td>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    if($view3->num_rows > 0) {
                                                        while($row = $view3->fetch_object()) {
                                                            $total += $row->overheadamount;
                                                            ?>
                                                            <tr role="row" class="odd">

                                                                <td> <?php echo $row->overheadcode ?> | Overhead | <?php echo $row->overheadtype ?></td>
                                                                <td><?php echo $row->overheadname ?> </td>
                                                                <td><?php echo $row->compname ?></td>
                                                                <td><?php echo number_format($row->overheadamount,2,'.',','); ?> </td>
                                                                <td><a class="btn btn-info btn-xs" > <?php echo $row->overheadstatus ?></a></td>

                                                            </tr>
                                                            <?php

                                                        }
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> <h2>Total:</h2> </td>
                                                        <td> <h2><?php echo 'PHP '.number_format($total,'2','.',',') ?></h2> </td>

                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="due-tab">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable-buttons" class="table table-bordered">
                                                    <thead>
                                                    <tr>

                                                        <th>Identifier</th>
                                                        <th>Payor</th>
                                                        <th>Payee </th>
                                                        <th>Amount</th>
                                                        <th>Status</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $total = 0;
                                                    if($result4->num_rows > 0) {
                                                        while($row = $result4->fetch_object()) {
                                                            $total += $row->pototal;
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row->ponumber ?> | Purchase Order</td>
                                                                <td><?php echo $row->clientname ?></td>
                                                                <td><?php echo $row->compname ?></td>
                                                                <td><?php echo 'PHP '.number_format($row->pototal,2,'.',',')?></td>
                                                                <td><a class="btn btn-warning btn-xs" > <?php echo $row->popaymentstatus ?></a></td>

                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    if($view4->num_rows > 0) {
                                                        while($row = $view4->fetch_object()) {
                                                            $total += $row->overheadamount;
                                                            ?>
                                                            <tr role="row" class="odd">

                                                                <td> <?php echo $row->overheadcode ?> | Overhead | <?php echo $row->overheadtype ?></td>
                                                                <td><?php echo $row->overheadname ?> </td>
                                                                <td><?php echo $row->compname ?></td>
                                                                <td><?php echo number_format($row->overheadamount,2,'.',','); ?> </td>
                                                                <td><a class="btn btn-warning btn-xs" > <?php echo $row->overheadstatus ?></a></td>

                                                            </tr>
                                                            <?php

                                                        }
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> <h2>Total:</h2> </td>
                                                        <td> <h2><?php echo 'PHP '.number_format($total,'2','.',',') ?></h2> </td>

                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

            </div>
            <br />
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div>
                ©2017 HP Ventures Inc. Accounts Payable System. All Rights Reserved.
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

<!-- Custom Theme Scripts -->
<script src="/HPV/build/js/custom.min.js"></script>

<script>
    $(document).ready(function(){
        $(this).load('po_approved.php');
    });

    window.onload = function() {
        if(!window.location.hash) {
            window.location = window.location + '#loaded';
            window.location.reload();
        }
    }
</script>