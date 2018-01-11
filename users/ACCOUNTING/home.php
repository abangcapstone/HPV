<?php
    session_start();
    include_once "../../dbconnect.php";
    
    //if (!isset($_SESSION['adminSession'])) 
    if($_SESSION['emplevel'] != 'Accounting'){
        header ('Location: /HPV/login.php');
    }

    $query = $dbcon->query("SELECT count(*) as total FROM vouchers");
    $values = mysqli_fetch_assoc($query);
    $numVouchers = $values['total'];

    $query = $dbcon->query("SELECT count(*) as total FROM overheads");
    $values = mysqli_fetch_assoc($query);
    $numOverheads = $values['total'];
    
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
                      <li class="active"><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
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
                      <li> <a href="/HPV/users/ACCOUNTING/profile.php">Profile</a></li>
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

        <!-- page content -->
        <div class="right_col" role="main">
                 <!-- top tiles -->
                    <ul class="nav ">
                        <li role="presentation" class="dropdown col-md-3 col-sm-4 col-xs-6 tile_stats_count " >
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <div class="tile-stats ">
                                    <?php
                                        if($payables == 0){
                                          ?>
                                            <div class="icon"><i class="fa fa-info"></i></div>
                                            <div class="count "><?php echo $payables ?></div>
                                            <h3 >PAYABLES</h3>
                                            <p >You can check other payables</p>
                                         <?php
                                        }
                                        else{
                                            ?>
                                            <div class="icon"><i class="fa fa-info"></i></div>
                                            <div class="count blink_me"><?php echo $payables ?></div>
                                            <h3 class ="blink_me">PAYABLES</h3>
                                            <p >About to due in three days or less</p>

                                            <?php
                                        }
                                    ?>
                                </div>

                            </a>
                            <ul id="menu1" class="dropdown-menu scrollable-menu text-info msg_list" role="menu">
                                <?php
                                if($result2->num_rows > 0) {
                                    while ($row = $result2->fetch_object()) {
                                        ?>
                                        <a href="po_approved.php">
                                            <li >
                                                <p>
                                                <h6 >
                                                    Purchase Order
                                                    <div class="ln_solid"></div>
                                                    <strong>CODE:</strong> <?php echo  $row->ponumber ?> | <strong>DATE:</strong> <?php echo $row->podate ?> <br />
                                                    <strong>AMOUNT:</strong> <?php echo 'PHP'.number_format($row->pototal,'2','.',',')?>
                                                </h6>
                                                </p>

                                            </li>
                                        </a>
                                        <?php
                                    }}

                                if($result1->num_rows > 0) {
                                    while ($row = $result1->fetch_object()) {
                                        ?>
                                        <a href="viewoverheads.php">
                                            <li >
                                                <p>
                                                <h6 >
                                                    OVERHEAD
                                                    <div class="ln_solid"></div>
                                                    <strong>CODE:</strong> <?php echo  $row->overheadcode ?> | <strong>DATE:</strong> <?php echo $row->overheaddate ?> <br />
                                                    <strong>AMOUNT:</strong> <?php echo 'PHP'.number_format($row->overheadamount,'2','.',',')?>
                                                </h6>
                                                </p>

                                            </li>
                                        </a>
                                        <?php
                                    }}
                                ?>
                            </ul>

                        </li>
                        <li role="presentation" class="dropdown col-md-3 col-sm-4 col-xs-6 tile_stats_count" >
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <div class="tile-stats">
                                    <?php
                                    if($overdues == 0){
                                        ?>
                                        <div class="icon"><i class="fa fa-exclamation-triangle"></i></div>
                                        <div class="count  "><?php echo $overdues ?></div>
                                        <h3  >OVERDUE</h3>
                                        <p>No Unpaid Accounts</p>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <div class="icon"><i class="fa fa-exclamation-triangle"></i></div>
                                        <div class="count blink_me"><?php echo $overdues ?></div>
                                        <h3 class="blink_me">OVERDUE</h3>
                                        <p>Unpaid Accounts</p>

                                        <?php
                                    }
                                    ?>
                                </div>

                            </a>
                            <ul id="menu" class="dropdown-menu scrollable-menu text-info msg_list" role="menu">
                                <?php
                                if($result4->num_rows > 0) {
                                    while ($row = $result4->fetch_object()) {
                                        ?>
                                        <a href="po_approved.php">
                                            <li >
                                                <p>
                                                <h6 >
                                                    Purchase Order
                                                    <div class="ln_solid"></div>
                                                    <strong>CODE:</strong> <?php echo  $row->ponumber ?> |
                                                    <strong>Overdue :</strong> <?php echo abs($row->podaysrem).' days' ?> <br />
                                                    <strong>AMOUNT:</strong> <?php echo 'PHP'.number_format($row->pototal,'2','.',',')?> <br />
                                                    <strong>PAYEE :</strong> <?php echo $row->clientname ?>
                                                </h6>
                                                </p>

                                            </li>
                                        </a>
                                        <?php
                                    }}

                                if($result3->num_rows > 0) {
                                    while ($row = $result3->fetch_object()) {
                                        ?>
                                        <a href="viewoverheads.php">
                                            <li >
                                                <p>
                                                <h6 >
                                                    OVERHEAD
                                                    <div class="ln_solid"></div>
                                                    <strong>CODE:</strong> <?php echo  $row->overheadcode ?> | <strong>Overdue for :</strong> <?php echo $row->ohdaysrem.' days' ?> <br />
                                                    <strong>AMOUNT:</strong> <?php echo 'PHP'.number_format($row->overheadamount,'2','.',',')?>  <br />
                                                    <strong>PAYEE :</strong> <?php echo $row->overheadname ?>
                                                </h6>
                                                </p>

                                            </li>
                                        </a>
                                       <?php
                                    }}
                                ?>
                            </ul>

                        </li>
                        <li role="presentation" class="dropdown col-md-3 col-sm-4 col-xs-6 tile_stats_count" >
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <div class="tile-stats">
                                    <?php
                                    if($dues == 0){
                                        ?>
                                        <div class="icon"><i class="fa fa-sun-o"></i></div>
                                        <div class="count  "><?php echo $dues ?></div>
                                        <h3  >DUE TODAY</h3>
                                        <p>No Due Accounts</p>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <div class="icon"><i class="fa fa-sun-o"></i></div>
                                        <div class="count blink_me"><?php echo $dues ?></div>
                                        <h3 class="blink_me">DUE TODAY</h3>
                                        <p>Due accounts today</p>
                                        <?php
                                    }
                                    ?>

                                </div>



                            </a>
                            <ul id="menu" class="dropdown-menu scrollable-menu  text-info msg_list" role="menu">
                                <?php
                                if($result6->num_rows > 0) {
                                    while ($row = $result6->fetch_object()) {
                                        ?>
                                          <a href="po_approved.php">
                                        <li >
                                            <p>
                                            <h6 >
                                                Purchase Order
                                                <div class="ln_solid"></div>
                                                <strong>CODE:</strong> <?php echo  $row->ponumber ?> | <strong>PAYEE:</strong> <?php echo $row->poclient ?> <br />
                                                <strong>AMOUNT:</strong> <?php echo 'PHP'.number_format($row->pototal,'2','.',',')?>
                                            </h6>
                                            </p>

                                        </li>
                                          </a>
                                        <?php
                                    }}

                                if($result5->num_rows > 0) {
                                    while ($row = $result5->fetch_object()) {
                                        ?>
                                      <a href="viewoverheads.php">
                                        <li >
                                            <p>
                                            <h6 >
                                                OVERHEAD
                                                <br class="ln_solid">
                                                <strong>CODE:</strong> <?php echo  $row->overheadcode ?> | <strong>PAYEE:</strong> <?php echo $row->overheadname ?> <br />
                                                <strong>AMOUNT:</strong> <?php echo 'PHP'.number_format($row->overheadamount,'2','.',',')?>
                                            </h6>
                                            </p>

                                        </li>
                                      </a>
                                        <?php
                                    }}
                                ?>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown col-md-3 col-sm-4 col-xs-6 tile_stats_count" >
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                               
                                <div class="tile-stats">
                                    <?php
                                    if($pendings == 0){
                                        ?>
                                        <div class="icon"><i class="fa fa-ticket"></i></div>
                                        <div class="count  "><?php echo $pendings ?></div>
                                        <h3  >PENDING</h3>
                                        <p>No Accounts that needs approval</p>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <div class="icon"><i class="fa fa-ticket"></i></div>
                                        <div class="count blink_me"><?php echo $pendings ?></div>
                                        <h3 class="blink_me">PENDING</h3>
                                        <p>Pending for approval</p>
                                        <?php
                                    }
                                    ?>

                                </div>


                            </a>
                            <ul id="menu" class="dropdown-menu  scrollable-menu msg_list   text-info " role="menu" >
                                <?php
                                if($result8->num_rows > 0) {
                                    while ($row = $result8->fetch_object()) {
                                        ?>
                                        <a href="po_pending.php">
                                        <li>
                                                <p>
                                                  <h6 >
                                                Purchase Order
                                                <div class="ln_solid"></div>
                                                <strong>CODE:</strong> <?php echo  $row->ponumber ?> | <strong>DATE:</strong> <?php echo $row->podate ?> <br />
                                                     <strong>AMOUNT:</strong> <?php echo 'PHP'.number_format($row->pototal,'2','.',',')?>
                                                  </h6>
                                                </p>

                                        </li>
                                     </a>
                                        <?php
                                    }}

                                if($result7->num_rows > 0) {
                                    while ($row = $result7->fetch_object()) {
                                        ?>
                                        <a href="br-pending.php">
                                        <li >
                                            <p>
                                            <h6 >
                                                Budget Request
                                                <div class="ln_solid"></div>
                                                <strong>CODE:</strong> <?php echo  $row->brno ?> | <strong>DATE:</strong> <?php echo $row->brdatesubmitted ?> <br />
                                               <strong>AMOUNT:</strong> <?php echo 'PHP'.number_format($row->brtotal,'2','.',',')?>
                                            </h6>
                                            </p>

                                        </li>
                                        </a>
                                        <?php
                                    }}

                                if($result9->num_rows > 0) {
                                    while ($row = $result9->fetch_object()) {
                                        ?>
                                        <a href="pr-pending.php">
                                        <li >
                                            <p >
                                            <h6 >
                                                Payment Request
                                                <div class="ln_solid"></div>
                                                <strong>CODE:</strong> <?php echo  $row->prno ?> | <strong>DATE:</strong> <?php echo $row->prdatesubmitted ?> <br />
                                                <strong>AMOUNT:</strong> <?php echo 'PHP'.number_format($row->prtotal,'2','.',',')?>
                                            </h6>
                                            </p>
                                        </li>
                                        </a>
                                        <?php
                                    }}
                                ?>
                            </ul>
                        </li>
                    </ul>


          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3> Welcome Accountant! </h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div id="chart_plot_01" class="demo-placeholder"></div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2>Top Campaign Performance</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Facebook Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="100"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Twitter Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Conventional Media</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Bill boards</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
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

          <div class="row">


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>App Versions</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <h4>App Usage across versions</h4>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.2</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>123k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.3</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>53k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.4</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>23k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.5</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>3k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.6</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>1k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Device Usage</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>Top 5</p>
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                          <p class="">Device</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                          <p class="">Progress</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>IOS </p>
                            </td>
                            <td>30%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Android </p>
                            </td>
                            <td>10%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Blackberry </p>
                            </td>
                            <td>20%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Symbian </p>
                            </td>
                            <td>15%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Others </p>
                            </td>
                            <td>30%</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Quick Settings</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <ul class="quick-list">
                      <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
                      </li>
                      <li><i class="fa fa-bars"></i><a href="#">Subscription</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-area-chart"></i><a href="logout.php?logout">Logout</a>
                      </li>
                    </ul>

                    <div class="sidebar-widget">
                        <h4>Profile Completion</h4>
                        <canvas width="150" height="80" id="chart_gauge_01" class="" style="width: 160px; height: 100px;"></canvas>
                        <div class="goal-wrapper">
                          <span id="gauge-text" class="gauge-value pull-left">0</span>
                          <span class="gauge-value pull-left">%</span>
                          <span id="goal-text" class="goal-value pull-right">100%</span>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>


          <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Recent Activities <small>Sessions</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-md-8 col-sm-8 col-xs-12">



              <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Visitors location <small>geo-presentation</small></h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                          </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="dashboard-widget-content">
                        <div class="col-md-4 hidden-small">
                          <h2 class="line_30">125.7k Views from 60 countries</h2>

                          <table class="countries_list">
                            <tbody>
                              <tr>
                                <td>United States</td>
                                <td class="fs15 fw700 text-right">33%</td>
                              </tr>
                              <tr>
                                <td>France</td>
                                <td class="fs15 fw700 text-right">27%</td>
                              </tr>
                              <tr>
                                <td>Germany</td>
                                <td class="fs15 fw700 text-right">16%</td>
                              </tr>
                              <tr>
                                <td>Spain</td>
                                <td class="fs15 fw700 text-right">11%</td>
                              </tr>
                              <tr>
                                <td>Britain</td>
                                <td class="fs15 fw700 text-right">10%</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div id="world-map-gdp" class="col-md-8 col-sm-12 col-xs-12" style="height:230px;"></div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="row">


                <!-- Start to do list -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>To Do List <small>Sample tasks</small></h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                          </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                      <div class="">
                        <ul class="to_do">
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Schedule meeting with new client </p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Create email address for new intern</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Create email address for new intern</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End to do list -->
                
                <!-- start of weather widget -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Daily active users <small>Sessions</small></h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                          </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="temperature"><b>Monday</b>, 07:30 AM
                            <span>F</span>
                            <span><b>C</b></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="weather-icon">
                            <canvas height="84" width="84" id="partly-cloudy-day"></canvas>
                          </div>
                        </div>
                        <div class="col-sm-8">
                          <div class="weather-text">
                            <h2>Texas <br><i>Partly Cloudy Day</i></h2>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="weather-text pull-right">
                          <h3 class="degrees">23</h3>
                        </div>
                      </div>

                      <div class="clearfix"></div>

                      <div class="row weather-days">
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Mon</h2>
                            <h3 class="degrees">25</h3>
                            <canvas id="clear-day" width="32" height="32"></canvas>
                            <h5>15 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Tue</h2>
                            <h3 class="degrees">25</h3>
                            <canvas height="32" width="32" id="rain"></canvas>
                            <h5>12 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Wed</h2>
                            <h3 class="degrees">27</h3>
                            <canvas height="32" width="32" id="snow"></canvas>
                            <h5>14 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Thu</h2>
                            <h3 class="degrees">28</h3>
                            <canvas height="32" width="32" id="sleet"></canvas>
                            <h5>15 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Fri</h2>
                            <h3 class="degrees">28</h3>
                            <canvas height="32" width="32" id="wind"></canvas>
                            <h5>11 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Sat</h2>
                            <h3 class="degrees">26</h3>
                            <canvas height="32" width="32" id="cloudy"></canvas>
                            <h5>10 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- end of weather widget -->
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
            $(this).load('po_approved.php');
            $(this).load('viewoverheads.php');
        });

        window.onload = function() {
            if(!window.location.hash) {
                window.location = window.location + '#loaded';
                window.location.reload();
            }
        }
    </script>

    <?php
       while($row = $result->fetch_object()) {
        if($row->usercode == $_SESSION['empcode']) {
          if(!strcmp(md5("p@ss"), $row->userpass)) {
    ?>
        <script src='../../update-pass_karaan.js'></script>
    <?php
          }
        }
      }
    ?>
 
	
  </body>
