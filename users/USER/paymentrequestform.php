<?php
session_start();
include '../../dbconnect.php';

//if (!isset($_SESSION['adminSession']))
if($_SESSION['emplevel'] != 'User'){
    header ('Location: /HPV/login.php');
}

$result = $dbcon->query("SELECT * FROM companies WHERE compno = '".$_SESSION['empcompany']."'");
$row = $result->fetch_object();

// PR NO Generate

$sql = $dbcon->query("SELECT  * FROM paymentrequests");
$NumRows = $sql->num_rows;
$NumRows++;
$Check = true;
do{
    $count = 0;
    $temp = str_pad($NumRows, 4, "0", STR_PAD_LEFT);
    $CheckCode = "PR-".$temp;
    $query = $dbcon->query("SELECT * FROM paymentrequests WHERE prno = '$CheckCode'");
    $count = $query->num_rows;
    if($count == 1)
    {
        $Check = true;
        $NumRows+=1;
    }
    else{
        $Check = false;
        $PRNo = $CheckCode;
    }

}while($Check == true);
// END PR NO Generate


$query = $dbcon->query("SELECT count(*) as totalrequest FROM budgetrequests, companies, employees WHERE  brcomp = compno  
&& brpreparedby  LIKE '" .$_SESSION['empfname']. " " .$_SESSION['emplname']. "' && emplevel ='User'  ");
$values = mysqli_fetch_assoc($query);
$totaluserbrrequest = $values['totalrequest'];

$query = $dbcon->query("SELECT count(*) as totalrequest FROM paymentrequests, companies, employees WHERE  prcomp = compno  
&& prpreparedby  LIKE '" .$_SESSION['empfname']. " " .$_SESSION['emplname']. "' && emplevel ='User'  ");
$values = mysqli_fetch_assoc($query);
$totaluserprrequest = $values['totalrequest'];

$result = $dbcon->query("SELECT * FROM budgetrequests, companies , employees WHERE brcomp = compno  
&& brpreparedby  LIKE '" .$_SESSION['empfname']. " " .$_SESSION['emplname']. "' && emplevel ='User'  ");

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

                            <li><a> <i class="fa fa-briefcase"></i>Budget Request <span class="fa fa-chevron-down"> </a>
                                <ul class="nav child_menu">
                                    <li><a href="budgetrequestform.php">Create</a></li>
                                    <li><a href="viewbudgetrequest.php">View Budget Request <span class="badge bg-green pull-right"><?php echo
                                                $totaluserbrrequest ?>
                                  </span></a></li>


                                </ul>
                            </li>
                            <li><a> <i class="fa fa-credit-card"></i>Payment Request <span class="fa fa-chevron-down"> </a>
                                <ul class="nav child_menu">
                                    <li><a href="paymentrequestform.php">Create</a></li>
                                    <li><a href="viewpaymentrequest.php">View Payment Request <span class="badge bg-green pull-right"><?php echo
                                                $totaluserprrequest ?>
                                  </span></a></li>

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
                var html= '  <div class="container "> <div class="col-md-3 col-sm-3 col-xs-9" id="added"> <input type="text" class=" form-control" id="description" name="description[]" placeholder="Description" required> </div> <div class="col-md-3 col-sm-3 col-xs-9"  id="added"> <input type="text" class="form-control " id="invoiceno" name="invoiceno[]" placeholder="Invoice no" required> </div> <div class="col-md-2 col-sm-3  col-xs-9"  id="added"> <input type="number" class=" form-control " step="any" id="amount" name="amount[]" placeholder="Amount" required> </div> <div class="col-md-3 col-sm-3  col-xs-9"  id="added"> <input type="text" class=" form-control " id="duedate" name="duedate[]" placeholder="Due date" required> </div> <div class="col-md-1 col-sm-1 col-xs-9" id="added"> <a id= "remove" name="remove" type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove" ></span></a> </div> </div>  ';

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
                                <h2>Payment Request Form</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal form-label-left " method="POST" id="CreatePaymentForm" name="CreatePaymentForm" action="insert_data/insert-prform.php" enctype="multipart/form-data">


                                    <div class=" form-group has-feedback">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-9">COMPANY:</label>
                                        <div class="col-md-3 col-sm-3 col-xs-9">
                                            <input type="text" style="display:none" id="company" name="company" value="<?php echo $row->compno ?>">
                                            <input type="text" class="form-control" id="wala" name="wala" value="<?php echo $row->compname ?>" readonly>
                                        </div>
                                        <label class="control-label col-md-3 col-sm-3 col-xs-9">PR NO:</label>
                                        <div class="col-md-3 col-sm-3 col-xs-9">
                                            <input id="prNo" name="prNo" type="text" class="form-control" value="<?php echo $PRNo ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>

                                    <div class=" form-group has-feedback">
                                        <label class="textsize control-label col-md-2 col-sm-2 col-xs-9 ">Date Submitted:</label>
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <input readonly type="text" class="form-control has-feedback-left" name ="dateSubmitted" id="dateSubmitted" value ="<?php echo date('m/j/Y');?>"  required >
                                            <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-9">Date Needed:</label>
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <fieldset>
                                                <div class="control-group">
                                                    <div class="controls">

                                                            <input type="text" class="form-control has-feedback-left" id="single_cal3" name="dateNed" aria-describedby="inputSuccess2Status3">
                                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            <span id="inputSuccess2Status3" class="sr-only">(success)</span>

                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                    </div>

                                    <div class=" form-group has-feedback">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Requested By:</label>
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <input id="requestedBy" name="requestedBy" type="text" class="form-control" placeholder="Default Input" >
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-9">Attention:</label>
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <input id="attention" name="attention" type="text" class="form-control" placeholder="Default Input" >
                                        </div>

                                    </div>

                                    <div class=" form-group has-feedback">

                                        <label class="control-label col-md-2 col-sm-2 col-xs-9">Title:</label>
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <input id="title" name="title" type="text" class="form-control" placeholder="Default Input" >
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-9">Department:</label>
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <input id="department" name="department" type="text" class="form-control" placeholder="Default Input" >
                                        </div>


                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group ">

                                        <div class="col-md-3 col-sm-3  col-xs-9">
                                            <h2 >DESCRIPTION</h2>
                                        </div>



                                        <div class="col-md-3 col-sm-3 col-xs-9 ">
                                            <h2  >INVOICE NO</h2>
                                        </div>



                                        <div class="col-md-2 col-sm-3 col-xs-9">
                                            <h2 >AMOUNT</h2>
                                        </div>

                                        <div class="col-md-3 col-sm-3 col-xs-9">
                                            <h2 >DUE DATE</h2>
                                        </div>

                                    </div>


                                    <div class="ln_solid"></div>


                                    <div id="container">
                                        <div class="container ">
                                            <div class="col-md-3 col-sm-3 col-xs-9">
                                                <input type="text" class=" form-control" id="description" name="description[]" placeholder="Description" required>
                                            </div>

                                            <div class="col-md-3 col-sm-3 col-xs-9">
                                                <input type="text" class=" form-control" id="invoiceno" name="invoiceno[]" placeholder="Invoice No." required>
                                            </div>

                                            <div class="col-md-2 col-sm-3  col-xs-9">
                                                <input type="number" class=" form-control " step="any" id="amount" name="amount[]" placeholder="Amount" required>
                                            </div>

                                            <div class="col-md-3 col-sm-5 col-xs-9">
                                                <input type="text" class="form-control " id="duedate" name="duedate[]" placeholder="Due date" required>
                                            </div>

                                            <div class="col-md-1 col-sm-1 col-xs-9">
                                                <a id= "add" name="add" type="button" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-plus"></span></a>
                                            </div>

                                        </div>
                                    </div>
                                    <!--container end-->
                                    <div class=" form-group">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12  ">NOTE: I acknowledge that this funding request, if approved, will be deducted from:</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-2 col-sm-6 col-xs-12 col-md-offset-2">
                                            <input type="checkbox"  value="Petty Cash"> Petty Cash
                                        </div>
                                        <div class="col-md-2 col-sm-6 col-xs-12 col-md-offset-2">
                                            <input type="checkbox"  value="Others"> Others
                                        </div>
                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                            <input type="file" name="files[]" multiple>
                                        </div>
                                    </div>


                                    <div class=" form-group has-feedback">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-9">Prepared by:</label>
                                        <div class="col-md-3 col-sm-3 col-xs-12">

                                            <input type="text" class="form-control " id="preparedBy" name="preparedBy" value="<?php echo $_SESSION['empfname']; echo " "; echo $_SESSION['emplname'] ?>" readonly>

                                        </div>


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
<!--<script src="../Accounting/insert_data/insert-povoucher.js"></script>-->
<!-- Initialize datetimepicker -->


</body>
</html>
