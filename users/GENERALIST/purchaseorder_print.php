<?php 
  session_start();
  include '../../dbconnect.php';

   //if (!isset($_SESSION['adminSession'])) 
    if($_SESSION['emplevel'] != 'Generalist'){
        header ('Location: /HPV/login.php');
    }

    $query = $dbcon->query("SELECT count(id) as total FROM purchaseorder");
    $values = mysqli_fetch_assoc($query);
    $numofPO = $values['total'];

    $result = $dbcon->query("SELECT * FROM purchaseorder, companies, clients WHERE compno = pocompany AND clientcode = poclient");
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
    <!-- Datatables -->
    <link href="/HPV/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/HPV/build/css/custom.min.css" rel="stylesheet">
<!--      <link href="/HPV/build/css/added_style.css" rel="stylesheet">-->
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
                  <li><a href="purchaseorder.php"><i class="fa fa-building-o"></i> Purchase Order </a></li>
                  <li class="active"><a href="purchaseorder_print.php"><i class="fa fa-print"></i> Print  <span
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
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Created Purchase Order</h2>
                          <div class="col-md-3" >
                              </div>
                                 <div class="clearfix"></div>
                      </div>
                <form method="POST" >
                  <div class="x_content">
                      <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                          <div class="row">
                          </div>
                        
                          <div class="row"><div class="col-sm-12">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                              <thead>
                                <tr role="row">
                                    
                                 <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 50px;" aria-sort="ascending" aria-label="First name: activate to sort column descending">Actions
                                  </th>
                                  
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 50px;" aria-label="PO Number: activate to sort column ascending">PO Number
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 84.8889px;" aria-label="Client: activate to sort column ascending">Client
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 182.889px;" aria-label="Subject: activate to sort column ascending">Subject
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 81.8889px;" aria-label="Date: activate to sort column ascending">Date
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 81.8889px;" aria-label="Amount: activate to sort column ascending">Amount
                                  </th>
                                 <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 81.8889px;" aria-label="Amount: activate to sort column ascending">Status
                                  </th>
                                  
                                 
                                
                                </tr>
                              </thead>
                              <tbody>
                              <!-- Fetch data from database -->
                              <?php 
                                
                                  while($row = $result->fetch_object()) {
                                  ?>
                                    <tr role="row" class="odd">
                                        
                                        
                                       <td>
                                            <a target="_blank" href="../fpdf/pdf_purchaseorder.php<?php echo '?code='.base64_encode($row->ponumber); ?>"   class="btn btn-primary btn-xs "> <span class="fa fa-print" aria-hidden="true"></span> Print
                                            </a>
                                           <?php
                                           if($row->postatus == 'APPROVED')
                                           echo '<a type ="button" href=\'#ViewPoModal\' data-toggle=\'modal\' id="edit" class="btn
                                            btn-primary btn-xs view_data" data-id=' .$row->ponumber .' > <span class="fa fa-eye" aria-hidden="true"></span> 
                                              View </a> ';
                                           else
                                           echo '<a type ="button" href=\'#ViewPoModal\' data-toggle=\'modal\' id="edit" class="btn
                                            btn-primary btn-xs edit_data"  data-id=' .$row->ponumber .' > <span 
                                            class="fa fa-cogs" aria-hidden="true"></span> 
                                              Edit </a> ';
                                           ?>


                                       </td>
                                        <td><?php echo $row->ponumber ?>







                                        </td>
                                        <td><?php echo $row->clientname ?></td>
                                        <td><?php echo $row->compname ?></td>
                                        <td><?php echo $row->podate ?></td>
                                        <td><?php echo $row->pototal ?></td>
                                        <td><?php 
                                                
                                          if($row->postatus == 'APPROVED')
                                              echo '<input type="button" class="btn-success btn-xs" value='.$row->postatus.' />';
                                          else      
                                              echo '<input type="button" class="btn-warning btn-xs" value='
                                                  .$row->postatus.' />';
                                                ?>
                                            
                                            </td>
                                    </tr>
                                  <?php 
                                  }
                                
                                
                              ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                  </div>
                 </form>
                </div>
              </div>
            </div>
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
    <script src="../GENERALIST/view_data/view-po.js"></script>
    <script src="../GENERALIST/update_data/update-po.js"></script>


    
  </body>
</html>



