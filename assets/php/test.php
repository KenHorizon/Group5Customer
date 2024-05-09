<?php
include("data.php");

$update_account = "UPDATE user SET type = 1 WHERE email = 'kenhorizon7@gmail.com'";
mysqli_query($database, $update_account);
?>