<?php

include '../../../dbconnect.php';

if(!empty($_FILES['files']['name'][0])) {
    $prno = mysqli_real_escape_string($dbcon, $_POST['prNo']);
    foreach ($_FILES['files']['name'] as $key => $name) {
        $temp_filepath = $_FILES['files']['tmp_name'][$key];
        if($temp_filepath != "") {
            $new_filepath = "../../files/".$_FILES['files']['name'][$key];
            if(move_uploaded_file($temp_filepath, $new_filepath)) {
                $stmt = $dbcon->prepare("INSERT INTO attachedfiles (fileidentifier,name) VALUES (?,?)");
                $stmt->bind_param('ss', $prno, $new_filepath);
                $stmt->execute();
            }
        }
    }
}

if(!empty($_POST)) {

    $prcompany = mysqli_real_escape_string($dbcon, $_POST['company']);
    $prno = mysqli_real_escape_string($dbcon, $_POST['prNo']);
    $prdatesub = mysqli_real_escape_string($dbcon, $_POST['dateSub']);
    $prdatened = mysqli_real_escape_string($dbcon, $_POST['dateNed']);
    $prrqstdby = mysqli_real_escape_string($dbcon, $_POST['requestedBy']);
    $prattention = mysqli_real_escape_string($dbcon, $_POST['attention']);
    $prtitle = mysqli_real_escape_string($dbcon, $_POST['title']);
    $prdepartment = mysqli_real_escape_string($dbcon, $_POST['department']);
    $prpettycash = mysqli_real_escape_string($dbcon, $_POST['pettycash']);
    $prothers = mysqli_real_escape_string($dbcon, $_POST['others']);
    $prprepby = mysqli_real_escape_string($dbcon, $_POST['preparedBy']);
    $prappby = mysqli_real_escape_string($dbcon, $_POST['approvedBy']);



    $prNo = mysqli_real_escape_string($dbcon, $_POST['prNo']);
    $prinvoiceno = $_POST['invoiceno'];
    $prdescription = $_POST['description'];
    $pramount = $_POST['amount'];
    $prduedate = $_POST['duedate'];
    $total = 0;
    foreach($prinvoiceno AS $key => $value) {

        $query = "INSERT INTO paymentrequestsdetails(prno,prinvoiceno,prdesc,pramount,prduedate)
              VALUES ('$prNo','"
            . $dbcon->real_escape_string($prinvoiceno[$key]) .
            "','"
            . $dbcon->real_escape_string($prdescription[$key]) .
            "','"
            . $dbcon->real_escape_string($pramount[$key]) .
            "','"
            . $dbcon->real_escape_string($prduedate[$key]) .
            "')
              ";

        $insert = $dbcon->query($query);
        if(!$insert){
            echo $dbcon->error;
        }
        else{

            header ('Location: /HPV/users/ACCOUNTING/paymentrequestform.php');

        }
    }
    $total =  intval($total) + array_sum($pramount);

    $sql = "INSERT INTO paymentrequests (prno,prcomp,prdatesubmitted,prrequestedby,prpreparedby,prtitle,prdateneeded,prattention,prdept,prstatus,prtotal) VALUES('$prno','$prcompany','$prdatesub','$prrqstdby','$prprepby','$prtitle','$prdatened','$prattention','$prdepartment', 'FOR PRINT','$total')";
    mysqli_query($dbcon,$sql);
    $dbcon->close();
}
?>