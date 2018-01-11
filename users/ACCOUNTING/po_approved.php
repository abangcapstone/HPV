<?php 
  session_start();
  include '../../dbconnect.php';

   //if (!isset($_SESSION['adminSession'])) 
    if($_SESSION['emplevel'] != 'Accounting'){
        header ('Location: /HPV/login.php');
    }
    date_default_timezone_set('Asia/Manila');

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

$result = $dbcon->query("SELECT * FROM purchaseorder ,podetails,clients,companies  WHERE poclient = clientcode AND  pocompany = compno AND ponumber = poitemcode AND postatus ='APPROVED' ");

/*$result = $dbcon->query("SELECT * FROM podelivery");*/


$holiday = mysqli_query($dbcon, "SELECT * FROM calendar WHERE holidaystatus = 'AC'");

$identifier = mysqli_query($dbcon,"SELECT voucheridentifier,voucherdate FROM vouchers");


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!--<meta http-equiv ="refresh" content = "5">-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <title>HP Ventures Inc. | Accounts Payable System | </title>
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
                      <li> <a href="/HPV/users/ACCOUNTING/profile.php">Profile</a></li>
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
                    <h2>Approved Purchase Order</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                          <div class="row">
                          </div>
                          <div class="row"><div class="col-sm-12">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                              <thead>
                                <tr role="row">
                                    
                                 <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 79.8889px;" aria-sort="ascending" aria-label="First name: activate to sort column descending">Actions
                                  </th>
                                
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 84.8889px;" aria-label="Last name: activate to sort column ascending">Purchase Order
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 84.8889px;" aria-label="Last name: activate to sort column ascending">Date Created
                                  </th>
                                  
                                   <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 84.8889px;" aria-label="Last name: activate to sort column ascending">Payor
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 182.889px;" aria-label="Position: activate to sort column ascending">Payee
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 81.8889px;" aria-label="Office: activate to sort column ascending">Amount
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 80px;" aria-label="E-mail: activate to sort column ascending">Payment Status
                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                              <!-- Fetch data from database -->
                              <?php

                                //identifier
                              $identifierArray = array();
                              $voucherdateArray = array();
                              while($check = mysqli_fetch_array($identifier))
                              {
                                  array_push($identifierArray, $check['voucheridentifier']);
                                  array_push($voucherdateArray, $check['voucherdate']);
                              }
                              $ctr1 = count($identifierArray);

                              //holiday
                              $holidaydays = array();
                              $holidaymonths  = array();
                              $nocountdays = array();
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
                              if($result->num_rows > 0) {
                                  $UniqueCode = "PO#000000";
                                  while ($row = $result->fetch_object()) {
                                      $created = 0;


                                      if ($row->ponumber != $UniqueCode) {
                                          $UniqueCode = $row->ponumber;
                                          ?>
                                          <tr role="row" class="odd">

                                          <td><a href='#ViewPoModal' data-toggle='modal' id="edit"
                                                 class="btn btn-primary btn-xs edit_data"
                                                 data-id="<?php echo $row->ponumber ?>"> <span class="fa fa-eye"
                                                                                               aria-hidden="true"></span>
                                                  View</a>
                                              <?php
                                              $temp = $row->ponumber;
                                              $devCheck = $dbcon->query("SELECT * FROM podelivery WHERE pono = '$temp'");
                                              $count = $devCheck->num_rows;


                                              $devCheck = $dbcon->query("SELECT * FROM vouchers WHERE voucheridentifier = '$temp'");
                                              $countVoucher = $devCheck->num_rows;

                                              if ($countVoucher == 0) {
                                                  ?>
                                                  <a href='po_vouchers.php' class="btn btn-primary btn-xs payment_data">
                                                      Create Voucher</a>
                                                  <?php
                                              } else if ($count == 0 ) {
                                                  ?>
                                                  <a disabled="disabled" class="btn btn-primary btn-xs payment_data">
                                                      <span class="fa fa-money" aria-hidden="true"></span> Pay</a>
                                                  <?php
                                              }
                                              else if($row->popaymentstatus == 'PAID'){
                                                  ?>
                                                  <a style="display:none" class="btn btn-primary btn-xs payment_data">
                                                      <span class="fa fa-money" aria-hidden="true"></span> Pay</a>
                                                  <?php
                                              }
                                              else {

                                                  ?>

                                                  <a href='#UpdatePayment' data-toggle='modal' id="payment"
                                                     class="btn btn-primary btn-xs payment_data"
                                                     data-id="<?php echo $row->ponumber ?>"> <span class="fa fa-money"
                                                                                                   aria-hidden="true"></span>
                                                      Pay</a>

                                                  <?php
                                              }
                                              ?>
                                          </td>

                                          <td><?php echo $row->ponumber ?> </td>
                                          <td><?php echo $row->podate ?></td>
                                          <td> <?php echo $row->compname ?> </td>
                                          <td><?php echo $row->clientname ?></td>
                                          <td><?php echo 'PHP ' . number_format($row->pototal, 2, '.', ',') ?></td>

                                          <?php
                                          //increment days
                                          $podeliver = $dbcon->query("SELECT * FROM podelivery WHERE pono = '$row->ponumber' ");
                                          $datas = mysqli_fetch_array($podeliver);
                                          //echo $podeliver->num_rows;
                                          $days = 365;
                                          $flag = 0;
                                          if ($podeliver->num_rows == 0) {

                                              for ($i = 0; $i < $ctr1; $i++) {

                                                  /*echo $identifierArray[$i].'<br>';*/
                                                  if ($identifierArray[$i] == $row->ponumber) {
                                                      $flag = 1;
                                                  }
                                              }
                                              if ($flag == 1) {
                                                  ?>
                                                  <td>
                                                      <button type="button" class="btn btn-info btn-xs"
                                                              data-toggle="tooltip" data-placement="top"
                                                              title="<?php echo 'NOT YET DELIVERED' ?>">PROCESSING
                                                      </button>
                                                  </td>
                                                  <?php
                                                  $status = 'PROCESSING';
                                                  $days = 365;
                                              } else {
                                                  ?>
                                                  <td>
                                                      <button type="button" class="btn btn-info btn-xs">FOR VOUCHER
                                                      </button>
                                                  </td>
                                                  <?php
                                                  $status = 'FOR VOUCHER';
                                                  $days = 365;
                                              }
                                          } else {
                                              $dlvrdate = strtotime($datas['podeliverydate']);
                                              //echo 'DELIVER DATE: '. date('Y-m-d',$dlvrdate);
                                              $next_day = date('Fj, Y', $dlvrdate);
                                              $date = strtotime("+1 day", strtotime($next_day));
                                              $next_day = date('Fj, Y', $date);
                                              $start_date = $next_day;
                                              // echo 'START DATE: '.$next_day. '<br>';
                                              $terms = (int)$row->clientterms;
                                              for ($j = 0; $j < $ctr2; $j++) {
                                                  $next_day = date('F j, Y', $dlvrdate);
                                                  //echo ' terms : '. $terms;
                                                  //echo ' J:'.$j. '<br>';
                                                  for ($i = 1; $i <= $terms; $i++) {
                                                      // echo ' HOLIDAY ' . $holidaymonths[$j] . $holidaydays[$j]. $year.'<br>';
                                                      $date = strtotime("+1 day", strtotime($next_day));
                                                      $next_day = date('F j, Y', $date);
                                                      $sunday = strtotime($next_day);

                                                      if (strcmp(date('F j', strtotime($next_day)), "January 1") == 0) {
                                                          $year = date(', Y', strtotime('+1 year'));
                                                          //echo 'NEW YEAR : '.$futureDate;
                                                      }

                                                      if (strcmp($next_day, $holidaymonths[$j] . ' ' . $holidaydays[$j] . $year) == 0) {
                                                          $i--;
                                                          //$add_no_terms += 1;
                                                          //echo 'HOLIDAY : ' . $holidaymonths[$j].' '. $holidaydays[$j] . $year.'<br>';

                                                      } else if (date('l', $sunday) == 'Sunday') {
                                                          $i--;
                                                          // echo 'SUNDAY : '.date('F j, Y',$sunday).'<br>';
                                                      } else {
                                                          //echo ' NEXT DAY  '.$next_day.'<br>';
                                                      }
                                                  }
                                              }
                                              $end_date = date('Y-m-d', strtotime($next_day));
                                              //  echo ' END DATE : '.$end_date.'<br>';
                                              $today = date('Y-m-d');
                                              // echo  'TODAY : ' . $today. '<br> ';
                                              $daystildue = getWorkingDays($today, $end_date, $holidays);


                                              if ($row->podatepaid > 0) {
                                                  ?>
                                                  <td>
                                                      <button type="button" class="btn btn-success btn-xs">PAID</button>
                                                  </td>
                                                  <?php
                                                  $status = 'PAID';
                                                  $days = 31;

                                              } else if ($today == $end_date) {
                                                  for ($i = 0; $i < $ctr1; $i++) {
                                                      if ($identifierArray[$i] == $row->ponumber) {
                                                          $created = 1;
                                                          $datecreated = $voucherdateArray[$i];
                                                      }
                                                  }


                                                  if ($created == 1) {
                                                      ?>
                                                      <td><a class="btn btn-warning btn-xs">DUE </a></td>
                                                      <?php
                                                      $status = 'DUE';
                                                      $days = 0;

                                                  } else {
                                                      ?>
                                                      <td>
                                                          <button type="button" class="btn btn-info btn-xs"
                                                                  data-toggle="tooltip" data-placement="top"
                                                                  title="<?php echo 'DUE TODAY' ?>">FOR VOUCHER
                                                          </button>
                                                      </td>
                                                      <?php
                                                      $status = 'DUE';
                                                      $days = 0;
                                                  }
                                                  ?>

                                                  <?php

                                              } else if ($today > $end_date) {
                                                  $datetime1 = date_create($today);
                                                  $datetime2 = date_create($end_date);
                                                  $interval = date_diff($datetime1, $datetime2);
                                                  $interval = $interval->days;
                                                  //  echo 'OVERDUE : '. $interval->format('%R%a days').'<br>';

                                                  for ($i = 0; $i < $ctr1; $i++) {
                                                      if ($identifierArray[$i] == $row->ponumber) {
                                                          $created = 1;
                                                          $datecreated = $voucherdateArray[$i];
                                                      }
                                                  }


                                                  if ($created == 1) {
                                                      ?>
                                                      <td><a class="btn btn-danger btn-xs" data-toggle="tooltip"
                                                             data-placement="top"
                                                             title="<?php echo 'Overdue for ' . $interval . ' day(s)' ?>">OVERDUE </a>
                                                      </td>
                                                      <?php
                                                      $status = 'OVERDUE';
                                                      $days = -$interval;

                                                  } else {
                                                      ?>
                                                      <td>
                                                          <button type="button" class="btn btn-info btn-xs"
                                                                  data-toggle="tooltip" data-placement="top"
                                                                  title="<?php echo 'Overdue for ' . $interval . ' day(s)' ?>">
                                                              FOR VOUCHER
                                                          </button>
                                                      </td>
                                                      <?php
                                                      $status = 'OVERDUE';
                                                      $days = -$interval;
                                                  }
                                                  ?>
                                                  <?php
                                              } else if ($today < $end_date) {
                                                  for ($i = 0; $i < $ctr1; $i++) {
                                                      if ($identifierArray[$i] == $row->ponumber) {
                                                          $created = 1;
                                                          $datecreated = $voucherdateArray[$i];
                                                      }
                                                  }
                                                  if ($created == 1) {
                                                      ?>
                                                      <td>
                                                          <button type="button" class="btn btn-info btn-xs"
                                                                  data-toggle="tooltip" data-placement="top"
                                                                  title="<?php echo 'Days until due date: ' . $daystildue ?>">
                                                              PROCESSING
                                                          </button>
                                                      </td>
                                                      <?php
                                                      $status = 'PROCESSING';
                                                      $days = $daystildue;

                                                  } else {
                                                      ?>
                                                      <td>
                                                          <button type="button" class="btn btn-info btn-xs"
                                                                  data-toggle="tooltip" data-placement="top"
                                                                  title="<?php echo $daystildue . ' days until due date' ?>">
                                                              FOR VOUCHER
                                                          </button>
                                                      </td>
                                                      <?php
                                                      $status = 'FOR VOUCHER';
                                                      $days = $daystildue;
                                                  }
                                              }
                                              ?>
                                              </tr>
                                              <?php

                                          }
                                          $sql = "UPDATE purchaseorder po INNER JOIN podetails pod ON po.ponumber = pod.poitemcode SET 
                                            popaymentstatus = '$status',
                                            podaysrem = '$days'
                                            WHERE ponumber = '$row->ponumber' AND poitemcode = '$row->ponumber' AND postatus = 'APPROVED'";
                                          mysqli_query($dbcon, $sql);
                                      }
                                      else{
                                          $UniqueCode = $row->ponumber;
                                      }
                              }
                                  }

                                  ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
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
    
    <div id="ViewPoModal" class="modal fade createClient-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
           <span class="glyphicon glyphicon-remove pull-right" aria-hidden="true" type="button" data-dismiss="modal" style="font-size:20px;color:#d9534f"></span>
          <h4 class="modal-title" id="myModalLabel">Purchase Order</h4>
        </div>
        <div class="modal-body">

          <div id="Result"></div>



        </div>
      </div>
    </div>
  </div>

    <div id="UpdatePayment" class="modal fade " tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <span class="glyphicon glyphicon-remove pull-right" aria-hidden="true" type="button" data-dismiss="modal" style="font-size:20px;color:#d9534f"></span>
                    <h4 class="modal-title" id="myModalLabel">Payment</h4>
                </div>
                <div class="modal-body">

                    <div id="Result2"></div>



                </div>
            </div>
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
    <script src="../ACCOUNTING/update_data/view-po.js"></script>



  </body>
</html>

