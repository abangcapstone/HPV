<?php
session_start();
include "../../../dbconnect.php";
if(isset($_POST["pr_number"])){
    $query = mysqli_query($dbcon, "SELECT * FROM paymentrequests,companies WHERE prno = '"
        .$_POST["pr_number"]."' && prcomp = compno ");
    $data = mysqli_fetch_array($query);
    $query2 = mysqli_query($dbcon, "SELECT * FROM vouchers ,paymentrequests WHERE voucheridentifier = '"
        .$_POST["pr_number"]."' ");
    $voucherdata = mysqli_fetch_array($query2);

    $file = $dbcon->query("SELECT * FROM attachedfiles,paymentrequests WHERE fileidentifier = prno AND prno = '"
        .$_POST["pr_number"]."'");
}

?>
<html>
<head>
    <link href="/HPV/build/css/added_style.css" rel="stylesheet">
</head>
<body>
<form class="form-horizontal form-label-left " method="POST" id="CreatePaymentForm" name="CreatePaymentForm">
    <div class=" form-group ">
        <div id="UpdateDiv" class="col-md-3 col-md-offset-5 alert alert-success text-center alert-dismissible fade in"
             role="alert" style="width:200px; display:none"  > <p style="color:#fff; font-size:120%; text-align:center" id="UpdateMessage"></p> </div>
    </div>

    <div class=" form-group has-feedback">
        <label class="control-label col-md-2 col-sm-2 col-xs-9">COMPANY:</label>
        <div class="col-md-3 col-sm-3 col-xs-9">
            <input id="prNo" name="prNo" type="text" class="form-control" value="<?php echo $data['compname'] ?>" readonly>
        </div>
        <label class="control-label col-md-3 col-sm-3 col-xs-9">PR NO:</label>
        <div class="col-md-3 col-sm-3 col-xs-9">
            <input id="prNo" name="prNo" type="text" class="form-control" value="<?php echo $data['prno'] ?>" readonly>
        </div>
    </div>

    <div class="ln_solid"></div>

    <div class=" form-group has-feedback">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Date Submitted:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <fieldset>
                <div class="control-group">
                    <div class="controls">

                        <input type="text" class="form-control has-feedback-left"  value="<?php echo
                        $data['prdatesubmitted']?>" readonly >
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>

                    </div>
                </div>
            </fieldset>    </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-9">Date Needed:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <fieldset>
                <div class="control-group">
                    <div class="controls">

                        <input type="date" class="form-control has-feedback-left" id="dateNed" name="dateNed" value="<?php echo
                        $data['prdateneeded']?>" >
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>

                    </div>
                </div>
            </fieldset>    </div>

    </div>

    <div class=" form-group has-feedback">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Requested By:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input id="requestedBy" name="requestedBy" type="text" class="form-control" value="<?php echo $data['prrequestedby'] ?>" >
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-9">Attention:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input id="attention" name="attention" type="text" class="form-control" value="<?php echo $data['prattention'] ?>" >
        </div>

    </div>

    <div class=" form-group has-feedback">

        <label class="control-label col-md-2 col-sm-2 col-xs-9">Title:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input id="title" name="title" type="text" class="form-control" value="<?php echo $data['prtitle'] ?>" >
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-9">Department:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input id="department" name="department" type="text" class="form-control" value="<?php echo $data['prdept'] ?>" >
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



        <div class="col-md-3 col-sm-3 col-xs-9">
            <h2 >AMOUNT</h2>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-9">
            <h2 >DUE DATE</h2>
        </div>

    </div>


    <div class="ln_solid"></div>

    <div id="container">
    <?php
    $ctr = 1;
    $items = mysqli_query($dbcon,"SELECT * FROM paymentrequestsdetails  WHERE prno = '"
        .$_POST["pr_number"]."' ");
    while($dataitem = mysqli_fetch_array($items))
    {
        ?>
        <div class="container ">
            <input style="display: none" id="id" name="id[]" type="text" class="form-control"  value="<?php echo
            $dataitem['id']?>" readonly >
            <div class="col-md-3 col-sm-3 col-xs-9">
                <input type="text" id="description" name="description[]" class="form-control"  value="<?php echo
                $dataitem['prdesc']?>"  >
            </div>

            <div class="col-md-3 col-sm-3 col-xs-9">
                <input type="text" id="invoice" name="invoiceno[]" class="form-control"  value="<?php echo
                $dataitem['prinvoiceno']?>" >
            </div>

            <div class="col-md-3 col-sm-3 col-xs-9">
                <input type="number" step="any" id="AMOUNT" name="AMOUNT[]" class="form-control"  value="<?php echo
                $dataitem['pramount']?>"  >
            </div>
            <div class="col-md-2 col-sm-3 col-xs-9">
                <input type="date" id="date" name="date[]" class="form-control"  value="<?php echo
                $dataitem['prduedate']?>"  >
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
    </div>


        <?php
    }
    ?>
    <!--container end-->

    <div class="form-group">

        <div style="margin-top: 40px">
            <table class="table table-striped table-bordered" cellspacing="0" cellpadding="10px">
                <thead>
                <tr role="row">
                    <th> File Name </th>
                    <th> Action </th>
                </tr>
                </thead>
                <tbody>

                <?php
                if($file->num_rows>0) {
                    while ($result = $file->fetch_object()) {
                        $str = substr($result->name, 1);
                        $name = substr($result->name, 12);
                        ?>
                        <tr role="row">
                            <td><?php echo $name ?></td>
                            <td><a href="<?php echo $str ?>" class="btn btn-primary btn-xs" download>Download</a></td>
                        </tr>
                        <?php
                    }
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>

    <div class=" form-group  ">
        <label class="control-label col-md-2 col-sm-2 col-xs-9">Prepared by:</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <input type="text" class="form-control  " id="preparedBy" name="preparedBy" value="<?php echo $_SESSION['empfname']; echo " "; echo $_SESSION['emplname'] ?>" readonly>
        </div>

    </div>
    <div style="text-align: center">
        <input type="hidden" name="id_holder" id="id_holder" value="<?php echo $data["prno"]
        ?>" />
        <button type ="submit" name ="update" id="update" class="btn btn-primary" style="width:40%; height:50px;">
            <h4>Update Payment Request</h4>
        </button>
    </div>

</form>
</body>
</head>
</html>
<script>
    $('#CreatePaymentForm').on("submit",function(event) {
        event.preventDefault();

        $.ajax({
            url:"../ACCOUNTING/update_data/update_payment.php",
            method:"POST",
            data:$('#CreatePaymentForm').serialize(),
            beforeSend:function(){
                $('#update').val("Inserting");

            },
            success:function(data){
                $("#UpdateDiv").show();
                $("#UpdateMessage").text("Payment Request Updated");
                setTimeout(function(){
                    location.reload();
                }, 500);



            }
        });

    });
</script>
<script>
    $(document).ready(function(e){
        //variables[
        var html= '  <div class="container "> <div class="col-md-3 col-sm-3 col-xs-9" id="added"> <input type="text" class=" form-control" id="description" name="description[]" placeholder="Description" required> </div> <div class="col-md-3 col-sm-3 col-xs-9"  id="added"> <input type="text" class="form-control " id="invoiceno" name="invoiceno[]" placeholder="Invoice no" required> </div> <div class="col-md-3 col-sm-3  col-xs-9"  id="added"> <input type="number" class=" form-control " id="AMOUNT" name="AMOUNT[]" placeholder="Amount" required> </div> <div class="col-md-2 col-sm-3  col-xs-9"  id="added"> <input type="date" class=" form-control " id="date" name="date[]" placeholder="Due date" required> </div> <div class="col-md-1 col-sm-1 col-xs-9" id="added"> <a id= "remove" name="remove" type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove" ></span></a> </div> </div>  ';

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

