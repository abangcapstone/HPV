<?php
include '../../../dbconnect.php';


if(!empty($_POST)) {
    $id_holder = mysqli_real_escape_string($dbcon, $_POST['id_holder']);
    $query = mysqli_query($dbcon, "SELECT * FROM povoucherpdc WHERE voucherno = '$id_holder'");
    $data = mysqli_fetch_array($query);
    $id = $_POST['id'];
    $checkNo = $_POST['checkno'];
    $bankName = $_POST['bank'];
    $date = $_POST['date'];
    $amountX = $_POST['AMOUNT'];

        foreach ($id AS $key => $value) {
            $sql = "UPDATE povoucherpdc SET 
      checkno = '" . $dbcon->real_escape_string($checkNo[$key]) .
                "', bankname = '"
                . $dbcon->real_escape_string($bankName[$key]) .
                "', duedate = '"
                . $dbcon->real_escape_string($date[$key]) .
                "', amount = '". $dbcon->real_escape_string($amountX[$key]) ."'
      WHERE  id = '$value'";
            $update = $dbcon->query($sql);
            if (!$update) {
                break;
            } else {

                header('Location: /HPV/users/ACCOUNTING/po_vouchers.php');

            }


        }
    $dbcon->close();
}
?>
