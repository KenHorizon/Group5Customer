<?php
convertZeroNumber("01");


function convertZeroNumber($number)
{
    if ($number >= 10) {
        echo $number;
    } else {
        $remove = explode($number, "8");
        echo $remove[0];
    }
}
?>