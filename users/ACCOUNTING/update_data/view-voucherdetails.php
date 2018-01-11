<?php
    include "../../../dbconnect.php";
    if(isset($_POST["br_number"])) {
        $query = $dbcon->query("SELECT * FROM budgetrequestsdetails WHERE brno = '". $_POST["br_number"] ."'");
    }
    if(isset($_POST["pr_number"])) {
        $query2 = $dbcon->query("SELECT * FROM paymentrequestsdetails WHERE prno = '". $_POST["pr_number"] ."'");
    }
    if(isset($_POST["oh_number"])) {
        $query3 = $dbcon->query("SELECT * FROM overheaddetails WHERE overheaddetailscode = '". $_POST["oh_number"] ."'");
    }
    if(isset($_POST["po_number"])) {
        $query4 = $dbcon->query("SELECT * FROM podetails WHERE poitemcode = '". $_POST["po_number"] ."'");
    }
?>
<html>
    <head>

    </head>
    <body>
    <?php
    if(isset($_POST['br_number'])) {
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_object()) {
                ?>
                <div class="col-md-3 col-sm-3 col-xs-9">
                    <input type="text" class=" form-control" id="invoiceno" name="invoiceno[]" placeholder="Invoice #"
                           required>
                </div>

                <div class="col-md-5 col-sm-5 col-xs-9">
                    <input type="text" class="form-control " id="description" name="description[]"
                           placeholder="Description" value="<?php echo $row->brdescription ?>">
                </div>

                <div class="col-md-3 col-sm-3  col-xs-9">
                    <input type="number" class=" form-control " id="amount" name="amount[]" placeholder="Amount"
                           value="<?php echo $row->bramount ?>" readonly>
                </div>
                <?php
            }
        }
    }
    if(isset($_POST['pr_number'])) {
        if ($query2->num_rows > 0) {
            while ($row = $query2->fetch_object()) {
                ?>
                <div class="col-md-3 col-sm-3 col-xs-9">
                    <input type="text" class=" form-control" id="invoiceno" name="invoiceno[]" placeholder="Invoice #"
                           value="<?php echo $row->prinvoiceno ?>" required>
                </div>

                <div class="col-md-5 col-sm-5 col-xs-9">
                    <input type="text" class="form-control " id="description" name="description[]"
                           placeholder="Description" value="<?php echo $row->prdesc ?>" required>
                </div>

                <div class="col-md-3 col-sm-3  col-xs-9">
                    <input type="number" class=" form-control " step="any" id="amount" name="amount[]"
                           placeholder="Amount" value="<?php echo $row->pramount ?>" readonly>
                </div>
                <?php
            }
        }
    }
    if(isset($_POST['oh_number'])) {
        if ($query3->num_rows > 0) {
            while ($row = $query3->fetch_object()) {
                ?>
                <div class="col-md-3 col-sm-3 col-xs-9">
                    <input type="text" class=" form-control" id="invoiceno" name="invoiceno[]" placeholder="Invoice #"
                            required>
                </div>

                <div class="col-md-5 col-sm-5 col-xs-9">
                    <input type="text" class="form-control " id="description" name="description[]"
                           placeholder="Description" required>
                </div>

                <div class="col-md-3 col-sm-3  col-xs-9">
                    <input type="number" class=" form-control " step="any" id="amount" name="amount[]"
                           placeholder="Amount" value="<?php echo $row->overheadamount ?>" readonly>
                </div>
                <?php
            }
        }
    }
    if(isset($_POST['po_number'])) {
        if ($query4->num_rows > 0) {
            while ($row = $query4->fetch_object()) {
                ?>
                <div class="col-md-3 col-sm-3 col-xs-9">
                    <input type="text" class=" form-control" id="invoiceno" name="invoiceno[]" placeholder="Invoice #"
                           required>
                </div>

                <div class="col-md-5 col-sm-5 col-xs-9">
                    <input type="text" class="form-control " id="description" name="description[]"
                           placeholder="Description" value="<?php echo $row->poitemdesc ?>">
                </div>

                <div class="col-md-3 col-sm-3  col-xs-9">
                    <input type="number" class=" form-control " step="any" id="amount" name="amount[]"
                           placeholder="Amount" value="<?php echo $row->poitemtotal ?>" readonly>
                </div>
                <?php
            }
        }
    }
    ?>

    </body>
</html>
