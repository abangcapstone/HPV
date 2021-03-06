<?php
session_start();
include "../../../dbconnect.php";
if(isset($_POST["br_number"])){
    $query = mysqli_query($dbcon, "SELECT * FROM budgetrequests,companies WHERE brno = '"
        .$_POST["br_number"]."' && brcomp = compno ");
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
<form class="form-horizontal form-label-left " method="POST" id="CreateBudgetForm" name="CreateBudgetForm">
    <div class=" form-group ">
        <div id="UpdateDiv" class="col-md-3 col-md-offset-5 alert alert-success text-center alert-dismissible fade in"
             role="alert" style="width:200px; display:none"  > <p style="color:#fff; font-size:120%; text-align:center" id="UpdateMessage"></p> </div>
    </div>
    <div class=" form-group has-feedback">
        <label class="control-label col-md-2 col-sm-2 col-xs-9">COMPANY:</label>
        <div class="col-md-3 col-sm-3 col-xs-9">
            <input id="brNo" name="brNo" type="text" class="form-control" value="<?php echo $data['compname'] ?>" readonly>
        </div>
        <label class="control-label col-md-3 col-sm-3 col-xs-9">BR NO:</label>
        <div class="col-md-3 col-sm-3 col-xs-9">
            <input id="brNo" name="brNo" type="text" class="form-control" value="<?php echo $data['brno'] ?>" readonly>
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
                        $data['brdatesubmitted']?>" readonly >
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>


                    </div>
                </div>
            </fieldset>    </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-9">Date Needed:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <fieldset>
                <div class="control-group">
                    <div class="controls">

                        <input type="text" class="form-control has-feedback-left"  value="<?php echo
                        $data['brdateneeded']?>" readonly >
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>


                    </div>
                </div>
            </fieldset>    </div>

    </div>

    <div class=" form-group has-feedback">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Requested By:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input id="brRequestedBy" name="brRequestedBy" type="text" class="form-control" value="<?php echo $data['brrequestedby'] ?>"readonly>
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-9">Attention:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input id="brAttention" name="brAttention" type="text" class="form-control" value="<?php echo $data['brattention'] ?>"readonly >
        </div>

    </div>

    <div class=" form-group has-feedback">

        <label class="control-label col-md-2 col-sm-2 col-xs-9">Title:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input id="brTitle" name="brTitle" type="text" class="form-control" value="<?php echo $data['brtitle'] ?>" readonly>
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-9">Department:</label>
        <div class="col-md-4 col-sm-4 col-xs-9">
            <input id="brDepartment" name="brDepartment" type="text" class="form-control" value="<?php echo $data['brdept'] ?>" readonly>
        </div>


    </div>

    <div class="ln_solid"></div>
    <div class="form-group ">

        <div class="col-md-3 col-sm-3  col-xs-9">
            <h2 >QUANTITY</h2>
        </div>



        <div class="col-md-5 col-sm-5 col-xs-9 ">
            <h2  >DESCRIPTION</h2>
        </div>



        <div class="col-md-3 col-sm-3 col-xs-9">
            <h2 >AMOUNT</h2>
        </div>

    </div>


    <div class="ln_solid"></div>


    <?php
    $items = mysqli_query($dbcon,"SELECT * FROM budgetrequestsdetails  WHERE brno = '"
        .$_POST["br_number"]."' ");
    while($dataitem = mysqli_fetch_array($items))
    {
        ?>
        <div class="container ">
            <div class="col-md-3 col-sm-3 col-xs-9">
                <input type="text" class="form-control"  value="<?php echo
                $dataitem['brquantity']?>" readonly >
            </div>

            <div class="col-md-5 col-sm-5 col-xs-9">
                <input type="text" class="form-control"  value="<?php echo
                $dataitem['brdescription']?>" readonly >
            </div>

            <div class="col-md-3 col-sm-3 col-xs-9">
                <input type="text" class="form-control"  value="<?php echo
                $dataitem['bramount']?>" readonly >
            </div>


        </div>


        <?php
    }
    ?>
    <!--container end-->
    <div class="ln_solid"></div>
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

            <input type="text" class="form-control has-feedback-left" id="brPreparedBy" name="brPreparedBy" value="<?php echo $data['brpreparedby'] ?>" readonly>

        </div>

    </div>

    <div class="form-group">
        <div class="ln_solid col-md-12 col-sm-12 col-xs-12"></div>
        <div class="col-md-4 col-sm-4 col-xs-3 col-md-offset-4 col-sm-offset-4 col-xs-offset-5 ">
            <input type="hidden" name="id_holder" id="id_holder" value="<?php echo $data["brno"]
            ?>" />
            <input type="hidden" name="getDetailId" id="getDetailId" value="<?php echo
            $dataitem['brnno']; ?>" />
            <?php
            if($data["brstatus"] == "FOR PRINT") {
                ?>
                <a target="_blank" href="../fpdf/budgetrqstform.php<?php echo '?code='
                    . base64_encode($_POST["br_number"]); ?>" class="btn btn-success"
                   style="width:100%; height:50px " "> <h2> Print Budget Request </h2>
                </a>
                <?php
            }
            else if($data["brstatus"] == "PENDING" || $data["brstatus"] == "APPROVED") {
                ?>
                <a target="_blank" href="../fpdf/budgetrqstform.php<?php echo '?code='
                    . base64_encode($_POST["br_number"]); ?>" class="btn btn-success"
                   style="width:100%; height:50px " "> <h2> Reprint Budget Request </h2>
                </a>
            <?php
            }
            ?>

        </div>

    </div>

</form>

</body>
<script>
    $('#CreateBudgetForm').on("submit",function(event) {
        event.preventDefault();

        $.ajax({

            url:"../USER/update_data/update-br.php",
            method:"POST",
            data:$('#CreateBudgetForm').serialize(),
            beforeSend:function(){
                $('#update').val("Inserting");

            },
            success:function(data){
                $("#UpdateDiv").show();
                $("#UpdateMessage").text("Budget Request Approved");
                setTimeout(function(){
                    location.reload();
                }, 500);



            }
        });

    });
</script>




</html>