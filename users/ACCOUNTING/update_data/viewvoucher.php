<?php
session_start();
include "../../../dbconnect.php";
if(isset($_POST["voucher_code"])) {
    $query = mysqli_query($dbcon, "SELECT * FROM vouchers WHERE voucherno =  '"
        . $_POST["voucher_code"] . "'");
    $data = mysqli_fetch_array($query);
    $bool = 0;
}
?>
<html>
<head>
    <!-- Custom Theme Style -->
    <link href="/HPV/build/css/custom.min.css" rel="stylesheet">
    <!--    <link href="/HPV/build/css/added_style.css" rel="stylesheet">-->
</head>

<body>
<form class="form-horizontal form-label-left " method="POST" id="UpdatePDCForm">
    <div class=" form-group ">
        <div id="UpdateDiv" class="col-md-3 col-md-offset-5 alert alert-success text-center alert-dismissible fade in"
             role="alert" style="width:200px; display:none"  > <p style="color:#fff; font-size:120%; text-align:center" id="UpdateMessage"></p> </div>
    </div>

    <div class=" form-group has-feedback">
        <label class="control-label col-md-1 col-sm-2 col-xs-9">Identifier:</label>
        <div class="col-md-3 col-sm-3 col-xs-9">
            <input id="voucherNo" name="voucherNo" type="text" class="form-control" value="<?php echo $data['voucheridentifier'] ?>" readonly>
        </div>
        <label class="control-label col-md-1 col-sm-2 col-xs-9">Type:</label>
        <div class="col-md-3 col-sm-3 col-xs-9">
            <input id="voucherNo" name="voucherNo" type="text" class="form-control" value="<?php echo $data['vouchertype'] ?>" readonly>
        </div>
        <label style="display: none" id="methodLabel" class="control-label col-md-1 col-sm-2 col-xs-9">Method:</label>
        <div style="display: none" id="methodDiv" class="col-md-3 col-sm-3 col-xs-9">
            <select id="method" name="method" class="selectpicker form-control" required>
                <option value="" selected>Please select method of paying</option>
                <option value="otp">On date payment</option>
                <option value="pdc">Post dated check</option>
            </select>
        </div>

    </div>

    <div class=" form-group has-feedback">

    <?php
        if($data['vouchertype'] == 'CHECK') {
        ?>
        <div  id="checkDiv"
             class="control-label col-md-4 col-sm-4 col-xs-9 col-md-offset-7 col-sm-offset-4"><h3> CHECK VOUCHER </h3>
        </div>
            <?php
    }
    else {
        ?>
            <div  id="cashDiv"
                 class="control-label col-md-4 col-sm-4 col-xs-9 col-md-offset-7 col-sm-offset-4"><h3> CASH
                    VOUCHER </h3>
            </div>
            <?php

    }
        ?>

    </div>

    <div class="ln_solid"></div>

    <div class=" form-group has-feedback">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">CHARGE TO:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input id="voucherComp" name="voucherComp" type="text" class="form-control" value="<?php echo $data['vouchercomp'] ?>" readonly>
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-9">NO:</label>
        <div class="col-md-3 col-sm-3 col-xs-9">
            <input id="voucherNo" name="voucherNo" type="text" class="form-control" value="<?php echo $data['voucherno'] ?>" readonly>
        </div>

    </div>

    <div class=" form-group has-feedback">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">PAY TO:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input id="voucherClient" name="voucherClient" type="text" class="form-control" value="<?php echo $data['voucherclient'] ?>" readonly>
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-9">DATE:</label>
        <div class="col-md-3 col-sm-3 col-xs-12">

            <input type="text" class="form-control" id="single_cal1" name="single_call" value="<?php echo $data['voucherdate'] ?>" readonly>

        </div>

    </div>

    <div class=" form-group has-feedback">

        <label class="control-label col-md-2 col-sm-2 col-xs-9">ADDRESS:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input id="voucherAddr" name="voucherAddr" type="text" class="form-control" value="<?php  echo $data['voucheraddr'] ?>" readonly>
        </div>

        <label class="control-label col-md-2 col-sm-2 col-xs-9">REFERENCE NO:</label>
        <div class="col-md-3 col-sm-3 col-xs-12">

            <input type="text" class="form-control" id="refno" name="refno" value="<?php echo $data['voucherrefno'] ?>" readonly>

        </div>

    </div>

    <div class="ln_solid"></div>
    <div class="form-group ">

        <div class="col-md-3 col-sm-3  col-xs-9">
            <h2 >INVOICE NO.</h2>
        </div>



        <div class="col-md-5 col-sm-5 col-xs-9 ">
            <h2  >DESCRIPTION / PARTICULAR</h2>
        </div>



        <div class="col-md-3 col-sm-3 col-xs-9">
            <h2 >AMOUNT</h2>
        </div>

    </div>


    <div class="ln_solid"></div>
    <?php
    $items = mysqli_query($dbcon,"SELECT * FROM voucherdetails  WHERE voucherno = '"
        .$_POST["voucher_code"]."' ");
    while($dataitem = mysqli_fetch_array($items))
    {
    ?>

    <div id="container">
        <div class="container ">

            <div class="col-md-3 col-sm-3 col-xs-9">
                <input type="text" class=" form-control" id="invoiceno" name="invoiceno[]" value="<?php echo $dataitem['voucherinvoiceno'] ?>" readonly>
            </div>



            <div class="col-md-5 col-sm-5 col-xs-9">
                <input type="text" class="form-control " id="description" name="description[]" value="<?php echo $dataitem['voucherdesc']  ?>" readonly>
            </div>

            <div class="col-md-3 col-sm-3  col-xs-9">
                <input type="number" class=" form-control " id="amount" name="amount[]" value="<?php echo $dataitem['voucheramount'] ?>" readonly>
            </div>


        </div>
    </div>
    <?php
    }
    ?>
    <!--container end-->
    <div class="ln_solid"></div>

    <div class=" form-group has-feedback">
        <div id="tempLabel" class="control-label col-md-2 col-sm-2 col-xs-12"></div>
        <?php
            if($data['vouchertype'] == 'CHECK') {
                ?>
                <div id="checkLabel" class="control-label col-md-1 col-sm-1 col-xs-9">CHECK #</div>
                <div id="inputLabel" class="col-md-3 col-sm-3 col-xs-9">
                    <input id="voucherType" name="voucherType" type="text" value="<?php echo $data['voucherchno'] ?>" class="form-control" readonly>
                </div>
                <?php
            }
            else {
                ?>
                <div id="cashLabel" class="control-label col-md-1 col-sm-1 col-xs-9">CASH</div>
                <div  id="inputLabel" class="col-md-3 col-sm-3 col-xs-9">
                    <input id="voucherType" name="voucherType" type="text" value="<?php echo $data['voucherchno'] ?>" class="form-control" readonly>
                </div>
                <?php
            }
        ?>
        <div style="display: none" id="givesLabel" class="control-label col-md-2 col-sm-2 col-xs-12">GIVES</div>



        <div style="display: none" id="givesLABEL" class="col-md-4 col-sm-4 col-xs-9">
            <input id="gives" name="gives" type="text" class="form-control" placeholder="Default Input">
        </div>
        <div style="display: none" id="givesDiv" class="col-md-1 col-sm-1 col-xs-9">
            <a id= "add2" name="add2" type="button" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-plus"></span></a>
            <a id= "clear" name="clear" type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-9">PREPARED BY:</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <input type="text" class="form-control" id="voucherPreparedBy" name="voucherPreparedBy" value="<?php echo $_SESSION['empfname']; echo " "; echo $_SESSION['emplname']; ?>" readonly>

        </div>

    </div>

    <div class="ln_solid"></div>
 <div class="container">
    <?php
        $sql = mysqli_query($dbcon, "SELECT * FROM povoucherpdc WHERE voucherno = '"
            .$_POST["voucher_code"]."' ");
        while($view = mysqli_fetch_array($sql)) {
            if($data['voucherno'] == $view['voucherno'] && $view['status'] == 'PAID') {

                ?>
                <div class="form-group ">

                    <div class="col-md-3 col-sm-3  col-xs-9">
                        <h2 >Check #</h2>
                    </div>



                    <div class="col-md-3 col-sm-4 col-xs-9 ">
                        <h2  >Bank Name</h2>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-9">
                        <h2 >Due Date</h2>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-9">
                        <h2 >Amount</h2>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-9">
                        <h2 >Status</h2>
                    </div>

                </div>
                <input style="display: none;" type="text" class=" form-control" id="id" name="id[]"
                       value="<?php echo $view['id'] ?>" readonly>
                            <div class="col-md-3 col-sm-3 col-xs-9" id="added">
                                <input type="text" class=" form-control" id="checkno" name="checkno[]"
                                       value="<?php echo $view['checkno'] ?>" readonly>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-9" id="added">
                                <input type="text" class="form-control " id="bank" name="bank[]"
                                       value="<?php echo $view['bankname'] ?>" readonly>
                            </div>
                            <div class="col-md-2 col-sm-2  col-xs-9" id="added">
                                <input type="date" class=" form-control " id="date" name="date[]"
                                       value="<?php echo $view['duedate'] ?>" readonly>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-9" id="added">
                                <input type="number" step="any" class=" form-control " id="AMOUNT" name="AMOUNT[]"
                                       value="<?php echo $view['amount'] ?>" readonly>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-9" id="added">
                                <a class="btn btn-success btn-xs"> <?php echo $view['status'] ?> </a>
                            </div>
                <?php
            }
            else {
                $bool++;
                ?>
                <input style="display: none;" type="text" class=" form-control" id="id" name="id[]"
                       value="<?php echo $view['id'] ?>" readonly>
                <div class="col-md-3 col-sm-3 col-xs-9" id="added">
                    <input type="text" class=" form-control" id="checkno" name="checkno[]"
                           value="<?php echo $view['checkno'] ?>" >
                </div>
                <div class="col-md-3 col-sm-4 col-xs-9" id="added">
                    <input type="text" class="form-control " id="bank" name="bank[]"
                           value="<?php echo $view['bankname'] ?>" >
                </div>
                <div class="col-md-2 col-sm-2  col-xs-9" id="added">
                    <input type="date" class=" form-control " id="date" name="date[]"
                           value="<?php echo $view['duedate'] ?>" >
                </div>
                <div class="col-md-2 col-sm-2 col-xs-9" id="added">
                    <input type="number" step="any" class=" form-control " id="AMOUNT" name="AMOUNT[]"
                           value="<?php echo $view['amount'] ?>" >
                </div>
                <div class="col-md-2 col-sm-2 col-xs-9" id="added">
                    <a class="btn btn-success btn-xs"> <?php echo $view['status'] ?> </a>
                </div>
     <?php
            }
        }
    ?>
 </div>
    <?php
    $sql = mysqli_query($dbcon, "SELECT * FROM povoucherpdc WHERE voucherno = '"
        .$_POST["voucher_code"]."' ");
    $view = mysqli_fetch_array($sql);
    if($data['voucherno'] == $view['voucherno'] && $bool > 0) {
        ?>
        <div style="text-align: center; margin-top: 10px">
            <input type="hidden" name="id_holder" id="id_holder" value="<?php echo $_POST["voucher_code"]
            ?>" />
            <a  style="width:25%; height:50px" name="update" id="update" class="btn btn-success btn-xs"> <h2>Update</h2>  </a>
        </div>
        <?php
    }
    ?>


</form>

</body>
<script>
    $('#update').click (function() {
        $.ajax({
            url:"../ACCOUNTING/update_data/update-pdc.php",
            method:"POST",
            data:$('#UpdatePDCForm').serialize(),
            beforeSend:function() {
                $('#update').val("Inserting");
            },
            success:function (data) {
                $("#UpdateDiv").show();
                $("#UpdateMessage").text("PDC Updated");
                setTimeout(function(){
                    location.reload();
                }, 500);
            }
        });
    });
</script>

</html>