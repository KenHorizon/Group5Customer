<?php
include("assets/php/data.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.png">
    <title>Beyond Horizon: Stars | Sign Up</title>
    <link rel="stylesheet" href="assets/css/input_box.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/icons_addon.css"> <!-- ICONS API -->
</head>
</html>
<?php
$user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
$login = "SELECT * FROM account WHERE email = '$user' AND password = '$password'";
$result = mysqli_query($database, $login);

if (mysqli_num_rows($result) > 0) {
    $validate_account = mysqli_fetch_assoc($result);
    $validate_account_email = $validate_account['email'];
    $get_user = "SELECT * FROM user WHERE email = '$validate_account_email'";
    // echo "<h1>" . $validate_account_email . "</h1> <br>";
    $validate_user = mysqli_query($database, $get_user);
    if (mysqli_num_rows($validate_user) > 0) {
        $validate_user_account = mysqli_fetch_assoc($validate_user);
        $validate_user_type = $validate_user_account['type'];
        // echo "<h1>".$user_name."</h1> <br>";
        // Check the email and password and later the user account if the account is activated
        if ($validate_account['email'] === $user && $validate_account['password'] === $password && $validate_account['activated'] === 1) {
            $_SESSION['uuid'] = $validate_account['uuid'];
            $_SESSION['email'] = $validate_account['email'];
            $_SESSION['password'] = $validate_account['password'];
            $_SESSION['type'] = $validate_user_type;
            // echo "<h1>".$_SESSION['uuid']."</h1> <br>";
            // echo "<h1>".$_SESSION['email']."</h1> <br>";
            // echo "<h1>".$_SESSION['password']."</h1> <br>";
            // echo "<h1>".$_SESSION['type']."</h1> <br>";
            header("Location: account.php");
        } else {
            header("Location: index.html?error=Incorrect Username or Password");
        }
    } else {
        header("Location: index.html?error=Incorrect Username or Password");
    }
    // echo "<h1>".$user_uuid."</h1> <br>";
    // echo "<h1>".$validate_account['uuid']."</h1> <br>";
    // echo "<h1>".$validate_account['username']."</h1> <br>";
    // echo "<h1>".$validate_account['email']."</h1> <br>";
} else {
    header("Location: index.html?error=Incorrect Username or Password");
}
?>
