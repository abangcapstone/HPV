

<?php
session_start();
include "../../../dbconnect.php";
if(isset($_POST["overhead_code"])) {
    $code = $_POST["overhead_code"] ;
}
date_default_timezone_set('Asia/Manila');
?>
<html>
<head>
    <!-- Custom Theme Style -->
    <link href="/HPV/build/css/custom.min.css" rel="stylesheet">
    <!--    <link href="/HPV/build/css/added_style.css" rel="stylesheet">-->
</head>

<body>
<form class="form-horizontal form-label-left" id="UpdatePaymentForm" method="POST" >

    <div class=" form-group ">
        <div id="UpdateDiv" class="col-md-3 col-md-offset-4 alert alert-success text-center alert-dismissible fade in"
             role="alert" style="width:200px; display:none"  > <p style="color:#fff; font-size:120%; text-align:center" id="UpdateMessage"></p> </div>
    </div>

    <div class="form-group">
        <label class="textsize control-label col-md-3 col-sm-3 col-xs-9 ">Payment Date:</label >
        <div class="col-md-6 col-sm-6 col-xs-9 ">
            <input disabled type="text" class="form-control has-feedback-left" name ="date" id="date" value ="<?php echo date('m/d/Y');?>"  required >
            <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>

        </div>
    </div>
    <div class="form-group">
        <label class="textsize control-label col-md-3 col-sm-3 col-xs-9 ">Reference #:</label >
        <div class="col-md-6 col-sm-6 col-xs-9 ">
            <input  type="text" class="form-control  " name ="refno" id="refno"   >


        </div>
    </div>
    <div class="form-group">
        <label class="textsize control-label col-md-3 col-sm-3 col-xs-9 ">OR #:</label >
        <div class="col-md-6 col-sm-6 col-xs-9 ">
            <input  type="text" class="form-control  " name ="orno" id="orno" >


        </div>
    </div>

    <div class="form-group">
        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
            <input type="hidden" name="id_holder" id="id_holder" value="<?php echo $code
            ?>" />
            <button type ="submit" name ="update" id="update" class="btn btn-success" style="width:30%; height:50px">
                <h4>Save</h4>
            </button>
        </div>
    </div>

</form>

</body>
<script>
    $('#UpdatePaymentForm').on("submit",function(event) {
        event.preventDefault();
        $.ajax({

            url:"../ACCOUNTING/update_data/update-paymentdate.php",
            method:"POST",
            data:$('#UpdatePaymentForm').serialize(),
            beforeSend:function(){
                $('#update').val("Inserting");

            },
            success:function(data){
                $("#UpdateDiv").show();
                $("#UpdateMessage").text("Successfully Updated");
                setTimeout(function(){
                    location.reload();
                }, 500);



            }
        });

    });
</script>

</html>