<?php
include("assets/php/data.php");
?>
<?php
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $old_password = filter_input(INPUT_POST, "old_password", FILTER_SANITIZE_SPECIAL_CHARS);
    $new_password = filter_input(INPUT_POST, "new_password", FILTER_SANITIZE_SPECIAL_CHARS);
    $confirm_password = filter_input(INPUT_POST, "confirm_new_password", FILTER_SANITIZE_SPECIAL_CHARS);
    $login = "SELECT * FROM account WHERE email = '$email' AND password = '$old_password'";
    $result = mysqli_query($database, $login);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.png">
    <title>Beyond Horizon: Stars | Forgot Password</title>
    <link rel="stylesheet" href="assets/css/input_box.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/icons_addon.css"> <!-- ICONS API -->

</head>

<header>
    <div class="navigation" id="navigationMenu">
        <a class="button" href="index.php"><i class="material-icons">home</i>Home</a>
        <a class="button" href="about.php"><i class="material-icons">people</i>About</a>
        <a class="button" href="createAccount.php"><i class="material-icons">create</i>Sign-Up</a>
    </div>
</header>

<body>
    <br>
    <br>
    <div class="forget-password-background">
        <div class="forget-password">
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <p>Change Password</p>
                <div>
                    <div class="group-box-column">
                        <label for="new_password">Enter New Password:</label>
                        <input type="password" class="input-box" name="new_password" maxlength="12" placeholder="New Password" required>
                        <label for="new_password">Enter Confirm New Password:</label>
                        <input type="password" class="input-box" name="confirm new_password" maxlength="12" placeholder="Confirm Password" required>
                    </div>
                </div>
                <div>
                    <input style="font-weight: bold;" type="reset" class="input-button" name="reset" value="Cancel">
                    <input style="font-weight: bold;" type="submit" class="input-button" name="submit" value="Confirm">
                </div>
            </form>
        </div>
    </div>
</body>

</html>