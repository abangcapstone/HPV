
<?php
    session_start();
    include_once "../../dbconnect.php";
    date_default_timezone_set('Asia/Manila');
    //if (!isset($_SESSION['adminSession'])) 
    if($_SESSION['emplevel'] != 'ADMIN'){
        header ('Location: /HPV/login.php');
    }
    
    $query = $dbcon->query("SELECT count(id) as total FROM users");
    $values = mysqli_fetch_assoc($query);
    $numUsers = $values['total'];

    $query = $dbcon->query("SELECT count(id) as total FROM clients");
    $values = mysqli_fetch_assoc($query);
    $numClients = $values['total'];

    $query = $dbcon->query("SELECT count(id) as total FROM companies");
    $values = mysqli_fetch_assoc($query);
    $numComp = $values['total'];

    $query = $dbcon->query("SELECT count(id) as total FROM branches");
    $values = mysqli_fetch_assoc($query);
    $numBranches = $values['total'];

    $query = $dbcon->query("SELECT count(id) as total FROM categories");
    $values = mysqli_fetch_assoc($query);
    $numCategories = $values['total'];

    $query = $dbcon->query("SELECT count(id) as total FROM calendar");
    $values = mysqli_fetch_assoc($query);
    $numHolidays = $values['total'];

    $result = $dbcon->query("SELECT * FROM users");


    $SessLogs = $dbcon->query("SELECT * FROM activitylogs ORDER BY id DESC");

    $getActId = '';
    $getSessId = '';
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
    <link href="/HPV/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="/HPV/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
      <link href="/HPV/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
      <link href="/HPV/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
      <link href="/HPV/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
      <link href="/HPV/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
      <link href="/HPV/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="/HPV/build/css/custom.min.css" rel="stylesheet">


      

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
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
                  <li class="active"><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
                  <li><a href="user.php"><i class="fa fa-user"></i> User</a></li>
                  <li><a href="client.php"><i class="fa fa-users"></i> Client</a></li>
                  <li><a href="company.php"><i class="fa fa-building"></i> Company </a></li>
                  <li><a href="branch.php"><i class="fa fa-map-marker"></i> Branch </a></li>
                  <li><a href="category.php"><i class="fa fa-tags"></i> Category   </a></li>
                    <li><a href="calendar.php"><i class="fa fa-calendar"></i> Calendar  </a></li>
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
                      <li> <a href="/HPV/users/ADMIN/profile.php">Profile</a></li>
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
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
                <div class="count"><a href="user.php"><?php echo $numUsers ?></a></div>
              
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Clients</span>
              <div class="count"><a href="client.php"><?php echo $numClients ?></a></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Companies</span>
              <div class="count"><a href="company.php"><?php echo $numComp ?></a></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Branches</span>
                <div class="count"><a href="branch.php"><?php echo $numBranches ?></a></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Categories</span>
                <div class="count"><a href="category.php"><?php echo $numCategories ?></a></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> <?php echo date("Y");?> Holidays</span>
                <div class="count"><a href="calendar.php"><?php echo $numHolidays ?></a></div>
            </div>
          </div>
          <!-- /top tiles -->


            <div class="">
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">

                                <h2>Session Logs</h2>
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
                                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 30px;" aria-label="Last name: activate to sort column ascending">Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 30px;" aria-label="Last name: activate to sort column ascending">Activity</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 30px;" aria-label="Last name: activate to sort column ascending">User Level</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 30px;" aria-label="Last name: activate to sort column ascending">IP Address</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 30px;" aria-label="Last name: activate to sort column ascending">Browser</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 30px;" aria-label="Last name: activate to sort column ascending" >Date</th>

                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php

                                                while($row =  mysqli_fetch_array($SessLogs)) {
                                                    $Temp = $row['alempno'];
                                                    $getName = $dbcon->query("SELECT * FROM employees WHERE empcode = '$Temp'");
                                                    $name = $getName->fetch_object();

                                                    ?>

                                                    <tr role="row" class="odd">
                                                        <td><?php echo "$name->empfname $name->emplname"; ?></td>
                                                        <td><?php
                                                                echo $row['alactivity'];
                                                            ?></td>
                                                        <td><?php echo $name->emplevel ?></td>
                                                        <td><?php echo $row['alipaddress']; ?></td>

                                                        <td><?php echo $row['albrowser']; ?></td>
                                                        <td> <?php
                                                            echo $row['aldate'];

                                                            ?>
                                                        </td>


                                                    </tr>


                                                    <?php
                                                    $getSessId=$row['id'];
                                                    $getDate = $row['aldate'];
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
    <script src="/HPV/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/HPV/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>-->
    <script src="/HPV/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>-->
    <script src="/HPV/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>-->
    <script src="/HPV/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>-->
    <script src="/HPV/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/HPV/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/HPV/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="/HPV/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="/HPV/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/HPV/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="/HPV/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="/HPV/build/js/custom.min.js"></script>
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
                            while($row = $result->fetch_object()) {
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