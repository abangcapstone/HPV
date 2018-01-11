<?php 
  session_start();
  include '../../dbconnect.php';
 
 //if (!isset($_SESSION['adminSession'])) 
    if($_SESSION['emplevel'] != 'ADMIN'){
        header ('Location: HPV/login.php');
    }

  $result = $dbcon->query("SELECT * FROM employees");
  

    
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
    <!-- Boostrap File Input -->
   <!-- <link href="../documentation/fileinput/css/fileinput.min.css" rel="stylesheet">-->
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
                     
                  <li class="active"><a href="user.php"><i class="fa fa-user"></i> User </a></li>
                 <li ><a href="client.php"><i class="fa fa-users"></i> Client </a></li> 
                  <li ><a href="company.php"><i class="fa fa-building"></i> Company </a></li> 
                  <li ><a href="branch.php"><i class="fa fa-map-marker"></i> Branch </a></li> 
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
                    <h2>Users</h2>
                     <button type="button" class="btn btn-sm btn-primary pull-right" data-toggle="modal"  data-target="#CreateUserModal" data-placement="top" title="Create User"><i class="fa fa-plus"></i> Create User </button>
                      
              <div class="col-md-3" >                    
                            
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
                                    
                                 <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 50px;" aria-sort="ascending" aria-label="First name: activate to sort column descending">Action
                                  </th> 
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 50px;" aria-label="Last name: activate to sort column ascending">Employee Code
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 84.8889px;" aria-label="Last name: activate to sort column ascending">Firstname
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 182.889px;" aria-label="Position: activate to sort column ascending">Lastname
                                  </th>
                                  
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 79.8889px;" aria-label="Start date: activate to sort column ascending">Company
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 59.8889px;" aria-label="Salary: activate to sort column ascending">Position
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 46.8889px;" aria-label="Extn.: activate to sort column ascending" align="center">Status
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
                                                
                                                <button name="edit" class="btn btn-primary btn-xs edit_data" data-id="<?php echo $row->empcode ?>"> <span class="fa fa-edit" aria-hidden="true"></span> Edit
                                                </button>
                                            </td>
                                            <td><?php echo $row->empcode ?></td>
                                            <td tabindex="0" class="sorting_1"><?php echo $row->empfname ?></td>
                                            <td><?php echo $row->emplname ?></td>
                                            <td><?php echo $row->empcompany ?></td>
                                            <td><?php echo $row->emppos ?></td>
                                            <td><?php 
                                                
                                          if($row->empstatus == 'AC')
                                            
                                              echo '<input type="button" class="btn-success btn-xs" value='.$row->empstatus.' />';
                                          else      
                                              echo '<input type="button" class="btn-danger btn-xs" value='.$row->empstatus.' />';
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
    
    <!-- File input -->
    <!--<script src="../documentation/fileinput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script> -->   
    <script src="/HPV/documentation/fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>  
    <script src="/HPV/documentation/fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
    <script src="/HPV/documentation/fileinput/js/fileinput.min.js"></script>
      
      
    <!-- Custom Theme Scripts -->
    <script src="/HPV/build/js/custom.min.js"></script>
    <!-- Insert User Script -->
    <script src="../ADMIN/insert_data/insert-user.js"></script>
    <script src="../ADMIN/update_data/update-user.js"></script>
  
    
    <script>
      $(document).ready(function(){
                        $('#userCompany').change (function(){
                  var comp_code = $(this).val();
        $.ajax({
          url:"../ADMIN/update_data/fetch-branch.php",
          method:"POST",
          data:{comp_code:comp_code},
          dataType:"text",
          success:function(data){
            $('#userBranch').html(data);
          }
        });
      });
                        });
    </script>
  </body>
</html>

                           
<!--CREATE MODAL START-->
<div id="CreateUserModal" class="modal fade createUser-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<span class="glyphicon glyphicon-remove pull-right" aria-hidden="true" type="button" data-dismiss="modal" style="font-size:20px;color:#d9534f"></span>
				<h4 class="modal-title" id="myModalLabel">CREATE USER</h4>
			</div>
			<div class="modal-body">
				<!--     FORM  START      -->
				<form class="form-horizontal form-label-left" method="post" id="CreateUserForm" data-parsley-validate>
					<div id="SuccessDiv" class="alert alert-success text-center alert-dismissible fade in" role="alert" style="width:200px; margin:0 auto; margin-bottom:5px; display:none" >
						<p style="color:#fff; font-size:120%; text-align:center" id="Message"></p>
					</div>
					<div id="ErrorDiv" class="alert alert-danger text-center alert-dismissible fade in" role="alert" style="width:250px; margin:0 auto; margin-bottom:5px; display:none" >
						<p style="color:#fff; font-size:120%; text-align:center" id="ERRMessage"></p>
					</div>
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="userCompany">Company
							<span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select id="userCompany" name="userCompany" class="selectpicker form-control" required >
								<option value="" selected>Please select company.</option>
								<?php
                                                                  $compRows = $dbcon->query("SELECT * FROM companies");
                                                                    if($compRows->num_rows > 0) {
                                                                      while($row = $compRows->fetch_object()) {
                                                                      ?>
                                                                          <?php if($row->compstatus="AC") { ?>
                                                                          <option value="<?php echo $row->compno ?>">
                                                                              <?php echo $row->compname ?>
                                                                          </option>
                                                                              <?php } ?>
                                                                          <?php
                                                                      }
                                                                    }
                                                                  ?>
							</select>
						</div>
					</div>
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="userBranch">Branch
							<span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select id="userBranch" name="userBranch" class="selectpicker form-control"required >
                                <option value="">Please select a branch.</option>
							</select>
						</div>
					</div>
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="userFName">Firstname
							<span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input id="userFName" name="userFName" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" placeholder="First Name" required="required" type="text">
							</div>
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lastname
								<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input id="userLName" name="userLName" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="name" placeholder="Lastname" required="required" type="text">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="userPos">Position
									<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="userPos" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="userPos" placeholder="Position" required="required" type="text">
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="userlevel">User Level
										<span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select id= "userlevel" name="userlevel" class="selectpicker form-control" required >
											<option value="" selected>Please select user level.</option>
											<option value="ADMIN">ADMIN</option>
                                            <option value="Accounting">Accounting</option>
                                            <option value="CEO">CEO</option>
                                            <option value="COO">COO</option>
											<option value="Finance">Finance</option>
                                            <option value="Generalist">Generalist</option>
                                            <option value="User">User</option>
										</select>
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
										<span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="email" id="email" name="email" placeholder="Email" required="required" class="form-control col-md-7 col-xs-12">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username
											<span class="required">*</span>
										</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="username" name="username" placeholder="Username" required="required" class="form-control col-md-7 col-xs-12">
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="form-group">
											<div class="col-md-3 col-sm-3 col-xs-6 col-md-offset-3 col-sm-offset-3">
												<button name="create" id="create" type="submit" class="btn btn-success">

                                                      Create
                                                    </button>
												<br/>
												<br/>
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




<!-- Update Modal -->
<div id="UpdateUserModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="glyphicon glyphicon-remove pull-right" aria-hidden="true" type="button" data-dismiss="modal" style="font-size:20px;color:#d9534f"></span>
                <h4 class="modal-title">Update Employee</h4>
            </div>
            <div class="modal-body">
                <div id="Result"></div>
            </div>
        </div>
    </div>
</div>
<!-- End Update Modal -->