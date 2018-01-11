<?php
session_start();
include '../../dbconnect.php';

//if (!isset($_SESSION['adminSession']))
if($_SESSION['emplevel'] != 'User'){
    header ('Location: /HPV/login.php');
}
// BR NO Generate

$sql = $dbcon->query("SELECT  * FROM budgetrequests");
$NumRows = $sql->num_rows;
$NumRows++;
$Check = true;
do{
    $count = 0;
    $temp = str_pad($NumRows, 4, "0", STR_PAD_LEFT);
    $CheckCode = "BR-".$temp;
    $query = $dbcon->query("SELECT * FROM budgetrequests WHERE brno = '$CheckCode'");
    $count = $query->num_rows;
    if($count == 1)
    {
        $Check = true;
        $NumRows+=1;
    }
    else{
        $Check = false;
        $BRNo = $CheckCode;
    }

}while($Check == true);
// END BR NO Generate

$result = $dbcon->query("SELECT * FROM companies WHERE compno = '".$_SESSION['empcompany']."'");
$row = $result->fetch_object();

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
    <!-- Datatables -->
    <link href="/HPV/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
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
                var html= '  <div class="container "> <div class="col-md-3 col-sm-3 col-xs-9" id="added"> <input type="text" class=" form-control" id="quantity" name="quantity[]" placeholder="Quantity" required> </div> <div class="col-md-5 col-sm-5 col-xs-9"  id="added"> <input type="text" class="form-control " id="description" name="description[]" placeholder="Description" required> </div> <div class="col-md-3 col-sm-3  col-xs-9"  id="added"> <input type="number" class=" form-control " step="any" id="amount" name="amount[]" placeholder="Amount" required> </div> <div class="col-md-1 col-sm-1 col-xs-9" id="added"> <a id= "remove" name="remove" type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove" ></span></a> </div> </div>  ';

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
                                <h2>Budget Request Form</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal form-label-left " method="POST" id="CreateBudgetForm" name="CreateBudgetForm" action="insert_data/insert-brform.php" enctype="multipart/form-data">
                                    <div class=" form-group has-feedback">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-9">COMPANY:</label>
                                        <div class="col-md-3 col-sm-3 col-xs-9">
                                            <input type="text" style="display:none" id="company" name="company" value="<?php echo $row->compno ?>">
                                            <input type="text" class="form-control" id="wala" name="wala" value="<?php echo $row->compname ?>" readonly>
                                        </div>
                                        <label class="control-label col-md-3 col-sm-3 col-xs-9">BR NO:</label>
                                        <div class="col-md-3 col-sm-3 col-xs-9">
                                            <input id="brNo" name="brNo" type="text" class="form-control" value="<?php echo $BRNo ?>" readonly>
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

                                                        <input type="text" class="form-control has-feedback-left" id="single_cal3" name="dateNeeded" aria-describedby="inputSuccess2Status3">
                                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                        <span id="inputSuccess2Status3" class="sr-only">(success)</span>

                                                    </div>
                                                </div>
                                            </fieldset>    </div>

                                    </div>

                                    <div class=" form-group has-feedback">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Requested By:</label>
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <input id="brRequestedBy" name="brRequestedBy" type="text" class="form-control" placeholder="Default Input" >
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-9">Attention:</label>
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <input id="brAttention" name="brAttention" type="text" class="form-control" placeholder="Default Input" >
                                        </div>

                                    </div>

                                    <div class=" form-group has-feedback">

                                        <label class="control-label col-md-2 col-sm-2 col-xs-9">Title:</label>
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <input id="brTitle" name="brTitle" type="text" class="form-control" placeholder="Default Input" >
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-9">Department:</label>
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <input id="brDepartment" name="brDepartment" type="text" class="form-control" placeholder="Default Input" >
                                        </div>


                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group ">

                                        <div  class="col-md-3 col-sm-3  col-xs-9">
                                            <h2 >QUANTITY</h2>
                                        </div>



                                        <div class="col-md-5 col-sm-5 col-xs-9 ">
                                            <h2  >DESCRIPTION</h2>
                                        </div>



                                        <div class="col-md-3 col-sm-3 col-xs-9">
                                            <h2 >AMOUNT</h2>
                                        </div>

                                    </div>


                                    <div class="ln_solid"></div>


                                    <div id="container">
                                        <div class="container ">

                                            <div class="col-md-3 col-sm-3 col-xs-9">
                                                <input type="number" class=" form-control" id="quantity" name="quantity[]" placeholder="Quantity" required>
                                            </div>



                                            <div class="col-md-5 col-sm-5 col-xs-9">
                                                <input type="text" class="form-control " id="description" name="description[]" placeholder="Description" required>
                                            </div>

                                            <div class="col-md-3 col-sm-3  col-xs-9">
                                                <input type="number" class=" form-control " id="amount" step="any" name="amount[]" placeholder="Amount" required>
                                            </div>

                                            <div class="col-md-1 col-sm-1 col-xs-9">
                                                <a id= "add" name="add" type="button" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-plus"></span></a>
                                            </div>

                                        </div>
                                    </div>
                                    <!--container end-->
                                    <div class="ln_solid"></div>

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
                                            <input type="file" name="files[]" multiple required>
                                        </div>
                                    </div>
                                    <div class=" form-group has-feedback">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-9">Prepared by:</label>
                                        <div class="col-md-3 col-sm-3 col-xs-12">

                                            <input type="text" class="form-control  " id="brPreparedBy"
                                                   name="brPreparedBy" value="<?php echo $_SESSION['empfname']; echo " "; echo $_SESSION['emplname'] ?>" readonly>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button id="reset"class="btn btn-danger" type="reset">Reset</button>
                                            <button type="submit" name="create" id="insert" class="btn btn-success pull-right">Create</button>
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
<!-- bootstrap-daterangepicker -->
<script src="/HPV/vendors/moment/min/moment.min.js"></script>
<script src="/HPV/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
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
<script src="/HPV/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="/HPV/build/js/custom.min.js"></script>
<script srr="/HPV/users/USER/update_data/view-br.js"

</body>
</html>
