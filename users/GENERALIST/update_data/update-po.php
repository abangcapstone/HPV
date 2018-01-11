 <?php
 session_start();
 include '../../../dbconnect.php';
 date_default_timezone_set('Asia/Manila');
 require('../../../user_info.php');
 $c_info = new UserInfo;

  if(isset($_POST["po_number"])){
      $query = mysqli_query($dbcon, "SELECT * FROM purchaseorder,clients,companies,contacts,branches WHERE ponumber = '"
          .$_POST["po_number"]."' && poclient = clientcode   && pocompany = compno && compno = branchcode AND pobranch = branchid ");
      $data = mysqli_fetch_array($query);

      $companyRows = $dbcon->query("SELECT * FROM companies");
    }

 ?>
<html>
<head>

    <!-- Custom Theme Style -->
    <link href="/HPV/build/css/custom.min.css" rel="stylesheet">
<!--    <link href="/HPV/build/css/added_style.css" rel="stylesheet">-->
    <!-- bootstrap-datetimepicker -->
    <link href="/HPV/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

</head>

<body>
<form id="UpdateClientForm" method="POST" class="form-horizontal form-label-left" data-parsley-validate >

                                <div id="UpdateDiv" class="alert alert-success text-center alert-dismissible fade in" role="alert" style="width:200px; margin:0 auto; margin-bottom:5px; display:none" >
                                    <p style="color:#fff; font-size:120%; text-align:center" id="UpdateMessage"></p>
                                </div>

                                <div class=" form-group has-feedback">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">PO#:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input id="PONum" name="PONum" type="text" class="form-control
                                        has-feedback-left"
                                        value="<?php echo
                                        $data['ponumber']?>" readonly >
                                        <span class="fa fa-qrcode form-control-feedback left"
                                              aria-hidden="true"></span>
                                    </div>

                                </div>
                                <div class=" form-group has-feedback">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">TO:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <?php
                                        $selectedclient = mysqli_query($dbcon, "SELECT * FROM clients,purchaseorder WHERE ponumber = '"
                                            .$_POST["po_number"]."' && poclient = clientcode ");
                                        $dataselectedclient = mysqli_fetch_array($selectedclient);
                                        $client = mysqli_query($dbcon, "SELECT * FROM clients");
                                         ?>

                                        <select id="update_client" name="update_client" class="selectpicker form-control"
                                                required >
                                            <option value="<?php echo
                                            $dataselectedclient['clientcode']?>" selected><?php echo
                                                $dataselectedclient['clientname']?></option>

                                         <?php
                                                while($dataclient = mysqli_fetch_array($client)) {
                                                    if ($dataselectedclient['clientcode'] == $dataclient['clientcode']) {
                                                    } else{
                                                        ?>
                                                        <option value="<?php echo $dataclient['clientcode'] ?>"> <?php
                                                            echo $dataclient['clientname'] ?> </option>

                                                        <?php
                                                    }

                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Date:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input id="PODate" name="PODate" type="text" class="form-control
                                        has-feedback-left"  value="<?php echo
                                        $data['podate']?>"  >
                                        <span class="fa fa-calendar form-control-feedback left"
                                              aria-hidden="true"></span>
                                    </div>

                                </div>


                                <div class=" form-group has-feedback">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Contact #:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input id="clientContactNum" name="clientContactNum" type="text"
                                               class="form-control has-feedback-left"  value="<?php
                                        echo
                                        $data['clienttelno']?>" readonly >
                                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Address:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text" id="clientAddr" name="clientAddr" class="form-control has-feedback-left"  value="<?php echo
                                        $data['clientaddr']?>" readonly >
                                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                                    </div>



                                </div>


                                <div class="form-group has-feedback">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Fax #:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text"  id="clientFaxNum" name="clientFaxNum" class="form-control has-feedback-left"  value="<?php echo
                                        $data['clientfaxno']?>" readonly >
                                        <span class="fa fa-fax form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Terms:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input type="text" id="clientTerms" name="clientTerms"  class="form-control has-feedback-left"  value="<?php echo
                                        $data['clientterms']?>" readonly >
                                        <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>


                                <div class="form-group has-feedback">
                                    <label class=" control-label col-md-2 col-sm-2 col-xs-9">Contact Person:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <?php
                                        $contact = mysqli_query($dbcon, "SELECT * FROM contacts,clients,purchaseorder WHERE ponumber = '"
                                            .$_POST["po_number"]."' && poclient = clientcode
                                         && clientcode = contactcode ");
                                        ?>

                                        <select id="update_contactPerson" name="update_contactPerson" class="selectpicker
                                        form-control"
                                                required >
                                            <option value="<?php echo
                                            $data['poclientcontact']?>" selected><?php echo
                                                $data['poclientcontact']?></option>

                                            <?php
                                            while($datacontact = mysqli_fetch_array($contact)) {
                                                if ($data['poclientcontact'] == $datacontact['contactname']) {
                                                } else{
                                                    ?>
                                                    <option value="<?php echo $datacontact['contactname'] ?>"> <?php
                                                        echo $datacontact['contactname'] ?> </option>

                                                    <?php
                                                }

                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Reference:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input id="ref" name="ref" type="text" class="form-control has-feedback-left"
                                               value="<?php
                                        echo
                                        $data['poreference']?>"  >
                                        <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>


                                <div class="form-group has-feedback">
                                    <label class="textsize control-label col-md-2 col-sm-2 col-xs-9 ">Requesting Entity:</label >
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <?php
                                        $selectedContact = mysqli_query($dbcon, "SELECT * FROM purchaseorder, companies WHERE ponumber =  '"
                                            .$_POST["po_number"]."' && compno = pocompany");
                                        $dataContact = mysqli_fetch_array($selectedContact);
                                        $comp = mysqli_query($dbcon, "SELECT * FROM companies");

                                        ?>

                                        <select id="update_company" name="update_company" class="selectpicker
                                        form-control"
                                                required >
                                            <option value="<?php echo
                                            $dataContact['compno']?>" selected><?php echo
                                                $dataContact['compname']?></option>

                                            <?php
                                            while($datacomp = mysqli_fetch_array($comp)) {
                                                if ($dataContact['compno'] == $datacomp['compno']) {
                                                } else{
                                                    ?>
                                                    <option value="<?php echo $datacomp['compno'] ?>"> <?php
                                                        echo $datacomp['compname'] ?> </option>

                                                    <?php
                                                }

                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <label class="textsize control-label col-md-2 col-sm-2 col-xs-9 ">Please deliver not later than:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input id="PODateRqst" name="PODateRqst" type="text" class="form-control
                                        has-feedback-left"
                                        value="<?php echo
                                        $data['podaterqst']?>"  >
                                        <span class="fa fa-calendar form-control-feedback left"
                                              aria-hidden="true"></span>
                                    </div>

                                </div>


    <div class="form-group has-feedback">
        <label class="textsize control-label col-md-2 col-sm-2 col-xs-9 ">Branch:</label >
        <div class="col-md-4 col-sm-4 col-xs-9">
            <select id="compbranch" name="compbranch" class="selectpicker form-control" required >
                <option value="<?php echo $data['branchid']?>" selected><?php echo $data['branchloc']; echo " - "; echo $data['branchaddr']  ?></option>

            </select>
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-9">Tel #:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input  readonly id="companyTelNo" name="companyTelNo" value="<?php echo $data['branchtelno'] ?>" type="text" class="form-control has-feedback-left" placeholder="Telephone Number" required>
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

                                    <div class="col-md-3 col-sm-3 col-xs-9 ">
                                        <h2  >DESCRIPTION</h2>
                                    </div>


                                    <div class="col-md-2 col-sm-2 col-xs-9">
                                        <h2 >UNIT PRICE</h2>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-9">
                                        <h2 >AMOUNT</h2>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-9">
                                        <!--<a id= "add" name="add" type="button" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-plus"></span></a>-->
                                    </div>
                                </div>


                                <div id="container">
                                <div class="ln_solid"></div>

                                                <?php
                                                $ctr = 1;
                                                $items = mysqli_query($dbcon,"SELECT * FROM podetails  WHERE poitemcode = '"
                                                    .$_POST["po_number"]."' ");
                                                while($dataitem = mysqli_fetch_array($items))
                                                {
                                                    ?>
                                                    <div class="container">
                                                        <input style="display: none" type="text" class="form-control"  value="<?php echo
                                                        $dataitem['id']?>" id="id" name="id[]" placeholder="Item" required  >
                                                        <div class="col-md-2 col-sm-2 col-xs-9">
                                                            <input type="text" class="form-control"  value="<?php echo
                                                            $dataitem['poitemname']?>" id="item" name="item[]" placeholder="Item" required  >
                                                        </div>

                                                        <div class="col-md-2 col-sm-2 col-xs-9">
                                                            <input type="number" class="form-control"  value="<?php echo
                                                            $dataitem['poitemquantity']?>"  id="quantity" name="quantity[]" placeholder="Quantity" required >
                                                        </div>

                                                        <div class="col-md-3 col-sm-3 col-xs-9">
                                                            <input type="text" class="form-control"  value="<?php echo
                                                            $dataitem['poitemdesc']?>"  id="description" name="description[]" placeholder="Description" required >
                                                        </div>

                                                      <div class="col-md-2 col-sm-2 col-xs-9">
                                                          <input type="text" class="form-control"  value="<?php echo
                                                          $dataitem['poitemprice']?>" id="unitprice" name="unitprice[]" placeholder="Unit Price" required  >
                                                      </div>
                                                      <div class="col-md-2 col-sm-2  col-xs-9">
                                                          <input type="text" class="form-control"  value="<?php echo
                                                          $dataitem['poitemtotal']?>" step="any"  id="amount" name="amount[]" placeholder="Amount" readonly >
                                                      </div>

                                                        <?php
                                                          if($ctr == 1){
                                                        ?>

                                                        <div class="col-md-1 col-sm-1 col-xs-9">
                                                            <a id= "add" name="add" type="button" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-plus"></span></a>
                                                        </div>
                                                <?php
                                                        $ctr++;
                                                    }
                                                    else{
                                                              ?>
                                                        <div class="col-md-1 col-sm-1 col-xs-9">
                                                            <a id= "remove" name="remove" type="button" class="btn  btn-xs btn-danger"><span class="glyphicon glyphicon-minus"></span></a>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                        </div>

                                               <?php
                                                    }
                                                ?>
                                </div>
                              <div class="ln_solid"></div>

                                <div class="form-group has-feedback">

                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Prepared by:</label >
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input id="preparedBy" name="preparedBy" type="text" class="form-control
                                        has-feedback-left"
                                        value="<?php
                                        echo
                                        $data['popreparedby']?>"  readonly >
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    <!--<label class="control-label col-md-2 col-sm-2 col-xs-2 col-md-offset-2
                                    col-sm-offset-2">
                                        GRAND TOTAL: </label >
                                    <div class="col-md-2 col-sm-2 col-xs-9">
                                        <input type="text" class="form-control "  value="<?php /*echo
                                        $data['pototal']*/?>" readonly >

                                    </div>-->

                                </div>
                            <div class="form-group">
                                <div class="ln_solid col-md-12 col-sm-12 col-xs-12"></div>
                                <div class="col-md-4 col-sm-4 col-xs-3 col-md-offset-4 col-sm-offset-4 col-xs-offset-5 ">
                                        <input type="hidden" name="id_holder" id="id_holder" value="<?php echo $data["ponumber"]
                                        ?>" />
                                        <input type="hidden" name="getDetailId" id="getDetailId" value="<?php echo
                                        $dataitem['poitemcode']; ?>" />
                                        <button type ="submit" name ="update" id="update" class="btn btn-success" style="width:100%; height:50px">
                                            <h4>Update PO</h4>
                                        </button>

                                </div>

                            </div>






            </form>




        <!-- jQuery -->
        <script src="/HPV/vendors/jquery/dist/jquery.min.js"></script>

        <!-- bootstrap-datetimepicker -->
        <script src="/HPV/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $(document).ready(function(){
        $('#update_company').change (function(){
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
<script>


    $(document).ready(function(e){
        $('#compbranch').change (function(){
            let comp_code = $('#update_company').val();
            let branch_name = $('#compbranch').val();
            $.ajax({
                url:"../GENERALIST/fetch_data/fetch_info.php",
                method:"POST",
                data:{'comp_code':comp_code, 'branch_name':branch_name},
                dataType:"json",
                success:function(data){
                    $('#companyTelNo').val(data.branchtelno);
                }
            });
        });

    });

</script>

        <script>
            $('#UpdateClientForm').on("submit",function(event) {
                event.preventDefault();

                $.ajax({

                    url:"../GENERALIST/update_data/set-data.php",
                    method:"POST",
                    data:$('#UpdateClientForm').serialize(),
                    beforeSend:function(){
                        $('#update').val("Inserting");

                    },
                    success:function(data){
                        $("#UpdateDiv").show();
                        $("#UpdateMessage").text("Purchase Order Updated");
                        setTimeout(function(){
                            location.reload();
                        }, 700);



                    }
                });

            });
        </script>



        <script>

            $(document).ready(function(e){

                $('#update_client').change (function(){
                    let client_code = $(this).val();

                    $.ajax({
                        url:"../GENERALIST/fetch_data/fetch_contacts.php",
                        method:"POST",
                        data:{client_code:client_code},
                        dataType:"text",
                        success:function(data){
                            $('#update_contactPerson').html(data);

                        }
                    });
                });
            });


        </script>

        <script>

            $(document).ready(function(e){

                $('#update_contactPerson').change (function(){
                    let client_code = $(this).val();
                    $.ajax({
                        url:"../GENERALIST/update_data/update-fetch-contacts.php",
                        method:"POST",
                        data:{client_code:client_code},
                        dataType:"text",
                        success:function(data){
                            $('#clientContactPerson').html(data);

                        }
                    });
                });
            });


        </script>

    <script>


        $(document).ready(function(e){

            $('#update_client').change (function(){
                let client_code = $(this).val();

                $.ajax({
                    url:"../GENERALIST/fetch_data/fetch_info.php",
                    method:"POST",
                    data:{client_code:client_code},
                    dataType:"json",
                    success:function(data){

                        $('#clientAddr').val(data.clientaddr);
                        $('#clientContactNum').val(data.clienttelno);
                        $('#clientFaxNum').val(data.clientfaxno);
                        $('#clientTerms').val(data.clientterms);

                    }
                });

            });

            $('#update_company').change (function(){
                let comp_code = $(this).val();

                $.ajax({
                    url:"../GENERALIST/fetch_data/fetch_info.php",
                    method:"POST",
                    data:{comp_code:comp_code},
                    dataType:"json",
                    success:function(data){

                        $('#companyAddr').val(data.compaddr);
                        $('#companyTelNo').val(data.comptelno);


                    }
                });

            });

        });

    </script>

    <script>
        $(document).ready(function(){
            let inps = document.getElementsByName('quantity[]');
            let quanArray = $('input[name="quantity[]"]');
            let priceArray = $('input[name="unitprice[]"]');
            let amtArray = $('input[name="amount[]"]');
        for(let k = 0; k < inps.length; k++) {
            (function () {
                $(quanArray[k]).keyup(function(){
                    let val = 0;
                    let price = 0;
                    let quantity = 0;
                    quantity = Number($(quanArray.eq(k)).val());
                    price = Number($(priceArray.eq(k)).val());
                    val = price * quantity;
                    $(amtArray[k]).val(val);
                });

                $(priceArray[k]).keyup(function(){
                    let val = 0;
                    let price = 0;
                    let quantity = 0;
                    quantity = Number($(quanArray.eq(k)).val());
                    price = Number($(priceArray.eq(k)).val());
                    val = price * quantity;
                    $(amtArray[k]).val(val);
                });
            })(k);

        }




            let html= '<div class="container"><div class="col-md-2 col-sm-2 col-xs-9" ' +
                'id="added"><input type="text" class="form-control " placeholder="Item" ' +
                'id="item" name="item[]" required></div><div class="col-md-2 col-sm-2 ' +
                'col-xs-9" id="added"> <input type="number" class="form-control " ' +
                'placeholder="Quantity" onkeydown="GetQuantity()" id="quantity" name="quantity[]" '+
                'required></div> <div class="col-md-3 col-sm-3 col-xs-9" id="added"><input type="text" class="form-control " placeholder="Description" id="description" name="description[]" required>  </div>  <div class="col-md-2 col-sm-2 col-xs-9" id="added"><input type="number" step="any" class="form-control " placeholder="Unit Price" id="unitprice" name="unitprice[]" required></div> <div class="col-md-2 col-sm-2 col-xs-9" id="added"> <input type="number"  class="form-control " placeholder="Amount" step="any" id="amount" name="amount[]" readonly> </div> <div class="col-md-1 col-sm-1 col-xs-12" id="added"><a id= "remove" name="remove" type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-minus"></span></a> </div></div>';

            //add rows to the form

            $("#add").click(function(e){
                $("#container").append(html);

            });


            //remove rows from the form

            $("#container").on('click','#remove',function(e){

                $('#added').first().remove();
                $('#added').first().remove();
                $('#added').first().remove();
                $('#added').first().remove();
                $('#added').first().remove();
                $('#added').first().remove();


            });



        });
    </script>

<script>
    function GetQuantity() {
        let inps = document.getElementsByName('quantity[]');
        let quanArray = $('input[name="quantity[]"]');
        let priceArray = $('input[name="unitprice[]"]');
        let amtArray = $('input[name="amount[]"]');
        for(let k = 0; k < inps.length; k++) {
            (function () {
                $(quanArray[k]).keyup(function(){
                    let val = 0;
                    let price = 0;
                    let quantity = 0;
                    quantity = Number($(quanArray.eq(k)).val());
                    price = Number($(priceArray.eq(k)).val());
                    val = price * quantity;
                    $(amtArray[k]).val(val);
                });

                $(priceArray[k]).keyup(function(){
                    let val = 0;
                    let price = 0;
                    let quantity = 0;
                    quantity = Number($(quanArray.eq(k)).val());
                    price = Number($(priceArray.eq(k)).val());
                    val = price * quantity;
                    $(amtArray[k]).val(val);
                });
            })(k);

        }
    }
</script>



</body>
 </html>