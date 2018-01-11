<?php

include '../../../dbconnect.php';


if(!empty($_FILES['files']['name'][0])) {
    $brno = mysqli_real_escape_string($dbcon, $_POST['brNo']);
    foreach ($_FILES['files']['name'] as $key => $name) {
        $temp_filepath = $_FILES['files']['tmp_name'][$key];
        if($temp_filepath != "") {
            $new_filepath = "../../files/".$_FILES['files']['name'][$key];
            if(move_uploaded_file($temp_filepath, $new_filepath)) {
                $stmt = $dbcon->prepare("INSERT INTO attachedfiles (fileidentifier,name) VALUES (?,?)");
                $stmt->bind_param('ss', $brno, $new_filepath);
                $stmt->execute();
            }
        }
    }
}

if(!empty($_POST)) {

    $brcompany = mysqli_real_escape_string($dbcon, $_POST['company']);
    $brno = mysqli_real_escape_string($dbcon, $_POST['brNo']);
    $brdatesub = mysqli_real_escape_string($dbcon, $_POST['dateSubmitted']);
    $brdatened = mysqli_real_escape_string($dbcon, $_POST['dateNeeded']);
    $brrqstdby = mysqli_real_escape_string($dbcon, $_POST['brRequestedBy']);
    $brattention = mysqli_real_escape_string($dbcon, $_POST['brAttention']);
    $brtitle = mysqli_real_escape_string($dbcon, $_POST['brTitle']);
    $brdepartment = mysqli_real_escape_string($dbcon, $_POST['brDepartment']);
    $brpettycash = mysqli_real_escape_string($dbcon, $_POST['brPettyCash']);
    $brothers = mysqli_real_escape_string($dbcon, $_POST['brOthers']);
    $brprepby = mysqli_real_escape_string($dbcon, $_POST['brPreparedBy']);
    $brappby = mysqli_real_escape_string($dbcon, $_POST['brApprovedBy']);
    $total = 0;




    $brNo = mysqli_real_escape_string($dbcon, $_POST['brNo']);
    $brquantity = $_POST['quantity'];
    $brdescription = $_POST['description'];
    $bramount = $_POST['amount'];

    foreach($brquantity AS $key => $value) {

        $query = "INSERT INTO budgetrequestsdetails(brno,brquantity,brdescription,bramount)
              VALUES ('$brNo','"
            . $dbcon->real_escape_string($brquantity[$key]) .
            "','"
            . $dbcon->real_escape_string($brdescription[$key]) .
            "','"
            . $dbcon->real_escape_string($bramount[$key]) .
            "')
              ";

        $insert = $dbcon->query($query);
        if(!$insert){
            echo $dbcon->error;
        }
    else{

            header ('Location: /HPV/users/USER/budgetrequestform.php');

        }


    }
    $total = intval($total) + array_sum($bramount);
    $sql = "INSERT INTO budgetrequests (brno,brcomp,brdatesubmitted,brrequestedby,brpreparedby,brtitle,brdateneeded,brattention,
          brdept,brstatus, brtotal) VALUES('$brno','$brcompany','$brdatesub','$brrqstdby','$brprepby','$brtitle','$brdatened',
          '$brattention','$brdepartment', 'FOR PRINT', $total)";
    mysqli_query($dbcon,$sql);
    $dbcon->close();
}
?>