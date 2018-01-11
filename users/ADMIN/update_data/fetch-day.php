<?php

include "../../../dbconnect.php";
 if(isset($_POST['month'])){

    $query = "SELECT * FROM calendar";
    $result = mysqli_query($dbcon, $query);

    $output="";
    $output = '<option value="">Day</option>';

        if($_POST['month'] == 'February')
        {
            for($i = 1; $i<=29; $i++) {
                if($i < 10)
                      $output .= '<option value="0'.$i.'"> '. $i . '</option>';
                else
                      $output .= '<option value="' . $i . '">' . $i . '</option>';
            }
        }
        else if($_POST['month'] == 'January' || $_POST['month'] == 'March' || $_POST['month'] == 'May' || $_POST['month'] == 'July' || $_POST['month'] == 'August' || $_POST['month'] == 'October' || $_POST['month'] == 'December'){
            for($i = 1; $i<=31; $i++)
            {
                if($i < 10)
                    $output .= '<option value="0'.$i.'"> '. $i . '</option>';
                else
                    $output .= '<option value="' . $i . '">' . $i . '</option>';
            }
        }
        else
        {
            for($i = 1; $i<=30; $i++)
            {
                if($i < 10)
                    $output .= '<option value="0'.$i.'"> '. $i . '</option>';
                else
                    $output .= '<option value="' . $i . '">' . $i . '</option>';
            }
        }

    echo $output;
}
?>
