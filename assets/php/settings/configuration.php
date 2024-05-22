<?php

use classes\database, classes\subscription;
include("../include.php");
session_start();
$account_email = $_SESSION['email'];
$requested = $_REQUEST["configs"];
//echo $requested;
$user->register = $account_email;
if ($user->config()[$requested] == 1) {
    database::query("UPDATE config SET $requested = 0 WHERE email = '$account_email'");
} else {
    database::query("UPDATE config SET $requested = 1 WHERE email = '$account_email'");
}
