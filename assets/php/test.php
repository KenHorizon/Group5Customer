<?php
include("../data.php");
?>
<?php
$email = "kenhorizon7@gmail.com";

$update_user = "UPDATE user SET type = 1 WHERE email = '$email'";
mysqli_query($database, $update_user);
?>