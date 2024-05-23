<?php
// AJAX - using to update account's subscription
use classes\database, classes\subscription;
include("../include.php");

$membership = $email;
$result = database::query("SELECT * FROM membership WHERE email = '$membership'");
if (mysqli_num_rows($result) > 0) {
    $validate_account = mysqli_fetch_assoc($result);
    $currentTime = time();
    $expiration_date = $validate_account['expiration'];
    // echo $currentTime . "<br>";
    // echo $expiration_date;
    if ($currentTime > $expiration_date && $validate_account['status'] == 1) {
        database::query("UPDATE membership SET status = 0 WHERE email = '$membership'");
        database::query("UPDATE membership SET subscription_date = 0 WHERE email = '$membership'");
        database::query("UPDATE membership SET expiration = 0 WHERE email = '$membership'");
        header("Refresh: 0");
    }
}
echo "<img class='badge-icon' src='assets/img/subscription/badge.png'>";
?>