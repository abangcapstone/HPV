
<?php
session_start();
include_once "../../dbconnect.php";

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

    <!-- file input css -->
    <link rel="stylesheet" type="text/css" href="/HPV/build/fileinput/css/fileinput.css">


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
                            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
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
        <!-- /page content -->

            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel2">Edit Profile</h4>
                        </div>
                        <div class="modal-body">

                                <form action="index.php" method="post" enctype="multipart/form-data" id="uploadImageForm">
                                    <div class="form-group">
                                        <div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>

                                        <div class="kv-avatar center-block" style="width:200px">
                                            <input id="avatar-2" name="userImage" type="file" class="file-loading">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </form>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>

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

<!-- Custom Theme Scripts -->
<script src="/HPV/build/js/custom.min.js"></script>
<script src="/HPV/build/fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="/HPV/build/fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
<script src="/HPV/build/fileinput/js/fileinput.min.js"></script>
<script src="../../update-pass.js">


</script>



        <script>
            $('#password, #confirm_password').on('keyup', function () {
                if ($('#password').val() == $('#confirm_password').val()) {
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
