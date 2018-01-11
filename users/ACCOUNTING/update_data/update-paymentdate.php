<?php

include '../../../dbconnect.php';

function calculate_next_month($start_date = FALSE)
{
    if ($start_date) {
        $now = $start_date; // Use supplied start date.
    } else {
        $now = time(); // Use current time.
    }

    // Get the current month (as integer).
    $current_month = date('n', $now);

    // If the we're in Dec (12), set current month to Jan (1), add 1 to year.
    if ($current_month == 12) {
        $next_month = 1;
        $plus_one_month = mktime(0, 0, 0, 1, date('d', $now), date('Y', $now) + 1);
    } // Otherwise, add a month to the next month and calculate the date.
    else {
        $next_month = $current_month + 1;
        $plus_one_month = mktime(0, 0, 0, date('m', $now) + 1, date('d', $now), date('Y', $now));
    }

    $i = 1;
    // Go back a day at a time until we get the last day next month.
    while (date('n', $plus_one_month) != $next_month) {
        $plus_one_month = mktime(0, 0, 0, date('m', $now) + 1, date('d', $now) - $i, date('Y', $now));
        $i++;
    }

    return $plus_one_month;
}

if(!empty($_POST)) {
    $code = mysqli_real_escape_string($dbcon,$_POST['id_holder']);
    $date = mysqli_real_escape_string($dbcon,$_POST['date']);
    $or = mysqli_real_escape_string($dbcon,$_POST['orno']);
    $ref = mysqli_real_escape_string($dbcon,$_POST['refno']);

    $result = $dbcon->query("SELECT * FROM overheaddetails 
    WHERE  overheaddetailscode  = '$code'");
    $row = $result->fetch_object();


    $newduedate = date('Y-m-d', calculate_next_month(strtotime($row->overheadduedate)));

    $sql = "UPDATE overheaddetails SET 
      overheadduedate = '$newduedate',
      overheaddatepaid = '$date',
      overheadorno = '$or',
      overheadrefno = '$ref'
      
      WHERE overheaddetailscode = '$code'";
    mysqli_query($dbcon,$sql);


    $query = mysqli_query($dbcon, "SELECT * FROM overheads,companies ,overheaddetails 
WHERE  overheadcode = '$code' && overheadcomp = compno && overheaddetailscode= '$code' ");
    $data = mysqli_fetch_array($query);

    $type = $data['overheadtype'];
    $payor = $data['compno'];
    $amt = $data['overheadamount'];


    $sql2 = "INSERT INTO transactions (transaccode, transactype, transacpayor, transacdate, transacamt) VALUES
          ('$code','$type', '$payor', '$date', '$amt')";
    mysqli_query($dbcon,$sql2);

    $dbcon->close();

}


?>