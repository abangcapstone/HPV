<?php
session_start();
include "../../../dbconnect.php";
if(isset($_POST["po_number"])){

    $query = mysqli_query($dbcon, "SELECT * FROM purchaseorder,clients,companies,contacts,branches WHERE ponumber = '"
        .$_POST["po_number"]."' && poclient = clientcode   && pocompany = compno && compno =  branchcode && branchid = pobranch");
    $data = mysqli_fetch_array($query);

    $query2 = mysqli_query($dbcon, "SELECT * FROM vouchers ,purchaseorder WHERE voucheridentifier = '"
        .$_POST["po_number"]."' ");
    $voucherdata = mysqli_fetch_array($query2);

}

?>
<html>
<head>
    <!-- Custom Theme Style -->
    <link href="/HPV/build/css/custom.min.css" rel="stylesheet">
    <link href="/HPV/build/css/added_style.css" rel="stylesheet">
</head>

<body>
<form id="UpdateClientForm" method="POST" class="form-horizontal form-label-left" data-parsley-validate >


    <div class=" form-group ">
        <div id="UpdateDiv" class="col-md-3 col-md-offset-5 alert alert-success text-center alert-dismissible fade in"
             role="alert" style="width:200px; display:none"  > <p style="color:#fff; font-size:120%; text-align:center" id="UpdateMessage"></p> </div>
    </div>
    <div class=" form-group has-feedback">
        <label class="control-label col-md-2 col-sm-2 col-xs-9">PO#:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input type="text" class="form-control has-feedback-left"  value="<?php echo
            $data['ponumber']?>" readonly >
            <span class="fa fa-building form-control-feedback left"
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

    <div class="form-group">
        <div class="ln_solid col-md-12 col-sm-12 col-xs-12"></div>
        <input type="hidden" name="id_holder" id="id_holder" value="<?php echo $data["ponumber"]
        ?>" />
        <input type="hidden" name="getDetailId" id="getDetailId" value="<?php echo
        $dataitem['poitemcode']; ?>" />
        <?php
        $holder = $voucherdata['voucheridentifier'];
        $query = $dbcon->query("SELECT * FROM podelivery WHERE pono = '$holder'");
        $query2 = $dbcon->query("SELECT * FROM vouchers WHERE voucheridentifier = '$holder'");

        if($data["postatus"] == "PENDING") {
            ?>
            <div style="text-align: center;">
                <button type ="submit" name ="update" id="update" class="btn btn-success" style="width:25%; height:50px">
                    <h4>Approve PO</h4>
                </button>
            </div>
            <?php
        }
        else if($query2->num_rows == 0 && $data['postatus'] == "APPROVED" && $data['popaymentstatus'] != 'PROCESSING'   ) {
            ?>
            <div style="text-align: center">
                <a class="btn btn-warning" style="width:25%; height:50px" href="po_vouchers.php"><h2>Create Voucher</h2></a>
            </div>
            <?php
        }

        else if($query->num_rows == 0 && $data['postatus'] == "APPROVED" && $data['popaymentstatus'] == 'PROCESSING') {
            ?>
            <div>
                <label class="control-label col-md-3 col-sm-2 col-xs-9">Date delivered: </label >
                <div class="col-md-3 col-sm-3  col-xs-9">
                    <input type="date" class=" form-control " id="dateDelivered" name="dateDelivered" required>
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-9">Deliver by: </label >
                <div class="col-md-3 col-sm-3 col-xs-9">
                    <input type="text" class=" form-control " id="nameDeliveree" name="nameDeliveree">
                </div>
            </div>
            <div style="text-align: center; margin-top: 90px">
                <a class="btn btn-info" id="update2" name="update2"
                   style="width:25%; height:50px " "> <h2> Issue Delivery Date </h2>
                </a>
            </div>
            <?php
        }
        else if($_POST["po_number"] == $voucherdata['voucheridentifier'] && $query->num_rows > 0)
        {
            $holder = $voucherdata['voucherno'];
            if($voucherdata['vouchertype'] == 'CASH' && $voucherdata['voucherstatus'] == 'PRINT') {
                ?>
                <div style="text-align: center">
                    <a target="_blank" href="../fpdf/purchaseorder_cashvoucher.php<?php echo '?code='
                        . base64_encode($voucherdata['voucherno']); ?>" class="btn btn-success"
                       style="width:25%; height:50px " "> <h2> Print Cash Voucher </h2>
                    </a>
                </div>
                <?php
            }
            else if($voucherdata['vouchertype'] == 'CASH' && $voucherdata['voucherstatus'] == 'REPRINT')
            {
                ?>
                <div style="text-align: center">
                    <a target="_blank" href="../fpdf/purchaseorder_cashvoucher.php<?php echo '?code='
                        . base64_encode($voucherdata['voucherno']); ?>" class="btn btn-warning"
                       style="width:25%; height:50px " "> <h2> Reprint Cash Voucher </h2>
                    </a>
                </div>
                <?php
            }
            else if($voucherdata['vouchertype'] == 'CHECK' && $voucherdata['voucherstatus'] == 'PRINT')
            {
                ?>
                <div style="text-align: center">
                    <a target="_blank" href="../fpdf/purchaseorder_checkvoucher.php<?php echo '?code='
                        . base64_encode($voucherdata['voucherno']); ?>" class="btn btn-success"
                       style="width:25%; height:50px " "> <h2> Print Check Voucher </h2>
                    </a>
                </div>
                <?php
            }
            else if($voucherdata['vouchertype'] == 'CHECK' && $voucherdata['voucherstatus'] == 'REPRINT') {
                ?>
                <div style="text-align: center">
                    <a target="_blank" href="../fpdf/purchaseorder_checkvoucher.php<?php echo '?code='
                        . base64_encode($voucherdata['voucherno']); ?>" class="btn btn-warning"
                       style="width:25%; height:50px " "> <h2> Reprint Check Voucher </h2>
                    </a>
                </div>
                <?php
            }
        }

        ?>
    </div>
</form>

</body>
<script >
    $('#viewItems').change (function(){
        var item_name = $(this).val();

        $.ajax({
            url:"../ACCOUNTING/update_data/fetch-items.php",
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

    $('#update2').click (function() {
        $.ajax({
            url:"../ACCOUNTING/update_data/update-podelivery.php",
            method:"POST",
            data:$('#UpdateClientForm').serialize(),
            beforeSend:function() {
                $('#update2').val("Inserting");
            },
            success:function (data) {
                $("#UpdateDiv").show();
                $("#UpdateMessage").text("Purchase Order Delivered");
                setTimeout(function(){
                    location.reload();
                }, 500);
            }
        });
    });
</script>
<script>
    $('#UpdateClientForm').on("submit",function(event) {
        event.preventDefault();

        $.ajax({

            url:"../ACCOUNTING/update_data/update-po.php",
            method:"POST",
            data:$('#UpdateClientForm').serialize(),
            beforeSend:function(){
                $('#update').val("Inserting");

            },
            success:function(data){
                $("#UpdateDiv").show();
                $("#UpdateMessage").text("Purchase Order Approved");
                setTimeout(function(){
                    location.reload();
                }, 500);
            }
        });
    });
</script>


</html>