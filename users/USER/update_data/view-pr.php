<?php
session_start();
include "../../../dbconnect.php";
if(isset($_POST["pr_number"])){
    $query = mysqli_query($dbcon, "SELECT * FROM paymentrequests,companies WHERE prno = '"
        .$_POST["pr_number"]."' && prcomp = compno ");
    $data = mysqli_fetch_array($query);

}

?>
<html>
<head>
    <body>
<form class="form-horizontal form-label-left " method="POST" id="CreatePaymentForm" name="CreatePaymentForm" action="insert_data/insert-prform.php">


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

                        <input type="date" class="form-control has-feedback-left"  value="<?php echo
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

                        <input type="date" class="form-control has-feedback-left"  value="<?php echo
                        $data['prdateneeded']?>" readonly >
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>

                    </div>
                </div>
            </fieldset>    </div>

    </div>

    <div class=" form-group has-feedback">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Requested By:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input id="requestedBy" name="requestedBy" type="text" class="form-control" value="<?php echo $data['prrequestedby'] ?>"readonly >
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-9">Attention:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input id="attention" name="attention" type="text" class="form-control" value="<?php echo $data['prattention'] ?>"readonly >
        </div>

    </div>

    <div class=" form-group has-feedback">

        <label class="control-label col-md-2 col-sm-2 col-xs-9">Title:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input id="title" name="title" type="text" class="form-control" value="<?php echo $data['prtitle'] ?>"readonly>
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-9">Department:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input id="department" name="department" type="text" class="form-control" value="<?php echo $data['prdept'] ?>"readonly >
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


    <?php
    $items = mysqli_query($dbcon,"SELECT * FROM paymentrequestsdetails  WHERE prno = '"
        .$_POST["pr_number"]."' ");
    while($dataitem = mysqli_fetch_array($items))
    {
        ?>
        <div class="container ">
            <div class="col-md-3 col-sm-3 col-xs-9">
                <input type="text" class="form-control"  value="<?php echo
                $dataitem['prdesc']?>" readonly >
            </div>

            <div class="col-md-3 col-sm-3 col-xs-9">
                <input type="text" class="form-control"  value="<?php echo
                $dataitem['prinvoiceno']?>" readonly >
            </div>

            <div class="col-md-3 col-sm-3 col-xs-9">
                <input type="text" class="form-control"  value="<?php echo
                $dataitem['pramount']?>" readonly >
            </div>
            <div class="col-md-3 col-sm-3 col-xs-9">
                <input type="text" class="form-control"  value="<?php echo
                $dataitem['prduedate']?>" readonly >
            </div>


        </div>


        <?php
    }
    ?>
    <!--container end-->
    <div class=" form-group">
        <label class="control-label col-md-6 col-sm-6 col-xs-12  ">I acknowledge that this funding request, if approved, will be deducted from:</label>
    </div>
    <div class="form-group">
        <div class="col-md-2 col-sm-6 col-xs-12 col-md-offset-2">
            <input type="checkbox"  value="Petty Cash"> Petty Cash
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
            <input type="checkbox"  value="Others"> Others
        </div>
    </div>
    <div class=" form-group has-feedback">
        <label class="control-label col-md-2 col-sm-2 col-xs-9">Prepared by:</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <input type="text" class="form-control has-feedback-left" id="preparedBy" name="preparedBy" value="<?php echo $_SESSION['empfname']; echo " "; echo $_SESSION['emplname'] ?>" readonly>
        </div>

    </div>

    <div class="form-group">
        <div class="ln_solid col-md-12 col-sm-12 col-xs-12"></div>
        <div class="col-md-4 col-sm-4 col-xs-3 col-md-offset-4 col-sm-offset-4 col-xs-offset-5 ">
            <input type="hidden" name="id_holder" id="id_holder" value="<?php echo $data["prno"]
            ?>" />
            <?php
            if($data["prstatus"] == "FOR PRINT") {
                ?>
                <a target="_blank" href="../fpdf/paymentrqstform.php<?php echo '?code='
                    . base64_encode($_POST["pr_number"]); ?>" class="btn btn-success"
                   style="width:100%; height:50px " "> <h2> Print Payment Request </h2>
                </a>
                <?php
            }
            else if($data["prstatus"] == "PENDING" || $data["prstatus"] == "APPROVED") {
                ?>
                <a target="_blank" href="../fpdf/paymentrqstform.php<?php echo '?code='
                    . base64_encode($_POST["pr_number"]); ?>" class="btn btn-success"
                   style="width:100%; height:50px " "> <h2> Reprint Payment Request </h2>
                </a>
                <?php
            }
            ?>
        </div>

    </div>

</form>
    </body>
</head>
</html>

<script>
    $('#CreatePaymentForm').on("submit",function(event) {
        event.preventDefault();

        $.ajax({

            url:"../USER/update_data/update-pr.php",
            method:"POST",
            data:$('#CreatePaymentForm').serialize(),
            beforeSend:function(){
                $('#update').val("Inserting");

            },
            success:function(data){
                $("#UpdateDiv").show();
                $("#UpdateMessage").text("Payment Request Approved");
                setTimeout(function(){
                    location.reload();
                }, 500);



            }
        });

    });
</script>