<?php
include("assets/php/data.php");
?>
<?php
//  $body =
//  "
// <div style='text-align: center;'><font face='FF Mark W05, Arial, sans-serif' color='#666666'><span style='font-size: 18px; letter-spacing: -0.18px; background-color: rgb(204, 204, 204);'><b style=''>Keep your Account secure by verifying your</b></span></font></div>
// <div style='text-align: center;'><font face='FF Mark W05, Arial, sans-serif' color='#666666'><span style='font-size: 18px; letter-spacing: -0.18px; background-color: rgb(204, 204, 204);'><b style=''>email address.</b></span></font></div>
// <br>
// <br>
// <div style='text-align: center;'><font face='FF Mark W05, Arial, sans-serif'><span style='font-size: 18px; letter-spacing: -0.18px;'><b style=''><font style='background-color: rgb(255, 255, 255);' color='#999999'><a href='http://beyondhorizon.patreon.com/forgotPasswordEntry.php'>CONFIRM</a></font></b></span></font></div>
// <br>
// <br>
// ";
$notice = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $old_password = filter_input(INPUT_POST, "old_password", FILTER_SANITIZE_SPECIAL_CHARS);
    $new_password = filter_input(INPUT_POST, "new_password", FILTER_SANITIZE_SPECIAL_CHARS);
    $confirm_password = filter_input(INPUT_POST, "confirm_new_password", FILTER_SANITIZE_SPECIAL_CHARS);
    $verified = "SELECT * FROM account WHERE email = '$email'";
    $verified_email = mysqli_query($database, $verified);
    if (mysqli_num_rows($verified_email) > 0) {
        $validate_verified_account = mysqli_fetch_assoc($verified_email);
        if ($validate_verified_account['email'] === $email) {
            // TODO:
            // instead of sending links for confirmation, we will used randomized words like captcha and the expiration is 5 mins
            $captcha = getName(10);
            $setTimer = 5;
            $body =
                "
            <div style='text-align: center;'><font face='FF Mark W05, Arial, sans-serif' color='#666666'><span style='font-size: 18px; letter-spacing: -0.18px; background-color: rgb(204, 204, 204);'><b style=''>Keep your Account secure by verifying your</b></span></font></div>
            <div style='text-align: center;'><font face='FF Mark W05, Arial, sans-serif' color='#666666'><span style='font-size: 18px; letter-spacing: -0.18px; background-color: rgb(204, 204, 204);'><b style=''>email address.</b></span></font></div>
            <br>
            <br>
            <div style='text-align: center;'><font face='FF Mark W05, Arial, sans-serif'><span style='font-size: 18px; letter-spacing: -0.18px;'><b style=''><font style='background-color: rgb(255, 255, 255);' color='#999999'><b>" . $captcha . "</m></font></b></span></font></div>
            <br>
            <br>
            ";
            sendEmail("Password Change Verification", $body, $email);
        } else {
            header("Location: forgotPassword.php?error=Incorrect Email");
        }
    }
    $login = "SELECT * FROM account WHERE email = '$email'";
    $result = mysqli_query($database, $login);
    $verified_code = filter_input(INPUT_POST, "verification", FILTER_SANITIZE_SPECIAL_CHARS);
    if (mysqli_num_rows($result) > 0 && $verified_code == $captcha) {
        $validate_account = mysqli_fetch_assoc($result);
        $validate_account_password = $validate_account['password'];
        if ($new_password === $confirm_password) {
            $insert_new_password = "UPDATE account SET 'password' = $new_password WHERE email = '$email'";
            header("Location index.php");
        }
    } else {
        $notice = "Incorrect Verification Code!, Please Try Again!";
    }
}
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
                <div class="group-box-row">
                    <p>Enter Email</p>
                    <?php
                        echo "<p style='margin: 0 auto;'>" .$notice. "</p>"
                    ?>
                </div>
                <div class="group-box-column">
                    <input type="email" class="input-box" name="email" placeholder="Email" required>
                </div>
                <input style="font-weight: bold;" type="submit" class="input-button" name="submit" value="Confirm">
            </form>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <p>Change Password</p>
                <div>
                    <div class="group-box-column">
                        <label for="verification">Enter Verification Code:</label>
                        <input type="password" class="input-box" name="verification" maxlength="12" placeholder="Password" required>
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
    <div class="popup">
        <div class="popup-content">
            <h2>Password Changed</h2>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <input style="font-weight: bold;" type="reset" class="input-button" name="reset" value="Cancel">
                <input style="font-weight: bold;" type="submit" class="input-button" name="submit" value="Confirm">
            </form>
        </div>
    </div>
    <script src="assets/javascript/message_box.js"></script>
</body>

</html>