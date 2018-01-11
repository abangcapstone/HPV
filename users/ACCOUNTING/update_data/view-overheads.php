<?php
session_start();
include "../../../dbconnect.php";
if(isset($_POST["overhead_code"])) {
    $query = mysqli_query($dbcon, "SELECT * FROM overheads,overheaddetails,companies,branches WHERE overheadcode =  '"
        . $_POST["overhead_code"] . "'  && overheadcode = overheaddetailscode && overheadcomp = compno && 
        overheadcompbranch = branchid");
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
<form class="form-horizontal  " id="UpdateOverheadForm" method="POST" >
                                <div class=" form-group ">
                                    <div id="UpdateDiv" class="col-md-3 col-md-offset-5 alert alert-success text-center alert-dismissible fade in"
                                         role="alert" style="width:200px; display:none"  > <p style="color:#fff; font-size:120%; text-align:center" id="UpdateMessage"></p> </div>
                                </div>

                                <div class="form-group has-feedback">
                                    <label class="textsize control-label col-md-2 col-sm-2 col-xs-9 ">Company:</label >
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input  readonly id="company" name="company" type="text" class="form-control has-feedback-left"
                                        value =" <?php echo $data['compname']; ?>"required>
                                        <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                    <div class="form-group has-feedback">
                                        <label class="textsize control-label col-md-2 col-sm-2 col-xs-9 ">Branch:</label >
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <input  readonly id="branch" name="branch" type="text" class="form-control has-feedback-left"
                                                    value =" <?php echo $data['branchloc']; ?>"required>
                                            <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>

                                <div class="form-group has-feedback">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Address:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input  readonly id="companyAddr" name="companyAddr" type="text" class="form-control has-feedback-left"
                                                value =" <?php echo $data['branchaddr']; ?>" required>
                                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                                    </div>


                                    <label class="textsize control-label col-md-2 col-sm-2 col-xs-9 ">Date:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input readonly type="text" class="form-control has-feedback-left" name ="date" id="date" value ="<?php echo $data['overheaddate']; ?>"  required >
                                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                </div>
                                <div class="form-group has-feedback">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Tel #:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input  readonly id="companyTelNo" name="companyTelNo" type="text" class="form-control has-feedback-left"
                                                value =" <?php echo $data['branchtelno']; ?>" required>
                                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Fax #:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-9">
                                        <input  readonly id="companyFaxNo" name="companyFaxNo" type="text"
                                                class="form-control has-feedback-left"  value =" <?php echo $data['branchfaxno']; ?>" required>
                                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>


                                <div class="ln_solid"></div>
                                    <?php
                                        if($data['overheadtype'] == "Rental"){
                                            ?>
                                            <div class="form-group ">

                                                <div class="col-md-2 col-sm-9  col-xs-9">
                                                    <h5 >BUSINESS NAME</h5>
                                                </div>

                                                <div class="col-md-2 col-sm-9 col-xs-9 ">
                                                    <h5  >ADDRESS</h5>
                                                </div>

                                                <div class="col-md-2 col-sm-9 col-xs-9">
                                                    <h5 >CONTACT DETAILS</h5>
                                                </div>

                                                <div class="col-md-2 col-sm-9 col-xs-9">
                                                    <h5 >ROOM/UNIT</h5>
                                                </div>

                                                <div class="col-md-2 col-sm-9 col-xs-9">
                                                    <h5 >AMOUNT</h5>
                                                </div>


                                                <div class="col-md-2 col-sm-9 col-xs-9">
                                                    <h5 >DUE DATE</h5>
                                                </div>

                                            </div>


                                            <div class="ln_solid"></div>
                                            <?php
                                            $items = mysqli_query($dbcon,"SELECT * FROM overheaddetails  WHERE overheaddetailscode = '"
                                                .$_POST["overhead_code"]."' ");
                                            while($dataitem = mysqli_fetch_array($items))
                                            {
                                                ?>

                                            <div id="container">
                                                <div class="container ">
                                                    <div class="col-md-2 col-sm-9 col-xs-9">
                                                        <input type="text" class=" form-control" id="businessname"
                                                               name="businessname" value="<?php echo $dataitem['overheadname']; ?>" >
                                                    </div>

                                                    <div class="col-md-2 col-sm-9 col-xs-9">
                                                        <input type="text" class=" form-control" id="address"
                                                               name="address" value="<?php echo $dataitem['overheadaddr']; ?>" >
                                                    </div>

                                                    <div class="col-md-2 col-sm-9  col-xs-9">
                                                        <input type="number" class=" form-control " id="contactdetails"
                                                               name="contactdetails" value="<?php echo $dataitem['overheadcontact']; ?>" >
                                                    </div>

                                                    <div class="col-md-2 col-sm-2 col-xs-9">
                                                        <input type="text" class="form-control " id="unit" name="unit"
                                                               value="<?php echo $dataitem['overheadunit']; ?>" >
                                                    </div>

                                                    <div class="col-md-2 col-sm-9 col-xs-9">
                                                        <input type="number" step="any" class="form-control " id="amount" name="amount"
                                                               value="<?php echo $dataitem['overheadamount']; ?>" >
                                                    </div>
                                                    <div class="col-md-2 col-sm-9 col-xs-9">

                                                    <input type="text" class=" form-control " id="duedate"
                                                           name="duedate" value="<?php echo date('d',strtotime($dataitem['overheadduedate']))  ?>" >
                                                    </div>
                                                </div>


                                                    <!--<div class="col-md-1 col-sm-1 col-xs-9">
                                                        <a id= "add" name="add" type="button" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-plus"></span></a>
                                                    </div>-->
                                                </div>
                                            </div>
                                                <?php
                                            }

                                        }
                                        else{
                                            ?>
                                    <div class="form-group ">

                                        <div class="col-md-3 col-sm-3  col-xs-9">
                                            <h2 >BUSINESS NAME</h2>
                                        </div>



                                        <div class="col-md-3 col-sm-3 col-xs-9 ">
                                            <h2  >ADDRESS</h2>
                                        </div>



                                        <div class="col-md-3 col-sm-3 col-xs-9">
                                            <h2 >CONTACT DETAILS</h2>
                                        </div>

                                        <div class="col-md-3 col-sm-3 col-xs-9">
                                            <h2 >DUE DATE</h2>
                                        </div>

                                    </div>

                                    <div class="ln_solid"></div>
                                    <?php
                                    $items = mysqli_query($dbcon,"SELECT * FROM overheaddetails  WHERE overheaddetailscode = '"
                                        .$_POST["overhead_code"]."' ");
                                    while($dataitem = mysqli_fetch_array($items))
                                    {
                                        ?>

                                    <div id="container">
                                        <div class="container ">
                                            <div class="col-md-3 col-sm-3 col-xs-9">
                                                <input type="text" class=" form-control" id="businessname"
                                                       name="businessname" value="<?php echo $dataitem['overheadname']; ?>" >
                                            </div>

                                            <div class="col-md-3 col-sm-3 col-xs-9">
                                                <input type="text" class=" form-control" id="address"
                                                       name="address" value="<?php echo $dataitem['overheadaddr']; ?>" >
                                            </div>

                                            <div class="col-md-3 col-sm-3  col-xs-9">
                                                <input type="number" class=" form-control " id="contactdetails"
                                                       name="contactdetails" value="<?php echo $dataitem['overheadcontact']; ?>" >
                                            </div>
                                            <div class="col-md-3 col-sm-3  col-xs-9">



                                                <input type="text" class=" form-control " id="duedate"
                                                       name="duedate" value="<?php echo  date('d',strtotime($dataitem['overheadduedate'])) ?>" >
                                            </div>



                                           <!-- <div class="col-md-1 col-sm-1 col-xs-9">
                                                <a id= "add" name="add" type="button" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-plus"></span></a>
                                            </div>-->
                                        </div>
                                    </div>
                                        <?php
                                             }

                                        }
                                    ?>
                                <!--container end-->
                                <div class="ln_solid"></div>


                                <div class=" form-group  ">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-9">Prepared by:</label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">

                                        <input type="text" class="form-control  " id="preparedBy" name="preparedBy" value="<?php echo $data['overheadpreparedby'];  ?>" readonly>

                                    </div>
                                </div>

                              <!--  <div class="col-md-4 col-sm-4 col-xs-9">
                                    <input  style="display: none;" id="overheadtype" name="overheadtype"
                                            type="text" value="Communication">
                                </div>


-->
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <input type="hidden" name="id_holder" id="id_holder" value="<?php echo $data["overheadcode"]
                                        ?>" />
                                        <button type ="submit" name ="update" id="update" class="btn btn-success" style="width:65%; height:50px">
                                            <h4>Update Changes</h4>
                                        </button>
                                    </div>
                                </div>

                                </form>

</body>
<script>
    $('#UpdateOverheadForm').on("submit",function(event) {
        event.preventDefault();
        $.ajax({

            url:"../ACCOUNTING/update_data/update-overhead.php",
            method:"POST",
            data:$('#UpdateOverheadForm').serialize(),
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