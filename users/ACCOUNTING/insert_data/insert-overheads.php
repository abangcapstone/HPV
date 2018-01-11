<?php

include '../../../dbconnect.php';


if(!empty($_POST)) {

    // Overhead NO Generate

        $sql = $dbcon->query("SELECT  * FROM overheads");
        $NumRows = $sql->num_rows;
        $NumRows++;
        $Check = true;
        do{
            $count = 0;
            $temp = str_pad($NumRows, 4, "0", STR_PAD_LEFT);
            $CheckCode = "OH-".$temp;
            $query = $dbcon->query("SELECT * FROM overheads WHERE overheadcode = '$CheckCode'");
            $count = $query->num_rows;
            if($count == 1)
            {
                $Check = true;
                $NumRows+=1;
            }
            else{
                $Check = false;
                $OHCode = $CheckCode;
            }

        }while($Check == true);
// END PR NO Generate


    $ohcompany = mysqli_real_escape_string($dbcon, $_POST['company']);
    $ohcompbranch = mysqli_real_escape_string($dbcon, $_POST['compBranch']);
    $ohdate = mysqli_real_escape_string($dbcon, $_POST['date']);
    $ohtype = mysqli_real_escape_string($dbcon, $_POST['overheadtype']);
    $ohpreparedby = mysqli_real_escape_string($dbcon, $_POST['preparedBy']);





    $sql = "INSERT INTO overheads (overheadcode,overheadcomp,overheadcompbranch,overheaddate,overheadpreparedby,overheadtype,
overheadstatus) VALUES
('$OHCode','$ohcompany','$ohcompbranch','$ohdate','$ohpreparedby','$ohtype', 'FOR VOUCHER')";
    mysqli_query($dbcon,$sql);


    if($ohtype == 'Rental'){
        $ohname = $_POST['businessname'];
        $ohaddr = $_POST['address'];
        $ohcontact = $_POST['contactdetails'];
        $ohunit = $_POST['unit'];
        $amt = $_POST['amount'];
        $temp = $_POST['duedate'];

        foreach($ohname AS $key => $value) {
            $tempdate = $temp[$key];
            $ohduedate = date('Y-m-').$tempdate;
            $query = "INSERT INTO overheaddetails(overheaddetailscode,overheadname,overheadaddr,overheadcontact,overheadunit,overheadamount,
overheadduedate)
              VALUES ('$OHCode','"
                . $dbcon->real_escape_string($ohname[$key]) .
                "','' 
               '"
                . $dbcon->real_escape_string($ohaddr[$key]) .
                "','"
                . $dbcon->real_escape_string($ohcontact[$key]) .
                "','"
                . $dbcon->real_escape_string($ohunit[$key]) .
                "','"
                . $dbcon->real_escape_string($amt[$key]) .
                "' ,'"
                . $dbcon->real_escape_string($ohduedate) .
                "')
              ";

            $insert = $dbcon->query($query);
            if(!$insert){
                echo $dbcon->error;
            }
            else{

                    header ('Location: /HPV/users/ACCOUNTING/rentals.php');
                }
            }
    }
    else{
    $ohname = $_POST['businessname'];
    $ohaddr = $_POST['address'];
    $ohcontact = $_POST['contactdetails'];
        $temp = $_POST['duedate'];


    foreach($ohname AS $key => $value) {
        $tempdate = $temp[$key];
        $ohduedate = date('Y-m-').$tempdate;
        $query = "INSERT INTO overheaddetails(overheaddetailscode,overheadname,overheadaddr,overheadcontact,overheadduedate)
              VALUES ('$OHCode','"
            . $dbcon->real_escape_string($ohname[$key]) .
            "','' 
               '"
            . $dbcon->real_escape_string($ohaddr[$key]) .
            "','"
            . $dbcon->real_escape_string($ohcontact[$key]) .
            "' ,'"
            . $dbcon->real_escape_string($ohduedate) .
            "')
              ";

        $insert = $dbcon->query($query);
        if(!$insert){
            echo $dbcon->error;
        }
        else{
            if($ohtype == 'Communication'){
            header ('Location: /HPV/users/ACCOUNTING/communication.php');
            }
            else if($ohtype == 'Services'){
                header ('Location: /HPV/users/ACCOUNTING/services.php');
            }
            else if($ohtype == 'Credit Card'){
                header ('Location: /HPV/users/ACCOUNTING/creditcard.php');
            }
            else if($ohtype == 'SEA Residence'){
                header ('Location: /HPV/users/ACCOUNTING/searesidence.php');
            }
            else if($ohtype == 'Supplier'){
                header ('Location: /HPV/users/ACCOUNTING/supplier.php');
            }
            else if($ohtype == 'Electric'){
                header ('Location: /HPV/users/ACCOUNTING/electric.php');
            }

        }
    }

    }
    $dbcon->close();
}
?>