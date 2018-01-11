
<?php
include "../../../dbconnect.php";
if(isset($_POST["year_code"]) && isset($_POST["company_code"])) {
    $query = $dbcon->query("SELECT * FROM companies WHERE compno = '". $_POST['company_code'] ."'");
    $compname = $query->fetch_object();
    $holder = $compname->compno;
    $counter = 0;
    $type = $_POST['oh_code'];
    if($_POST['cat_code'] == "Overhead") {
        $sql = $dbcon->query("SELECT * FROM overheads, overheaddetails, transactions WHERE overheadcomp = '$holder' AND overheadcode = overheaddetailscode AND overheadcode = transaccode AND overheadtype = '$type'");
    }
    if($_POST['cat_code'] == "Purchase Order") {
        $sql1 = $dbcon->query("SELECT * FROM purchaseorder, podetails, transactions,clients WHERE pocompany = '$holder' AND ponumber = poitemcode AND ponumber = transaccode AND poclient = clientcode");
    }
    $dbcon->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HP Ventures Inc. | Accounts Payable System  </title>
    <!-- Font Awesome -->
    <link href="/HPV/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/HPV/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/HPV/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="/HPV/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/HPV/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
</head>
<body class="nav-md">

<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
    <div class="row"><div class="col-sm-12">
            <h4> <?php echo $compname->compname ?> (<?php echo $_POST['year_code'] ?> <?php echo $_POST['month_code'] ?>)</h4>
            <h4><?php echo $_POST['cat_code'] ?> <?php if($_POST['cat_code'] == 'Overhead') { echo ", "; echo $_POST['oh_code'];  } ?></h4>
            <br>
            <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                <tr role="row">
                    <th>Identifier</th>
                    <th>Payor</th>
                    <th>Payee</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                <!-- Fetch data from database -->
                <?php
                if($_POST['cat_code'] == "Overhead") {
                    if ($sql->num_rows > 0) {
                        $counter = 0;
                        while ($result = $sql->fetch_object()) {
                            if ((date('Y', strtotime("$result->transacdate")) == $_POST['year_code']) && (date('F', strtotime("$result->transacdate")) == $_POST['month_code'])) {
                                $counter++;
                                ?>
                                <tr role="row">
                                    <td><?php echo $result->overheadcode ?></td>
                                    <td><?php echo $result->overheadname ?></td>
                                    <td><?php echo $result->overheadcomp ?></td>
                                    <td><?php echo number_format($result->transacamt, 2, '.', ','); ?></td>
                                </tr>
                                <?php
                            }
                        }
                    }
                }
                if($_POST['cat_code'] == "Purchase Order") {
                    if($sql1->num_rows > 0) {
                        $counter = 0;
                        while($result = $sql1->fetch_object()) {
                            if ((date('Y', strtotime("$result->transacdate")) == $_POST['year_code']) && (date('F', strtotime("$result->transacdate")) == $_POST['month_code'])) {
                                $counter++;
                                ?>
                                <tr role="row">
                                    <td><?php echo $result->pocompany ?></td>
                                    <td><?php echo $result->clientname ?></td>
                                    <td><?php echo $compname->compname ?></td>
                                    <td><?php echo number_format($result->transacamt, 2, '.', ','); ?></td>
                                </tr>
                                <?php
                            }
                        }
                    }
                }
                if($counter == 0) {
                ?>
                    <tr role="row">
                        <td colspan="4" style="text-align: center">No records found!</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="/HPV/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/HPV/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/HPV/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="/HPV/vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="/HPV/vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="/HPV/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/HPV/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/HPV/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/HPV/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="/HPV/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="/HPV/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="/HPV/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="/HPV/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="/HPV/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="/HPV/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/HPV/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="/HPV/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="/HPV/vendors/jszip/dist/jszip.min.js"></script>
<script src="/HPV/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="/HPV/vendors/pdfmake/build/vfs_fonts.js"></script>
</body>
</html>