<?php

use classes\database, classes\subscription;
include("assets/php/include.php");
session_start();
$account_email = $_SESSION['email'];
$user->register = $account_email;
echo "TESTING";
if ($user->config()['digital_clock'] == 1) {
    database::query("UPDATE config SET digital_clock = 0 WHERE email = '$account_email'");
} else {
    database::query("UPDATE config SET digital_clock = 1 WHERE email = '$account_email'");
}