</html>

<!--CREATE MODAL START-->
                              <div id="ChangePasswordModal1" class="modal fade createUser-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                  <div class="modal-content">

                                    <div class="modal-header">
                                      
                                      <h4 class="modal-title" id="myModalLabel">Change password!</h4>
                                    </div>
                                    <div class="modal-body">
                                      
                                        
                            <!--     FORM  START      -->
                                          <form class="form-horizontal form-label-left" method="post" id="ChangePasswordForm1">

                                                  <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1" for="password1">New password:
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input id="password1" name="password1" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" placeholder="New password" required="required" type="password">
                                                    </div>
                                                  </div>
                                              
                                                 <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1" for="password2">Confirm password: 
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input id="password2" name="password2" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  placeholder="Confirm password" required="required" data-validate-linked="password1" type="password">
                                                    </div>
                                                  </div>

                                                  <div class="ln_solid"></div>
                                                  <div class="form-group">
                                                       <div class="col-md-3 col-sm-3 col-xs-12">
                                                      </div>
                                                 <div class="col-md-3 col-sm-3 col-xs-12" >
                                                   <?php 
                                                        while($row = $result1->fetch_object()) {
                                                          if($row->usercode == $_SESSION['empcode']) {
                                                        ?>
                                                        <input type="hidden" name="id_holder" id="id_holder" value="<?php echo $row->usercode ?>"/>
                                                   <?php 
                                                          }
                                                        }
                                                    ?>
                                                     <button name="create" id="create" type="submit" class="btn btn-success">
                                                     
                                                      Change
                                                    </button>
                                                     
                                               </div>
                                               <div class="col-md-3 col-sm-3 col-xs-12">
                                                  <button type="button" class="btn btn-warning" onclick ="this.form.reset();">
                                                  Clear
                                                </button>
                                                      
                                                  
                                             </div>
                                              </div>

                                            </form> 

                                                    <!--FORM END-->
                                        </div>
                                      </div>
                                    </div>
                                  </div>
