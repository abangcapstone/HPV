<?php 
  session_start();
  include '../../dbconnect.php';

   //if (!isset($_SESSION['adminSession'])) 
    if($_SESSION['emplevel'] != 'ADMIN'){
        header ('Location: /HPV/login.php');
    }

 
  $compRows = $dbcon->query("SELECT * FROM companies");
  $result = $dbcon->query("SELECT * FROM branches");

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
                  <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li> 
                  <li><a href="user.php"><i class="fa fa-user"></i> User </a></li>
                <li><a href="client.php"><i class="fa fa-users"></i> Client </a></li>     
                  <li><a href="company.php"><i class="fa fa-building"></i> Company </a></li>
                 <li class="active"><a href="branch.php"><i class="fa fa-map-marker"></i> Branch </a></li>
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
                    <?php echo '<img src="'.$_SESSION['empimage'].'">' ?><?php echo $_SESSION['empfname']; ?>
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
                <div class="x_panel">
                  <div class="x_title">
                    <button type="button" class="btn btn-sm btn-primary pull-right" data-toggle="modal"  data-target="#CreateBranchModal" data-placement="top" title="Create Branch"><i class="fa fa-plus"></i> Add Branch </button>
                    <h2>Branches</h2>
                    <div class="col-md-3" >
                       <!--MODAL START-->


                           <!--CREATE MODAL START-->
                              <div id="CreateBranchModal" class="modal fade createBranch-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                  <div class="modal-content">

                                    <div class="modal-header">
                                       <span class="glyphicon glyphicon-remove pull-right" aria-hidden="true" type="button" data-dismiss="modal" style="font-size:20px;color:#d9534f"></span>
                                      <h4 class="modal-title" id="myModalLabel"> ADD BRANCH </h4>
                                    </div>
                                    <div class="modal-body">
                            <!--     FORM  START      -->
                                          <form id="CreateBranchForm" method="post" class="form-horizontal form-label-left" data-parsley-validate >


                                                  <div id="SuccessDiv" class="alert alert-success text-center alert-dismissible fade in" role="alert" style="width:200px; margin:0 auto; margin-bottom:5px; display:none" > <p style="color:#fff; font-size:120%; text-align:center" id="Message"></p>
                                                  </div>

                                                   <div id="ErrorDiv" class="alert alert-danger text-center alert-dismissible fade in" role="alert" style="width:250px; margin:0 auto; margin-bottom:5px; display:none" > <p style="color:#fff; font-size:120%; text-align:center" id="ERRMessage"></p>
                                                   </div>


                                                  <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="compname">Company Name<span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <select id="compname" name="compname" class="selectpicker form-control" required >
                                                                  <option value="" selected>Please select company.</option>
                                                                  <?php
                                                                    if($compRows->num_rows > 0) {
                                                                      while($row = $compRows->fetch_object()) {
                                                                      ?>
                                                                        <option value="<?php echo $row->compno ?>"> <?php echo $row->compname ?> </option>

                                                                  <?php

                                                                      }

                                                                    }
                                                                  ?>
                                                                </select>
                                                    </div>
                                                  </div>



                                                  <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="compbranch">Branch Location<span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input id="compbranch" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="compbranch" placeholder="Branch Location" required="required" type="text">
                                                    </div>
                                                  </div>
                                              <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="compaddr">Branch Address<span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input id="compaddr" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="compaddr" placeholder="Address" required="required" type="text">
                                                    </div>
                                                  </div>



                                                  <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="compemail">Branch Email
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input type="email" id="compemail" name="compemail"  placeholder="Contact Email" required="required" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                  </div>


                                                 <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="comptelno">Telephone
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input type="tel" id="comptelno" name="comptelno"  placeholder="Telephone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                  </div>




                                                  <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="compfaxno">Fax Number
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input id="compfaxno" type="text" name="compfaxno"  placeholder="Fax Number" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12">
                                                    </div>
                                                  </div>




                                                   <div class="ln_solid"></div>
                                                  <div class="form-group">

                                                 <div class="col-md-3 col-sm-3 col-xs-6 col-md-offset-3 col-sm-offset-3" >

                                                     <button name="create" id="create" type="submit" class="btn btn-success">
                                                      Create
                                                    </button>

                                                 </div>
                                               <div class="col-md-3 col-sm-3 col-xs-6">
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
                            <!--CREATE MODAL END-->

                  <!--MODAL END-->
                      </div>
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
                                    
                                 <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 50px;" aria-sort="ascending" aria-label="First name: activate to sort column descending">Actions
                                  </th>
                                

                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 30px;" aria-label="Last name: activate to sort column ascending">Company Name
                                    </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 10px;" aria-label="Last name: activate to sort column ascending">Location
                                  </th>
                                  
                                   <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 10px;" aria-label="Last name: activate to sort column ascending">Address
                                  </th>

                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 40px;" aria-label="Office: activate to sort column ascending">Telephone No
                                  </th>
                                 
                                 
                                 
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 40px;" aria-label="E-mail: activate to sort column ascending">Status
                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                              <!-- Fetch data from database -->
                              <?php 
                                if($result->num_rows > 0) {
                                  while($row = $result->fetch_object()) {
                                    $temp = $row->branchcode;
                                  ?>
                                    <tr role="row" class="odd">
                                       
                                      <td><button name="edit" class="btn btn-primary btn-xs edit_data" id="<?php echo $row->id ?>"> <span class="fa fa-edit" aria-hidden="true"></span> Edit
                                                </button></td>
                                      

                                        <td>
                                            <?php
                                            $Temp=$row->branchcode;
                                            $sql = $dbcon->query("SELECT * FROM companies WHERE compno = '$Temp'");
                                            $CompName = $sql->fetch_object();
                                            echo $CompName->compname
                                            ?>

                                        </td>
                                        <td><?php echo $row->branchloc ?></td>
                                        <td><?php echo $row->branchaddr ?></td>

                                        <td><?php echo $row->branchtelno ?></td>
                                      
                                       
                                        
                                        <?php
                                                if($row->branchstatus == 'AC'){
                                            ?>
                                          <td><a class="btn btn-success btn-xs"> AC </a></td>
                                          <?php
                                                }
                                                else {
                                          ?>
                                          <td> <a class="btn btn-danger btn-xs"> IN </a> </td>
                                          <?php
                                                }
                                          ?>
                                    </tr>
                                  <?php 
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
    <script src="../ADMIN/insert_data/insert-branch.js"></script>
    <script src="../ADMIN/update_data/update-branch.js"></script>
  </body>
</html>

<div id="UpdateBranchModal" class="modal fade" role="dialog">
                     <div class="modal-dialog">
                      <div class="modal-content">
                       <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Branch</h4>
                       </div>
                       <div class="modal-body" id="employee_detail">
                            <form id="UpdateBranchForm" method="post" class="form-horizontal form-label-left" data-parsley-validate >
                                                
                                               <div id="UpdateDiv" class="alert alert-success text-center alert-dismissible fade in" role="alert" style="width:200px; margin:0 auto; margin-bottom:5px; display:none" > <p style="color:#fff; font-size:120%; text-align:center" id="UpdateMessage"></p> </div> 
                                                   
                                                    <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branchcode">Branch Code<span class="required" ></span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input id="branchcode" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="branchcode" required="required" type="text" readonly>
                                                    </div>
                                                   </div> 
                                                    
                                                  <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="update_branchloc">Branch Location<span class="required"></span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input id="update_branchloc" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="update_branchloc" placeholder="Branch Location" required="required" type="text">
                                                    </div>
                                                  </div>
                                              
                                                
                                                
                                                  <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="update_branchaddr">Branch Address<span class="required"></span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input id="update_branchaddr" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="update_branchaddr" placeholder="Branch Address" required="required" type="text">
                                                    </div>
                                                  </div>
                                              
                                                 
                                              
                                                  <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="update_branchemail">Company Email 
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input type="email" id="update_branchemail" name="update_branchemail"  placeholder="Contact Email" required="required" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                  </div>
                                              
                                                     
                                                 <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="update_branchtelno">Telephone 
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input type="tel" id="update_branchtelno" name="update_branchtelno"  placeholder="Telephone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                  </div>
                                              
                                              
                                              
                                                     
                                                  <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="update_branchfaxno">Fax Number 
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input id="update_branchfaxno" type="text" name="update_branchfaxno"  placeholder="Fax Number" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12">
                                                    </div>
                                                  </div>
                                
                                                 <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="update_branchstatus">Status <span class="required"></span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                       <select id="update_branchstatus" name="update_branchstatus" class="selectpicker form-control"required >      
                                                                  <option value="AC" selected>Active</option>
                                                                  <option  value="IN" >Inactive</option>
                                                                                                                       
                                                                </select>
                                                       
                                                        </div>
                                                  </div>
                                              
                                      
                                                  
                                             
                                                   <div class="ln_solid"></div>
                                                  <div class="form-group">
                                                      
                                                 <div class="col-md-2 col-sm-2 col-xs-1 col-md-offset-7 col-sm-offset-7 col-xs-offset-8" >
                                                      <input type="hidden" name="id_holder" id="id_holder" />
                                                     <button name="update" id="update" type="submit" class="btn btn-success">
                                                      Update
                                                    </button>
                                                     
                                                 </div>
                                              
                                              </div>
 
                                </form> 
                                
                       </div>
                       
                      </div>
                     </div>
                    </div>
