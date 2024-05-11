<?php
include("assets/php/mail.php");
?>
<?php

// PHP program to pop an alert 
// message box on the screen 

// Function definition 
function function_alert($message)
{
    // Display the alert box  
    echo "<script>alert('$message');</script>";
}
function split($string, $limit)
{
    return explode($limit, $string);
}

function convertMonthToNames($number)
{
    switch ($number) {
        case 1:
            return $output = "January";
            break;
        case 2:
            return $output = "February";
            break;
        case 3:
            return $output = "March";
            break;
        case 4:
            return $output = "April";
            break;
        case 5:
            return $output = "May";
            break;
        case 6:
            return $output = "June";
            break;
        case 7:
            return $output = "July";
            break;
        case 8:
            return $output = "August";
            break;
        case 9:
            return $output = "September";
            break;
        case 10:
            return $output = "October";
            break;
        case 11:
            return $output = "November";
            break;
        case 12:
            return $output = "December";
            break;
        default:
            return $output = "Invalid!";
    }
}
function convertZeroNumber($number)
{
    if ($number > 10) {
        return $number;
    } else {
        return split($number, 0);
    }
}
function determineUserType($number)
{
    switch ($number) {
        case 0:
            return $output = "User";
            break;
        case 1:
            return $output = "Admin";
            break;
        default:
            return $output = "User!";
    }
}
function getName($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}
