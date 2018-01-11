<?php

//Example string.
$string = "Gaisano Country Mall";
$abbvr = $string[0];


for($i = 0; $i < strlen($string); $i++){
        //echo $i;
        if($string[$i] == ' ')
            $abbvr .= $string[$i+1];
            
}
        echo $abbvr;

?>