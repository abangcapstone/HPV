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
                            <li ><a href="purchaseorder.php"><i class="fa fa-building-o"></i> Purchase Order </a></li>
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
                                                                <input id="curr_pass" name="curr_pass" class="form-control col-md-4 col-xs-12" data-validate-length-range="6" type="password" required>
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
