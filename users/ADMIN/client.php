<?php 
//placeholder
$output = "";

 
  session_start();
  include '../../dbconnect.php';

   //if (!isset($_SESSION['adminSession'])) 
    if($_SESSION['emplevel'] != 'ADMIN'){
        header ('Location: /HPV/login.php');
    }
    
    $result = $dbcon->query("SELECT * FROM clients");
    $Category = $dbcon->query("SELECT * FROM categories");
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

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  -->
     <script src="/HPV/documentation/js/jquery.min.js"></script>
          
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
                  <li class="active"><a href="client.php"><i class="fa fa-users"></i> Client </a></li>   
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
          
         <!--CONTACT PERSON SCRIPT-->
                       <script>
                              $(document).ready(function(e){
                                                //variables[
                                                var html= '   <div class="itemAdd form-group">  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="childName">Name <span class="required">*</span>   </label>   <div class="col-md-6 col-sm-6 col-xs-12">    <input id="childName" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="contactName[]" placeholder="Fullname" required="required" type="text">   </div>  </div>                                                     <div class="itemAdd form-group">    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contactPos">Position <span class="required">*</span>   </label> <div class="col-md-6 col-sm-6 col-xs-12">      <input id="childPos" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="contactPos[]" placeholder="Position" required="required" type="text">    </div>       </div>                                                                      <div class="itemAdd form-group">     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contactNumber">Contact Number <span class="required">*</span>    </label>  <div class="col-md-3 col-sm-3 col-xs-12">   <input type="tel" id="childNum" name="contactNumber[]" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12"  placeholder="Contact Number">      </div>    <div class="col-md-3 col-sm-3 col-xs-12">    <a type="button" class="btn btn-danger btn-xs"><i id="remove" name="remove" class="glyphicon glyphicon-remove"></i> </a>    </div>    </div>  ';

                                                //add rows to the form

                                                 $("#add").click(function(e){                                       
                                                    $("#container").append(html);

                                                });


                                                //remove rows from the form

                                                $("#container").on('click','#remove',function(e){
                                                    
                                                    $('.itemAdd').last().remove();
                                                    $('.itemAdd').last().remove();
                                                    $('.itemAdd').last().remove();
                                                    
                        
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
                    <h2>Clients</h2>
                     <button type="button" class="btn btn-sm btn-primary pull-right" data-toggle="modal"  data-target="#CreateClientModal" data-placement="top" title="Create Client"><i class="fa fa-plus"></i> Create Client </button>
                    <div class="col-md-3" >
            
                            
                           <!--CREATE MODAL START-->
                              <div id="CreateClientModal" class="modal fade createClient-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                  <div class="modal-content">

                                    <div class="modal-header">
                                      <span class="glyphicon glyphicon-remove pull-right" aria-hidden="true" type="button" data-dismiss="modal" style="font-size:20px;color:#d9534f"></span>    
                                      <h4 class="modal-title" id="myModalLabel">CREATE CLIENT</h4>
                                    </div>
                                    <div class="modal-body">  
                                      
                                          <form id="CreateClientForm" method="POST" class="form-horizontal form-label-left" data-parsley-validate >
                                                
                                                 <div id="SuccessDiv" class="alert alert-success text-center alert-dismissible fade in" role="alert" style="width:200px; margin:0 auto; margin-bottom:5px; display:none" > <p style="color:#fff; font-size:120%; text-align:center" id="Message"></p> 
                                                  </div> 
                                            
                                                   <div id="ErrorDiv" class="alert alert-danger text-center alert-dismissible fade in" role="alert" style="width:250px; margin:0 auto; margin-bottom:5px; display:none" > <p style="color:#fff; font-size:120%; text-align:center" id="ERRMessage"></p> 
                                                   </div>
                                            
                                          
                                              
                                                  <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clientCompName">Company<span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input id="clientCompName" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="clientCompName" placeholder="Company Name" required="required" type="text">
                                                    </div>
                                                  </div>
                                                  <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="compname">Client Code<span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input id="clientcode" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="clientcode" placeholder="Company Code" required="required" type="text" maxlength="3" minlength="3">
                                                    </div>
                                                  </div>
                                                 
                                                
                                                  <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clientCompBranch">Branch<span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input id="clientCompBranch" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="clientCompBranch" placeholder="Company Branch" required="required" type="text">
                                                    </div>
                                                  </div>
                                              
                                                  <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clientCompAddr">Address<span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input id="clientCompAddr" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="clientCompAddr" placeholder="Address" required="required" type="text">
                                                    </div>
                                                  </div>
                                              
                                                 
                                              
                                                  <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clientCompEmail">Contact Email 
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input type="email" id="clientCompEmail" name="clientCompEmail"  placeholder="Contact Email" required="required" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                  </div>
                                              
                                                     
                                                 <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clientCompTel">Telephone 
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input type="tel" id="clientCompTel" name="clientCompTel"  placeholder="Telephone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                  </div>
                                              
                                              
                                              
                                                     
                                                  <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clientCompFax">Fax Number 
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input id="clientCompFax" type="text" name="clientCompFax"  placeholder="Fax Number" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12">
                                                    </div>
                                                  </div>
                                              
                                                  
                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clientNature">Category<span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                       <select id="clientcategory" name = "clientcategory" class="selectpicker form-control" required>
                                                                  <option value="" selected>Please select a category.</option>
                                                           <?php
                                                           if($Category->num_rows > 0) {
                                                               while($row = $Category->fetch_object()) {
                                                                   ?>
                                                                   <option value="<?php echo $row->categoryname ?>"> <?php echo $row->categoryname ?> </option>

                                                                   <?php

                                                               }
                                                           }
                                                           ?>
                                                            
                                                                </select>
                                                       
                                                        </div>
                                                  </div>
                                                    
                                                    <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clientbusiness">Nature of Business<span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input id="clientbusiness" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="clientbusiness" placeholder="Nature of Business" required="required" type="text">
                                                    </div>
                                                  </div>
                                                  <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cleintTerms">Terms<span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                       <select name="clientTerms" id="clientTerms" class="selectpicker form-control" required>
                                                                  <option value="" selected>Please select terms.</option>
                                                                  <option value="30 days">30 days</option>
                                                                  <option value="60 days">60 days</option>
                                                                  <option value="90 days">90 days</option>
                                                                  <option value="120 days">120 days</option>
                                                                  <option value="150 days">150 days</option>
                                                                </select>
                                                       
                                                        </div>
                                                  </div>
                                          
                                               <div class="item form-group">
                                                   <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                    </label>
                                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                                          <h2>CONTACT PERSON </h2>
                                                          <div class="col-md-1 col-sm-1 col-xs-12">
                                                              
                                                               <a type="button" class="btn btn-info btn-xs"><i id="add" name="add" class="glyphicon glyphicon-plus"></i> </a>
                                                       
                                                          </div>
                                                    </div>
                                               </div>
                   
                                           <div id="container">
                                              <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contactName">Name <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                  <input id="contactName" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="contactName[]" placeholder="Fullname" required="required" type="text">
                                                </div>
                                              </div>
                                              
                                              
                                               <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contactPos">Position <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                  <input id="contactPos" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"  name="contactPos[]" placeholder="Position" required="required" type="text">
                                                </div>
                                              </div>
                                                
                                  
                                              
                                                 <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contactNumber">Contact Number <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                      <input type="tel" id="contactNumber" name="contactNumber[]" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12"  placeholder="Contact Number">
                                                    </div>
                                                       
                                                  </div>
                                               
                                              </div>  <!--container end-->
    
                                               
                                                  <div class="ln_solid"></div>
                                                  <div class="form-group">
                                                    <div class="col-md-3 col-md-offset-3">
                                                      
                                                      <button type ="submit" name ="submit" id="insert" class="btn btn-success" >
                                                      Create
                                                    </button>
                                                 
                                                    </div>
                                                    <div class="col-md-3">
                                                  <button type="reset" class="btn btn-warning">
                                                      Clear
                                                  </button>

                                                    </div>
                                                  </div>
                                         
                                        </form> 


                                    </div>
                                  </div>
                                </div>
                              </div>
                   <!--CREATE MODAL END-->
                                   

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
                                    
                                 <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 87.8889px;" aria-sort="ascending" aria-label="First name: activate to sort column descending">Actions
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 84.8889px;" aria-label="Last name: activate to sort column ascending">Client Code
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 84.8889px;" aria-label="Last name: activate to sort column ascending">Name
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 182.889px;" aria-label="Position: activate to sort column ascending">Email
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 81.8889px;" aria-label="Office: activate to sort column ascending">Telephone No
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 79.8889px;" aria-label="Start date: activate to sort column ascending">Category
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 59.8889px;" aria-label="Salary: activate to sort column ascending">Business
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 46.8889px;" aria-label="Extn.: activate to sort column ascending">Terms
                                  </th>
                                  <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 50px;" aria-label="E-mail: activate to sort column ascending"> Status
                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                              <!-- Fetch data from database -->
                              <?php 
                                  while($row = $result->fetch_object()) {
                                  ?>
                                    <tr role="row" class="odd">

<!--
                                           <td><button name="edit" class="btn btn-primary btn-xs edit_data" id="<?php echo $row->clientcode ?>"> <span class="fa fa-edit" aria-hidden="true"></span> Edit
                                                </button> 
-->


                                        <td> <a href='#UpdateClientModal' data-toggle='modal' id="edit" class="btn btn-primary btn-xs edit_data" data-id="<?php echo $row->clientcode ?>"> <span class="fa fa-edit" aria-hidden="true"></span> Edit
                                                </a> 
                                        </td>
                                        <td><?php echo $row->clientcode ?></td>
                                        <td><?php echo $row->clientname ?></td>
                                        <td><?php echo $row->clientemail ?></td>
                                        <td><?php echo $row->clienttelno ?></td>
                                        <td><?php echo $row->clientcategory ?></td>
                                        <td><?php echo $row->clientbusiness ?></td>
                                        <td><?php echo $row->clientterms ?></td>
                                        <td><?php 
                                                
                                          if($row->clientstatus == 'AC')
                                              echo '<input type="button" class="btn-success btn-xs" value='.$row->clientstatus.' />';
                                          else      
                                              echo '<input type="button" class="btn-danger btn-xs" value='.$row->clientstatus.' />';
                                                ?>
                                            
                                            </td>
                                    </tr>
                                  <?php 
                                  }
                                
                                
                              ?>
                              </tbody>
                            </table>
                              <?php
                                echo $output;
                              ?>
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
          <div  class="col-md-6 col-md-offset-3">
                 <?php include '../../footer.php'; ?>
          </div>
         
        </footer>
        <!-- /footer content -->
      </div>
    </div>





<div id="UpdateClientModal" class="modal fade updateClient-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
           <span class="glyphicon glyphicon-remove pull-right" aria-hidden="true" type="button" data-dismiss="modal" style="font-size:20px;color:#d9534f"></span>
          <h4 class="modal-title" id="myModalLabel">Update Client</h4>
        </div>
        <div class="modal-body">

          <div id="Result"></div>



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
    <script src="../ADMIN/insert_data/insert-client.js"></script>
    <script src="../ADMIN/update_data/update-client.js"></script>
    
  </body>
</html>