<?php
use classes\database;

require 'assets/php/include.php';
session_start();
?>
<?php
$notice = "";
$codes = $_SESSION["verification_code"];
$emails = $_SESSION["verification_email"];
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
$new_password = filter_input(INPUT_POST, "new_password", FILTER_SANITIZE_SPECIAL_CHARS);
$confirm_password = filter_input(INPUT_POST, "confirm_new_password", FILTER_SANITIZE_SPECIAL_CHARS);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $verification_email = $_SESSION["verification_email"];
    $verified_email = database::query("SELECT * FROM account WHERE email = '$verification_email'");
    if (mysqli_num_rows($verified_email) > 0) {
        $verified_code = filter_input(INPUT_POST, "verification", FILTER_SANITIZE_SPECIAL_CHARS);
        if ($verified_code == $_SESSION["verification_code"]) {
            if ($new_password === $confirm_password) {
                $notice = "Password changed";
                try {
                    database::query("UPDATE account SET password = '$new_password' WHERE email = '$verification_email'");
                } catch (mysqli_sql_exception) {
                    $notice = "Error!"; 
                }
                session_unset();
                session_destroy();
                header("Location index.php");
            } else {
                $notice = "Incorrect Password Code!, Please Try Again!"; 
            }
        } else {
            $notice = "Incorrect Verification Code!, Please Try Again!";
        }
    } else {
        $notice = "????";
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
                    <p>Change Password</p>
                    <?php
                    echo "<p style='margin: 0 auto;'>" . $notice . "</p>"
                    // ONLY DEVELOPERS
                    // echo "<p style='margin: 0 auto;'>" . $codes . "</p>";
                    // echo "<p style='margin: 0 auto;'>" . $emails . "</p>";
                    ?>
                </div>
                <div>
                    <div class="group-box-column">
                        <label for="verification">Enter Verification Code:</label>
                        <input type="text" class="input-box" name="verification" maxlength="12" placeholder="Verification Code" required>
                        <label for="new_password">Enter New Password:</label>
                        <input type="password" class="input-box" name="new_password" maxlength="12" placeholder="New Password" required>
                        <label for="new_password">Enter Confirm New Password:</label>
                        <input type="password" class="input-box" name="confirm_new_password" maxlength="12" placeholder="Confirm Password" required>
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