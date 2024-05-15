<?php

use classes\{database};
require 'database.php';
session_start();

$email = $_SESSION['email'];
$result = database::query("SELECT * FROM membership WHERE email = '$email'");
$account = database::query("SELECT * FROM account WHERE email = '$email'");
if (mysqli_num_rows($result) > 0) {
    $validate_account = mysqli_fetch_assoc($account);
    $validate_account_membership = mysqli_fetch_assoc($result);
    $currentTime = time();
    $expiration_date = $validate_account_membership['expiration'];
    $validate_account_username = $validate_account["username"];
    // echo $currentTime . "<br>";
    // echo $expiration_date;
    if ($currentTime > $expiration_date && $validate_account_membership['status'] == 1) {
        header("Refresh: 0");
        echo "";
        database::query("UPDATE membership SET status = 0 WHERE email = '$email'");
        database::query("UPDATE membership SET subscription_date = 0 WHERE email = '$email'");
        database::query("UPDATE membership SET expiration = 0 WHERE email = '$email'");
    }
}
?>