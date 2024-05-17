<?php
use classes\database;
include("assets/php/database.php");
include("assets/php/main.php");
session_start();
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
$captcha = (int) getVerificationCode(6);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
$new_password = filter_input(INPUT_POST, "new_password", FILTER_SANITIZE_SPECIAL_CHARS);
$confirm_password = filter_input(INPUT_POST, "confirm_new_password", FILTER_SANITIZE_SPECIAL_CHARS);
$notice = "";
$verified = "SELECT * FROM account WHERE email = '$email'";
$verified_email = mysqli_query(database::get(), $verified);
if (mysqli_num_rows($verified_email) > 0) {
    $validate_verified_account = mysqli_fetch_assoc($verified_email);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($validate_verified_account['email'] === $email) {
            // TODO:
            // instead of sending links for confirmation, we will used randomized words like captcha and the expiration is 5 mins

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
            $_SESSION['verification_code'] = $captcha;
            $_SESSION['verification_email'] = $email;
            sendEmail("Password Change Verification", $body, $email);
            header("Location: forgot_password.php");
        } else {
            $notice = "Email not match, Try again!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.ico">
    <title>Beyond Horizon: Stars | Forgot Password</title>
    <link rel="stylesheet" href="assets/css/input_box.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/icons_addon.css"> <!-- ICONS API -->

</head>

<?php
include("header.php")
?>

<body>
    <br>
    <br>
    <div class="forget-password-background">
        <div class="forget-password">
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <div class="group-box-row">
                    <p>Enter Email</p>
                    <?php
                    echo "<p style='margin: 0 auto;'>" . $notice . "</p>"
                    ?>
                </div>
                <div class="group-box-column">
                    <input type="email" class="input-box" name="email" placeholder="Email" required>
                </div>
                <input style="font-weight: bold;" type="submit" class="input-button" name="submit" value="Confirm">
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