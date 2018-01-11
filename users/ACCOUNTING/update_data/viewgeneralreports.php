
<?php
    include "../../../dbconnect.php";
if(isset($_POST["year_code"]) && isset($_POST["company_code"])) {
    $query = $dbcon->query("SELECT * FROM companies WHERE compno = '". $_POST['company_code'] ."'");
    $compname = $query->fetch_object();

    $monthsRental = new SplFixedArray(12);
    $rentalTotal = 0;
    $sql = $dbcon->query("SELECT * FROM transactions WHERE transacpayor = '". $_POST['company_code'] ."' AND transactype = 'RENTAL'");
    if($sql->num_rows > 0) {
        while($result = $sql->fetch_object()) {
            if(date('Y', strtotime("$result->transacdate")) == $_POST['year_code'])
                if (date('M', strtotime("$result->transacdate")) == "Jan") {
                    $monthsRental[0] = $monthsRental[0] + $result->transacamt;
                    $rentalTotal = $rentalTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Feb") {
                    $monthsRental[1] = $monthsRental[1] + $result->transacamt;
                    $rentalTotal = $rentalTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Mar") {
                    $monthsRental[2] = $monthsRental[2] + $result->transacamt;
                    $rentalTotal = $rentalTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Apr") {
                    $monthsRental[3] = $monthsRental[3] + $result->transacamt;
                    $rentalTotal = $rentalTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "May") {
                    $monthsRental[4] = $monthsRental[4] + $result->transacamt;
                    $rentalTotal = $rentalTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Jun") {
                    $monthsRental[5] = $monthsRental[5] + $result->transacamt;
                    $rentalTotal = $rentalTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Jul") {
                    $monthsRental[6] = $monthsRental[6] + $result->transacamt;
                    $rentalTotal = $rentalTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Aug") {
                    $monthsRental[7] = $monthsRental[7] + $result->transacamt;
                    $rentalTotal = $rentalTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Sep") {
                    $monthsRental[8] = $monthsRental[8] + $result->transacamt;
                    $rentalTotal = $rentalTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Oct") {
                    $monthsRental[9] = $monthsRental[9] + $result->transacamt;
                    $rentalTotal = $rentalTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Nov") {
                    $monthsRental[10] = $monthsRental[10] + $result->transacamt;
                    $rentalTotal = $rentalTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Dec") {
                    $monthsRental[11] = $monthsRental[11] + $result->transacamt;
                    $rentalTotal = $rentalTotal + $result->transacamt;
                }
            }
        }

    $monthsElectricity = new SplFixedArray(12);
    $electrictyTotal = 0;
    $sql = $dbcon->query("SELECT * FROM transactions WHERE transacpayor = '". $_POST['company_code'] ."' AND transactype = 'Electric'");
    if($sql->num_rows > 0) {
        while($result = $sql->fetch_object()) {
            if(date('Y', strtotime("$result->transacdate")) == $_POST['year_code'])
                if (date('M', strtotime("$result->transacdate")) == "Jan") {
                    $monthsElectricity[0] = $monthsElectricity[0] + $result->transacamt;
                    $electrictyTotal = $electrictyTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Feb") {
                    $monthsElectricity[1] = $monthsElectricity[1] + $result->transacamt;
                    $electrictyTotal = $electrictyTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Mar") {
                    $monthsElectricity[2] = $monthsElectricity[2] + $result->transacamt;
                    $electrictyTotal = $electrictyTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Apr") {
                    $monthsElectricity[3] = $monthsElectricity[3] + $result->transacamt;
                    $electrictyTotal = $electrictyTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "May") {
                    $monthsElectricity[4] = $monthsElectricity[4] + $result->transacamt;
                    $electrictyTotal = $electrictyTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Jun") {
                    $monthsElectricity[5] = $monthsElectricity[5] + $result->transacamt;
                    $electrictyTotal = $electrictyTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Jul") {
                    $monthsElectricity[6] = $monthsElectricity[6] + $result->transacamt;
                    $electrictyTotal = $electrictyTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Aug") {
                    $monthsElectricity[7] = $monthsElectricity[7] + $result->transacamt;
                    $electrictyTotal = $electrictyTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Sep") {
                    $monthsElectricity[8] = $monthsElectricity[8] + $result->transacamt;
                    $electrictyTotal = $electrictyTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Oct") {
                    $monthsElectricity[9] = $monthsElectricity[9] + $result->transacamt;
                    $electrictyTotal = $electrictyTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Nov") {
                    $monthsElectricity[10] = $monthsElectricity[10] + $result->transacamt;
                    $electrictyTotal = $electrictyTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Dec") {
                    $monthsElectricity[11] = $monthsElectricity[11] + $result->transacamt;
                    $electrictyTotal = $electrictyTotal + $result->transacamt;
                }
        }
    }

    $monthsComms = new SplFixedArray(12);
    $commsTotal = 0;
    $sql = $dbcon->query("SELECT * FROM transactions WHERE transacpayor = '". $_POST['company_code'] ."' AND transactype = 'Communication'");
    if($sql->num_rows > 0) {
        while($result = $sql->fetch_object()) {
            if(date('Y', strtotime("$result->transacdate")) == $_POST['year_code'])
                if (date('M', strtotime("$result->transacdate")) == "Jan") {
                    $monthsComms[0] = $monthsComms[0] + $result->transacamt;
                    $commsTotal = $commsTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Feb") {
                    $monthsComms[1] = $monthsComms[1] + $result->transacamt;
                    $commsTotal = $commsTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Mar") {
                    $monthsComms[2] = $monthsComms[2] + $result->transacamt;
                    $commsTotal = $commsTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Apr") {
                    $monthsComms[3] = $monthsComms[3] + $result->transacamt;
                    $commsTotal = $commsTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "May") {
                    $monthsComms[4] = $monthsComms[4] + $result->transacamt;
                    $commsTotal = $commsTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Jun") {
                    $monthsComms[5] = $monthsComms[5] + $result->transacamt;
                    $commsTotal = $commsTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Jul") {
                    $monthsComms[6] = $monthsComms[6] + $result->transacamt;
                    $commsTotal = $commsTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Aug") {
                    $monthsComms[7] = $monthsComms[7] + $result->transacamt;
                    $commsTotal = $commsTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Sep") {
                    $monthsComms[8] = $monthsComms[8] + $result->transacamt;
                    $commsTotal = $commsTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Oct") {
                    $monthsComms[9] = $monthsComms[9] + $result->transacamt;
                    $commsTotal = $commsTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Nov") {
                    $monthsComms[10] = $monthsComms[10] + $result->transacamt;
                    $commsTotal = $commsTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Dec") {
                    $monthsComms[11] = $monthsComms[11] + $result->transacamt;
                    $commsTotal = $commsTotal + $result->transacamt;
                }
        }
    }

    $monthsSupp = new SplFixedArray(12);
    $suppTotal = 0;
    $sql = $dbcon->query("SELECT * FROM transactions WHERE transacpayor = '". $_POST['company_code'] ."' AND transactype = 'Supplier'");
    if($sql->num_rows > 0) {
        while($result = $sql->fetch_object()) {
            if(date('Y', strtotime("$result->transacdate")) == $_POST['year_code'])
                if (date('M', strtotime("$result->transacdate")) == "Jan") {
                    $monthsSupp[0] = $monthsSupp[0] + $result->transacamt;
                    $suppTotal = $suppTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Feb") {
                    $monthsSupp[1] = $monthsSupp[1] + $result->transacamt;
                    $suppTotal = $suppTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Mar") {
                    $monthsSupp[2] = $monthsSupp[2] + $result->transacamt;
                    $suppTotal = $suppTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Apr") {
                    $monthsSupp[3] = $monthsSupp[3] + $result->transacamt;
                    $suppTotal = $suppTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "May") {
                    $monthsSupp[4] = $monthsSupp[4] + $result->transacamt;
                    $suppTotal = $suppTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Jun") {
                    $monthsSupp[5] = $monthsSupp[5] + $result->transacamt;
                    $suppTotal = $suppTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Jul") {
                    $monthsSupp[6] = $monthsSupp[6] + $result->transacamt;
                    $suppTotal = $suppTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Aug") {
                    $monthsSupp[7] = $monthsSupp[7] + $result->transacamt;
                    $suppTotal = $suppTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Sep") {
                    $monthsSupp[8] = $monthsSupp[8] + $result->transacamt;
                    $suppTotal = $suppTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Oct") {
                    $monthsSupp[9] = $monthsSupp[9] + $result->transacamt;
                    $suppTotal = $suppTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Nov") {
                    $monthsSupp[10] = $monthsSupp[10] + $result->transacamt;
                    $suppTotal = $suppTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Dec") {
                    $monthsSupp[11] = $monthsSupp[11] + $result->transacamt;
                    $suppTotal = $suppTotal + $result->transacamt;
                }
        }
    }


    $monthsService = new SplFixedArray(12);
    $serviceTotal = 0;
    $sql = $dbcon->query("SELECT * FROM transactions WHERE transacpayor = '". $_POST['company_code'] ."' AND transactype = 'Services'");
    if($sql->num_rows > 0) {
        while($result = $sql->fetch_object()) {
            if(date('Y', strtotime("$result->transacdate")) == $_POST['year_code'])
                if (date('M', strtotime("$result->transacdate")) == "Jan") {
                    $monthsService[0] = $monthsService[0] + $result->transacamt;
                    $serviceTotal = $serviceTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Feb") {
                    $monthsService[1] = $monthsService[1] + $result->transacamt;
                    $serviceTotal = $serviceTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Mar") {
                    $monthsService[2] = $monthsService[2] + $result->transacamt;
                    $serviceTotal = $serviceTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Apr") {
                    $monthsService[3] = $monthsService[3] + $result->transacamt;
                    $serviceTotal = $serviceTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "May") {
                    $monthsService[4] = $monthsService[4] + $result->transacamt;
                    $serviceTotal = $serviceTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Jun") {
                    $monthsService[5] = $monthsService[5] + $result->transacamt;
                    $serviceTotal = $serviceTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Jul") {
                    $monthsService[6] = $monthsService[6] + $result->transacamt;
                    $serviceTotal = $serviceTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Aug") {
                    $monthsService[7] = $monthsService[7] + $result->transacamt;
                    $serviceTotal = $serviceTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Sep") {
                    $monthsService[8] = $monthsService[8] + $result->transacamt;
                    $serviceTotal = $serviceTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Oct") {
                    $monthsService[9] = $monthsService[9] + $result->transacamt;
                    $serviceTotal = $serviceTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Nov") {
                    $monthsService[10] = $monthsService[10] + $result->transacamt;
                    $serviceTotal = $serviceTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Dec") {
                    $monthsService[11] = $monthsService[11] + $result->transacamt;
                    $serviceTotal = $serviceTotal + $result->transacamt;
                }
        }
    }


    $monthsCredit = new SplFixedArray(12);
    $creditTotal = 0;
    $sql = $dbcon->query("SELECT * FROM transactions WHERE transacpayor = '". $_POST['company_code'] ."' AND transactype = 'Credit Card'");
    if($sql->num_rows > 0) {
        while($result = $sql->fetch_object()) {
            if(date('Y', strtotime("$result->transacdate")) == $_POST['year_code'])
                if (date('M', strtotime("$result->transacdate")) == "Jan") {
                    $monthsCredit[0] = $monthsCredit[0] + $result->transacamt;
                    $creditTotal = $creditTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Feb") {
                    $monthsCredit[1] = $monthsCredit[1] + $result->transacamt;
                    $creditTotal = $creditTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Mar") {
                    $monthsCredit[2] = $monthsCredit[2] + $result->transacamt;
                    $creditTotal = $creditTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Apr") {
                    $monthsCredit[3] = $monthsCredit[3] + $result->transacamt;
                    $creditTotal = $creditTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "May") {
                    $monthsCredit[4] = $monthsCredit[4] + $result->transacamt;
                    $creditTotal = $creditTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Jun") {
                    $monthsCredit[5] = $monthsCredit[5] + $result->transacamt;
                    $creditTotal = $creditTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Jul") {
                    $monthsCredit[6] = $monthsCredit[6] + $result->transacamt;
                    $creditTotal = $creditTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Aug") {
                    $monthsCredit[7] = $monthsCredit[7] + $result->transacamt;
                    $creditTotal = $creditTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Sep") {
                    $monthsCredit[8] = $monthsCredit[8] + $result->transacamt;
                    $creditTotal = $creditTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Oct") {
                    $monthsCredit[9] = $monthsCredit[9] + $result->transacamt;
                    $creditTotal = $creditTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Nov") {
                    $monthsCredit[10] = $monthsCredit[10] + $result->transacamt;
                    $creditTotal = $creditTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Dec") {
                    $monthsCredit[11] = $monthsCredit[11] + $result->transacamt;
                    $creditTotal = $creditTotal + $result->transacamt;
                }
        }
    }


    $monthsSEA = new SplFixedArray(12);
    $seaTotal = 0;
    $sql = $dbcon->query("SELECT * FROM transactions WHERE transacpayor = '". $_POST['company_code'] ."' AND transactype = 'SEA Residence'");
    if($sql->num_rows > 0) {
        while($result = $sql->fetch_object()) {
            if(date('Y', strtotime("$result->transacdate")) == $_POST['year_code'])
                if (date('M', strtotime("$result->transacdate")) == "Jan") {
                    $monthsSEA[0] = $monthsSEA[0] + $result->transacamt;
                    $seaTotal = $seaTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Feb") {
                    $monthsSEA[1] = $monthsSEA[1] + $result->transacamt;
                    $seaTotal = $seaTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Mar") {
                    $monthsSEA[2] = $monthsSEA[2] + $result->transacamt;
                    $seaTotal = $seaTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Apr") {
                    $monthsSEA[3] = $monthsSEA[3] + $result->transacamt;
                    $seaTotal = $seaTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "May") {
                    $monthsSEA[4] = $monthsSEA[4] + $result->transacamt;
                    $seaTotal = $seaTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Jun") {
                    $monthsSEA[5] = $monthsSEA[5] + $result->transacamt;
                    $seaTotal = $seaTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Jul") {
                    $monthsSEA[6] = $monthsSEA[6] + $result->transacamt;
                    $seaTotal = $seaTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Aug") {
                    $monthsSEA[7] = $monthsSEA[7] + $result->transacamt;
                    $seaTotal = $seaTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Sep") {
                    $monthsSEA[8] = $monthsSEA[8] + $result->transacamt;
                    $seaTotal = $seaTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Oct") {
                    $monthsSEA[9] = $monthsSEA[9] + $result->transacamt;
                    $seaTotal = $seaTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Nov") {
                    $monthsSEA[10] = $monthsSEA[10] + $result->transacamt;
                    $seaTotal = $seaTotal + $result->transacamt;
                }
                else if (date('M', strtotime("$result->transacdate")) == "Dec") {
                    $monthsSEA[11] = $monthsSEA[11] + $result->transacamt;
                    $seaTotal = $seaTotal + $result->transacamt;
                }
        }
    }
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
    <body>
    <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
        <div class="row"><div class="col-sm-12">
                <h4> <?php echo $compname->compname ?> (<?php echo $_POST['year_code'] ?>)</h4>
                <br>
                <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr role="row">
                        <th>Category</th>
                        <th>January</th>
                        <th>February</th>
                        <th>March</th>
                        <th>April</th>
                        <th>May</th>
                        <th>June</th>
                        <th>July</th>
                        <th>August</th>
                        <th>September</th>
                        <th>October</th>
                        <th>November</th>
                        <th>December</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Fetch data from database -->
                    <?php
                        for($k = 0; $k < 12; $k++) {
                            if($k == 0) {
                                ?>
                                <tr>
                                    <td> Rentals</td>
                                    <?php
                                    for($i = 0; $i < 12; $i++) {
                                        if($monthsRental[$i] > 0) {
                                            ?>
                                            <td><?php echo number_format($monthsRental[$i],2,'.',','); ?></td>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <td> ---- </td>
                                    <?php
                                        }
                                    }
                                    if ($rentalTotal > 0) {
                                    ?>
                                    <td><?php echo number_format($rentalTotal,2,'.',','); ?></td>
                                    <?php
                                    }
                                    else {
                                        ?>
                                        <td> ---- </td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                            if($k == 1) {
                                ?>
                                <tr role="row" class="odd">
                                    <td> Electricity</td>
                                    <?php
                                        for($i = 0; $i < 12; $i++) {
                                            if($monthsElectricity[$i] > 0) {
                                                ?>
                                                <td><?php echo number_format($monthsElectricity[$i],2,'.',','); ?></td>
                                                <?php
                                            }
                                            else {
                                                ?>
                                                <td> ---- </td>
                                        <?php
                                            }
                                        }
                                        if($electrictyTotal > 0) {
                                            ?>
                                            <td><?php echo number_format($electrictyTotal,2,'.',','); ?></td>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <td> ---- </td>
                                            <?php
                                        }
                                            ?>
                                </tr>
                                <?php
                            }
                            if($k == 2) {
                                ?>
                                <tr role="row" class="odd">
                                    <td> Communications </td>
                                    <?php
                                    for($i = 0; $i < 12; $i++) {
                                        if($monthsComms[$i] > 0) {
                                            ?>
                                            <td><?php echo number_format($monthsComms[$i],2,'.',','); ?></td>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <td> ---- </td>
                                            <?php
                                        }
                                    }
                                    if($commsTotal > 0) {
                                        ?>
                                        <td><?php echo number_format($commsTotal,2,'.',','); ?></a></td>
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <td> ---- </td>
                                        <?php
                                    }
                                        ?>
                                </tr>
                                <?php
                            }
                            if($k == 3) {
                                ?>
                                <tr role="row" class="odd">
                                    <td> Supplier </td>
                                    <?php
                                    for($i = 0; $i < 12; $i++) {
                                        if($monthsSupp[$i] > 0) {
                                            ?>
                                            <td><?php echo number_format($monthsSupp[$i],2,'.',','); ?></td>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <td> ---- </td>
                                            <?php
                                        }
                                    }
                                    if($suppTotal > 0) {
                                        ?>
                                        <td><?php echo number_format($suppTotal,2,'.',','); ?></td>
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <td> ---- </td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                            if($k == 4) {
                                ?>
                                <tr role="row" class="odd">
                                    <td> Services </td>
                                    <?php
                                    for($i = 0; $i < 12; $i++) {
                                        if($monthsService[$i] > 0) {
                                            ?>
                                            <td><?php echo number_format($monthsService[$i],2,'.',','); ?></td>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <td> ---- </td>
                                            <?php
                                        }
                                    }
                                    if($serviceTotal > 0) {
                                        ?>
                                        <td><?php echo number_format($serviceTotal,2,'.',','); ?></a></td>
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <td> ---- </td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                            if($k == 5) {
                                ?>
                                <tr role="row" class="odd">
                                    <td> Credit Card </td>
                                    <?php
                                    for($i = 0; $i < 12; $i++) {
                                        if($monthsCredit[$i] > 0) {
                                            ?>
                                            <td><?php echo number_format($mothsCredit[$i],2,'.',','); ?></td>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <td> ---- </td>
                                            <?php
                                        }
                                    }
                                    if($creditTotal > 0) {
                                        ?>
                                        <td><?php echo number_format($creditTotal,2,'.',','); ?></td>
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <td> ---- </td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                            if($k == 6) {
                                ?>
                                <tr role="row" class="odd">
                                    <td> SEA Residence </td>
                                    <?php
                                    for($i = 0; $i < 12; $i++) {
                                        if($monthsSEA[$i] > 0) {
                                            ?>
                                            <td><?php echo number_format($monthsSEA[$i],2,'.',','); ?></td>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <td> ---- </td>
                                            <?php
                                        }
                                    }
                                    if($seaTotal > 0) {
                                        ?>
                                        <td><?php echo number_format($seaTotal,2,'.',','); ?></td>
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <td> ---- </td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                            if($k == 7) {
                                ?>
                                <tr role="row" class="odd">
                                    <td> Grand Total </td>
                                    <?php
                                    for($i = 0; $i < 12; $i++) {
                                        ?>
                                            <td></td>
                                        <?php
                                    } $grandtotal = $creditTotal + $serviceTotal + $suppTotal + $commsTotal + $rentalTotal + $electrictyTotal + $seaTotal;
                                    ?>
                                    <td> <?php echo number_format($grandtotal,2,'.',','); ?>  </td>
                                </tr>
                                <?php
                            }
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
