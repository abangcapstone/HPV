 <?php  
  session_start();
 include "../../../dbconnect.php";
  if(isset($_POST["po_number"])){
      /*$query = "SELECT * FROM purchaseorder WHERE ponumber = '".$_POST["po_number"]."'";
      $result = mysqli_query($dbcon, $query);
      $porow = mysqli_fetch_array($result);
      $detailrow = $dbcon->query("SELECT * FROM podetails ");
      $queryRow = $dbcon->query("SELECT * FROM podetails WHERE poitemcode = '".$_POST["po_number"]."'");
                      $itemrow = mysqli_fetch_array($queryRow); */
      $query = mysqli_query($dbcon, "SELECT * FROM purchaseorder,clients,companies,contacts,branches WHERE ponumber = '"
          .$_POST["po_number"]."' && poclient = clientcode   && pocompany = compno && compno = branchcode && branchid = pobranch");
      $data = mysqli_fetch_array($query);

    }

 ?>
<html>
<head>
    <!-- Custom Theme Style -->
    <link href="/HPV/build/css/custom.min.css" rel="stylesheet">
<!--    <link href="/HPV/build/css/added_style.css" rel="stylesheet">-->
</head>

<body>
<form id="UpdateClientForm" method="POST" class="form-horizontal form-label-left" data-parsley-validate >

                                <div class=" form-group has-feedback">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">PO#:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text" class="form-control has-feedback-left"  value="<?php echo
                                        $data['ponumber']?>" readonly >
                                        <span class="fa fa-qrcode form-control-feedback left"
                                              aria-hidden="true"></span>
                                    </div>

                                </div>
                                <div class=" form-group has-feedback">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">TO:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text" class="form-control has-feedback-left"  value="<?php echo
                                        $data['clientname']?>" readonly >
                                        <span class="fa fa-building form-control-feedback left"
                                              aria-hidden="true"></span>
                                    </div>
                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Date:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text" class="form-control has-feedback-left"  value="<?php echo
                                        $data['podate']?>" readonly >
                                        <span class="fa fa-calendar form-control-feedback left"
                                              aria-hidden="true"></span>
                                    </div>

                                </div>


                                <div class=" form-group has-feedback">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Contact #:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text" class="form-control has-feedback-left"  value="<?php echo
                                        $data['clienttelno']?>" readonly >
                                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Address:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text" class="form-control has-feedback-left"  value="<?php echo
                                        $data['clientaddr']?>" readonly >
                                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                                    </div>



                                </div>


                                <div class="form-group has-feedback">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Fax #:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text" class="form-control has-feedback-left"  value="<?php echo
                                        $data['clientfaxno']?>" readonly >
                                        <span class="fa fa-fax form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Terms:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text" class="form-control has-feedback-left"  value="<?php echo
                                        $data['clientterms']?>" readonly >
                                        <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>


                                <div class="form-group has-feedback">
                                    <label class=" control-label col-md-2 col-sm-2 col-xs-9">Contact Person:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text" class="form-control has-feedback-left"  value="<?php echo
                                        $data['poclientcontact']?>" readonly >
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Reference:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text" class="form-control has-feedback-left"  value="<?php echo
                                        $data['poreference']?>" readonly >
                                        <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>


                                <div class="form-group has-feedback">
                                    <label class="textsize control-label col-md-2 col-sm-2 col-xs-9 ">Requesting Entity:</label >
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text" class="form-control has-feedback-left"  value="<?php echo
                                        $data['compname']?>" readonly >
                                        <span class="fa fa-building form-control-feedback left"
                                              aria-hidden="true"></span>
                                    </div>
                                    <label class="textsize control-label col-md-2 col-sm-2 col-xs-9 ">Please deliver not later than:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text" class="form-control has-feedback-left"  value="<?php echo
                                        $data['podaterqst']?>" readonly >
                                        <span class="fa fa-calendar form-control-feedback left"
                                              aria-hidden="true"></span>
                                    </div>

                                </div>


                                <div class="form-group has-feedback">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Address:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text" class="form-control has-feedback-left"  value="<?php echo
                                        $data['branchaddr']?>" readonly >
                                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Tel #:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text" class="form-control has-feedback-left"  value="<?php echo
                                        $data['branchtelno']?>" readonly >
                                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>


                                <div class="ln_solid"></div>
                                <div class="form-group ">

                                    <div class="col-md-2 col-sm-2 col-xs-9">
                                        <h2 >ITEM</h2>
                                    </div>

                                    <div class="col-md-2 col-sm-2 col-xs-9">
                                        <h2 >QUANTITY</h2>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-xs-9 ">
                                        <h2  >DESCRIPTION</h2>
                                    </div>


                                    <div class="col-md-2 col-sm-2 col-xs-9">
                                        <h2 >UNIT PRICE</h2>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-9">
                                        <h2 >AMOUNT</h2>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>

                                                <?php
                                                $items = mysqli_query($dbcon,"SELECT * FROM podetails  WHERE poitemcode = '"
                                                    .$_POST["po_number"]."' ");
                                                while($dataitem = mysqli_fetch_array($items))
                                                {
                                                    ?>
                                                    <div class="container ">
                                                        <div class="col-md-2 col-sm-2 col-xs-9">
                                                            <input type="text" class="form-control"  value="<?php echo
                                                            $dataitem['poitemname']?>" readonly >
                                                        </div>

                                                        <div class="col-md-2 col-sm-2 col-xs-9">
                                                            <input type="text" class="form-control"  value="<?php echo
                                                            $dataitem['poitemquantity']?>" readonly >
                                                        </div>

                                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                                            <input type="text" class="form-control"  value="<?php echo
                                                            $dataitem['poitemdesc']?>" readonly >
                                                        </div>

                                                      <div class="col-md-2 col-sm-2 col-xs-9">
                                                          <input type="text" class="form-control"  value="<?php echo
                                                          $dataitem['poitemprice']?>" readonly >
                                                      </div>
                                                      <div class="col-md-2 col-sm-2  col-xs-9">
                                                          <input type="text" class="form-control"  value="<?php echo
                                                          $dataitem['poitemtotal']?>" readonly >
                                                      </div>


                                                 </div>


                                                <?php
                                                }
                                                ?>

                              <div class="ln_solid"></div>

                                <div class="form-group has-feedback">

                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Prepared by:</label >
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text" class="form-control has-feedback-left"  value="<?php echo
                                        $data['popreparedby']?>" readonly >
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    <label class="control-label col-md-2 col-sm-2 col-xs-2 col-md-offset-2
                                    col-sm-offset-2">
                                        GRAND TOTAL: </label >
                                    <div class="col-md-2 col-sm-2 col-xs-9">
                                        <input type="text" class="form-control "  value="<?php echo
                                        $data['pototal']?>" readonly >
                                    </div>

                                </div>





            </form> 

  </body>
  <script > 
$('#viewItems').change (function(){
                  var item_name = $(this).val();
                         
        $.ajax({
         url:"../GENERALIST/fetch_data/fetch-items.php",
          method:"POST",
          data:{item_name:item_name},
          dataType:"json",
          success:function(data){
            $('#item_name').val(data.poitemname);
            $('#item_qty').val(data.poitemquantity);
            $('#item_price').val(data.poitemprice);
            $('#item_total').val(data.poitemtotal);
            $('#getDetailId').val(data.id);
           
            
          }
        });
      });
    </script> 
  
  
  

 </html>